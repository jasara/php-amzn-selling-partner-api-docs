---
title: Migrating from MWS
description: Migrate your current MWS application to the Selling Partner API
extends: _layouts.documentation
section: content
---

# Migrating from MWS

There are two steps to migrating your current MWS clients to the Selling Partner API.

### 1. Get an Authorization Code

First, set up `AmznSPA` with your LWA config. 

```php
use Jasara\AmznSPA\AmznSPAConfig;
use Jasara\AmznSPA\AmznSPA;

$config = new AmznSPAConfig(
    marketplace_id: $marketplace_id,
    application_id: $application_keys->application_id,
    aws_access_key: $application_keys->aws_access_key,
    aws_secret_key: $application_keys->aws_secret_key,
    lwa_client_id: $application_keys->lwa_client_id,
    lwa_client_secret: $application_keys->lwa_client_secret,
);

$spa = new AmznSPA($config);
```

Using your preview MWS credentials, call the `getAuthorizationCodeFromMwsToken` token on the authentication resource.

```php
$auth_code_response = $spa->authorization->getAuthorizationCodeFromMwsToken(
    seller_id: $client->merchant_id,
    mws_auth_token: $client->mws_auth_token,
    developer_id: $mws_developer_id,
);
```

Immediately use the authorization code to get a refresh token for the client.

```php
$auth_tokens = $spa->lwa->getTokensFromAuthorizationCode($auth_code_response->payload->authorization_code);
```

Save at least the refresh token in permanent storage. 