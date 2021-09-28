---
title: Responses
description: 
extends: _layouts.documentation
section: content
---

# Responses

After calling an endpoint method, a data transfer object will be returned containing the response from Amazon, formatted using their schema system. 

Generally, Amazon returns one or two root keys: `payload` and `errors`. The `errors` key will be returned as an <a href="#errorListSchema">`ErrorListSchema`</a>, and the `payload` will be the appropriate schema for the response.

## Data Transfer Objects
Each response is a data transfer object (DTO). <a href="https://github.com/spatie/data-transfer-object" target="_blank">Read more about data transfer objects.</a>

The benefit of using DTOs is that the response is typed and standardized, so you have type safety when using the response.

To use a DTO, access the expected results by using object keys. For example:

```php
$subscription = $spa->notifications->getSubscription($notification_type); // GetSubscriptionResponse DTO
$payload = $subscription->payload; // SubcriptionSchema
$errors = $subscription->errors; // ErrorListSchema

$subscription_id = $subscription->payload->subscription_id; // string
```

Some properties on DTOs are <a href="https://laravel.com/docs/8.x/collections" target="_blank">Collections</a>. See the example for the ErrorListSchema to see how you might use a collection.

Any DTO can be transformed into an array by calling `toArray` on the DTO.

## ErrorListSchema
<a name="errorListSchema"></a>

The ErrorListSchema is a collection of ErrorSchema objects. You can use all the collection methods on the ErrorListSchema. For example:

```php
$subscription = $spa->notifications->getSubscription($notification_type); // GetSubscriptionResponse DTO
$errors = $subscription->errors; // ErrorListSchema
$first_error = $subscription->errors->first(); // ErrorSchema
$invalid_client_error = $subscription->errors->where('code', 'invalid_client')->first(); // ErrorSchema
```

## ErrorSchema

The ErrorSchema contains the following keys:

<x-table.base>
    <x-slot name="headings">
        <x-table.th>Key</x-table.th>
        <x-table.th>Description</x-table.th>
        <x-table.th>Type</x-table.th>
    </x-slot>

    <tr class="bg-white">
        <x-table.td><code>code</code></x-table.td>
        <x-table.td>An error code that identifies the type of error that occurred.</x-table.td>
        <x-table.td>
            <x-badge colour="blue">string</x-badge>
        </x-table.td>
    </tr>
    <tr class="bg-white">
        <x-table.td><code>message</code></x-table.td>
        <x-table.td>A message that describes the error condition in a human-readable form.</x-table.td>
        <x-table.td>
            <x-badge colour="blue">string</x-badge>
        </x-table.td>
    </tr>
    <tr class="bg-white">
        <x-table.td><code>details</code></x-table.td>
        <x-table.td>Additional details that can help the caller understand or fix the issue.</x-table.td>
        <x-table.td>
            <x-badge colour="blue">string</x-badge>
        </x-table.td>
    </tr>
</x-table.base>

