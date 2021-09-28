<?php

$resource_children = [
    'Notifications' => 'docs/resources/notifications',
    'Fulfillment Inbound' => 'docs/resources/fulfillment-inbound',
];

ksort($resource_children);

return [
    'Getting Started' => [
        'url' => 'docs/getting-started',
        'children' => [
            'Installation' => 'docs/installation',
            'Authorizing Accounts' => 'docs/authorization',
            'Migrating From MWS' => 'docs/migrating-from-mws',
            'Authenticating Requests' => 'docs/authentication',
        ],
    ],
    'Resources' => [
        'url' => '#resources',
        'children' => $resource_children,
    ],
];
