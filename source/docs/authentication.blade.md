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
    aws_key: 'AKIAIHV6HIXXXXXXX',
);

$spa = new AmznSPA($config); // Pass the config as a constructor
$new_spa = $spa->usingMarketplace('ATVPDKIKX0DER'); // You can also update each parameter individually. This will return a new instantiation of AmznSPA, not change the original

$items = $spa->catalog->getItems();
```

All of the signing and authentiation headers will be added automatically to your request.