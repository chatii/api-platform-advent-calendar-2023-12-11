import * as cdk from 'aws-cdk-lib';
import {Construct} from 'constructs';
import {PhpFpmFunction} from "@bref.sh/constructs";
import {AssetCode, FunctionUrlAuthType, Tracing} from "aws-cdk-lib/aws-lambda";

export class InfraStack extends cdk.Stack {
  constructor(scope: Construct, id: string, props?: cdk.StackProps) {
    super(scope, id, props);

    const helloApi = new PhpFpmFunction(this, 'Hello', {
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

    helloApi.addFunctionUrl({
      authType: FunctionUrlAuthType.NONE,
    });
  }
}
