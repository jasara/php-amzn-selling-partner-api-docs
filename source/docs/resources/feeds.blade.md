---
title: Resource - Feeds
description: 
extends: _layouts.documentation
section: content
---

# Feeds Resource

All of the Feeds endpoints are supported by this SDK.

Calling the method for the endpoint will return a data transfer object from the `Jasara\AmznSPA\DataTransferObjects\Responses\Feeds` namespace. [Read more about responses](/docs/responses).

<x-endpoint-component endpoint="getFeeds" parameters="feeds/get-feeds" payload="feeds/GetFeedsResponse">
    <x-slot name="usage">
$response = $spa->feeds->getFeeds(
    feed_types: ['POST_PRODUCT_DATA'], 
    marketplace_ids: ['ATVPDKIKX0DER'],
); // GetFeedsResponse
    </x-slot>
</x-endpoint-component>