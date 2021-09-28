---
title: Resource - Notifications
description: 
extends: _layouts.documentation
section: content
---

# Notifications Resource

All of the Fulfillment Inbound endpoints are supported by this SDK.

Calling the method for the endpoint will return a data transfer object, from the `Jasara\AmznSPA\DataTransferObjects\Responses\FulfillmentInbound` namespace. [Read more about responses](/docs/responses).

<x-endpoint-component endpoint="getInboundGuidance" parameters="fulfillment-inbound/get-inbound-guidance" payload="fulfillment-inbound/GetInboundGuidanceResultSchema">
    <x-slot name="usage">
    $response = $spa->fulfillment_inbound->getInboundGuidance($marketplace_id); // GetInboundGuidanceResponse
    </x-slot>
</x-endpoint-component>

<x-endpoint-component endpoint="createInboundShipmentPlan" parameters="fulfillment-inbound/create-inbound-shipment-plan" payload="fulfillment-inbound/CreateInboundShipmentPlanResultSchema">
<x-slot name="usage">
$request = new CreateInboundShipmentPlanRequest(
    ... 
);

$response = $spa->fulfillment_inbound->createInboundShipmentPlan($request); // CreateInboundShipmentPlanResponse
</x-slot>
</x-endpoint-component>