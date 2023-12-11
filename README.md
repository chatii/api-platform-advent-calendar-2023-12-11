# API Platform アドベントカレンダー 2023 12/11<br>API PlatformをBrefで動かしてみたい

このリポジトリはタイトルの通り、API PlatformとBrefを組み合わせたサンプルです。

## API Gateway用に OpenAPI を出力する

```bash
bin/console api:openapi:export --api-gateway --output=../infra/openapi.json
```
