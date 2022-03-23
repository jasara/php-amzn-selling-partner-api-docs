---
title: Authenticating Requests
description: 
extends: _layouts.documentation
section: content
---

# Authenticating Requests

This library will automatically authenticate requests based on the provided [authorization keys](/docs/authorization). 

Ideally, pass in both the `lwa_access_token` and the `lwa_refresh_token`, and the library will generate a new access token if required. Access tokens expire after one hour, so you may want to set up a cache to preserve the access token until it expires. 

```php
use Jasara\AmznSPA\AmznSPA;
use Jasara\AmznSPA\AmznSPAConfig;

$config = new AmznSPAConfig(
    marketplace_id: 'ATVPDKIKX0DER',
    lwa_refresh_token: 'Atza|AhRmHjNgHpi0U-DmIQR6CuUpSREBLjAse37rEXAMPLE',  // Optional if access token is provided and still active
    lwa_access_token: 'Atza|IQEBLjAsAhRmHjNgHpi0U-Dme37rR6CuUpSREXAMPLE',
    application_id: 'amzn1.sellerapps.app.example-123456',
);

$spa = new AmznSPA($config); // Pass the config as a constructor
$new_spa = $spa->usingMarketplace('ATVPDKIKX0DER'); // You can also update each parameter individually. This will return a new instantiation of AmznSPA, not change the original

$items = $spa->catalog_items->getCatalogItem(
    asin: 'B0020MLK00',
    marketplace_ids: ['ATVPDKIKX0DER'],
    included_data: ['images'],
);
```

All of the signing and authentiation headers will be added automatically to your request.

## Using Callbacks to Store Tokens

Instead of checking yourself if the access token has expired, you can add a callback to `AmznSPAConfig` that will be called whenever tokens need to be refreshed. First, ensure you pass in both the access token and the refresh token. Then, pass in a callback that will save new access tokens using whatever storage method you prefer. For example:

```php
$config = new AmznSPAConfig(
    lwa_access_token: Cache::get('lwa_access_token'),
    lwa_refresh_token: 'Atza|IQEBLjAsAhRmHjNgHpi0U-Dme37rR6CuUpSREXAMPLE',
    save_lwa_tokens_callback: function (AuthTokensDTO $tokens) {
        Cache::put('lwa_access_token', $tokens->access_token, $token->expires_at);
    },
);
```