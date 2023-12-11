import * as cdk from 'aws-cdk-lib';
import {Construct} from 'constructs';
import {PhpFpmFunction} from "@bref.sh/constructs";
import {AssetCode, FunctionUrlAuthType, Tracing} from "aws-cdk-lib/aws-lambda";
import {ApiDefinition, LambdaIntegration, RestApi, SpecRestApi} from "aws-cdk-lib/aws-apigateway";

export class InfraStack extends cdk.Stack {
  constructor(scope: Construct, id: string, props?: cdk.StackProps) {
    super(scope, id, props);

    const helloFunction = new PhpFpmFunction(this, 'Hello', {
      handler: 'public/index.php',
      phpVersion: "8.3",
      code: new AssetCode("../api/", {
        exclude: [
            'tests/**',
            'var/**',
        ],
      }),
      tracing: Tracing.ACTIVE,
      environment: {
        'APP_ENV': 'prod',
      },
    });

    helloFunction.addFunctionUrl({
      authType: FunctionUrlAuthType.NONE,
    });

    const apiGateway = new SpecRestApi(this, "RestApi", {
      apiDefinition: ApiDefinition.fromAsset("./openapi.json"),
    });

    const integration = new LambdaIntegration(helloFunction);

  }
}
