---
title: Resource - Notifications
description: 
extends: _layouts.documentation
section: content
---

# Notifications Resource

All of the notifications endpoints are supported by this SDK.

Several of the endpoints use grantless authorization. This will be handled automatically, but if you would like to store/cache the access token rather than generate a new one for each call, you can follow the instructions in the [authentication](/docs/authentication) section.

Calling the method for the endpoint will return a data transfer object, from the `Jasara\AmznSPA\DataTransferObjects\Responses\Notifications` namespace. [Read more about responses](/docs/responses).

<x-endpoint-component endpoint="getSubscription" parameters="notifications/get-subscription" payload="notifications/SubscriptionSchema">
    <x-slot name="usage">
    $response = $spa->notifications->getSubscription($notification_type); // GetSubscriptionResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="createSubscription" parameters="notifications/create-subscription" payload="notifications/SubscriptionSchema">
    <x-slot name="usage">
    $response = $spa->notifications->createSubscription($notification_type, $payload_version, $destination_id); // CreateSubscriptionResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="getSubscriptionById" parameters="notifications/get-subscription-by-id" payload="notifications/SubscriptionSchema">
    <x-slot name="usage">
    $response = $spa->notifications->getSubscriptionById($notification_type, $subscription_id); // GetSubscriptionByIdResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="deleteSubscriptionById" parameters="notifications/delete-subscription-by-id">
    <x-slot name="usage">
    $response = $spa->notifications->deleteSubscriptionById($notification_type, $subscription_id); // DeleteSubscriptionByIdResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="getDestinations" payload="notifications/DestinationListSchema">
    <x-slot name="usage">
    $response = $spa->notifications->getDestinations(); // GetDestinationsResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="createDestination" parameters="notifications/create-destination">
    <x-slot name="usage">
    $response = $spa->notifications->createDestination($name, new DestinationResourceSpecificationSchema()); // CreateDestinationResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="getDestination" parameters="notifications/get-destination" payload="notifications/DestinationSchema">
    <x-slot name="usage">
    $response = $spa->notifications->getDestination($destination_id); // GetDestinationResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="deleteDestination" parameters="notifications/delete-destination">
    <x-slot name="usage">
    $response = $spa->notifications->deleteDestination($destination_id); // DeleteDestinationResponse
    </x-slot>
</x-endpoint-component>