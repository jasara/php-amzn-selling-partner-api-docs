---
title: Logging & Debugging
description: Use the built in debug and error logging to help troubleshoot your Amazon Selling Partner API calls
extends: _layouts.documentation
section: content
---

# Logging & Debugging

The library will use a default logger to log to PHP's `error_log`, but you can also pass in your own logger that conforms to the [PSR-3 LoggerInterface](https://www.php-fig.org/psr/psr-3/). For example, [Monolog](https://github.com/Seldaek/monolog) is a popular logging library for PHP.

## Configuring a Logger

A logger can be passed in to the `AmznSPAConfig` object:

```php
$config = new AmznSPAConfig(
    ...
    logger: new \Monolog\Logger('amazon-spa');
);
// Or dynamically
$config->setLogger(new \Monolog\Logger('amazon-spa'));
```

## Debugging Logs

All requests and responses related to Amazon are logged at the debug level.

#### Example Request Log
```
[AmznSPA] Pre-Request GET https://sellingpartnerapi-na.amazon.com/notifications/v1/subscriptions/ANY_OFFER_CHANGED
```

The context also contains the unsigned request headers and the request data as an array:

```php
var_dump($request_context);

array:2 [▼
  "unsigned_request_headers" => array:3 [▼
    "Host" => array:1 [▼
      0 => "sellingpartnerapi-na.amazon.com"
    ]
    "x-amz-access-token" => array:1 [▼
      0 => "Atza|..."
    ]
    "user-agent" => array:1 [▼
      0 => "Jasara.AmznSPA/0.1 (Language=PHP/8.0.10; Platform=...)"
    ]
  ]
  "request_data" => []
]
```

#### Example Response Log
```
[AmznSPA] Response GET https://sellingpartnerapi-na.amazon.com/notifications/v1/subscriptions/ANY_OFFER_CHANGED
```

The context also contains the response headers and the response data as an array:

```php
var_dump($response_context);

array:2 [▼
  "response_headers" => [
      ...
  ]
  "response_data" => array:1 [▼
    "payload" => array:3 [▼
      "subscriptionId" => "7fcacc7e-727b-11e9-8848-1681be663d3e"
      "payloadVersion" => "1.0"
      "destinationId" => "3acafc7e-121b-1329-8ae8-1571be663aa2"
    ]
  ]
]
```

## Exception Logging

When throwing an exception, the library will also call the logger at the error level.

```
[AmznSPA] Response Error GET https://sellingpartnerapi-eu.amazon.com/notifications/v1/subscriptions/ANY_OFFER_CHANGED -- HTTP request returned status code 403: {"error_description":"Client authentication failed","error":"invalid_client"}
```

The context contains as much information as possible about the request and the response.

```php
var_dump($exception_log_context);

array:5 [▼
  "unsigned_request_headers" => array:3 [▼
    "Host" => array:1 [▼
      0 => "sellingpartnerapi-eu.amazon.com"
    ]
    "x-amz-access-token" => array:1 [▼
      0 => "..."
    ]
    "user-agent" => array:1 [▼
      0 => "Jasara.AmznSPA/0.1 (Language=PHP/8.0.10; Platform=...)"
    ]
  ]
  "request_data" => []
  "response_headers" => []
  "response_data" => array:2 [▼
    "error_description" => "Client authentication failed"
    "error" => "invalid_client"
  ]
  "response_code" => 403
]
```




