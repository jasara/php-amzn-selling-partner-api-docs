<?php

$resource_children = [
    'Notifications' => 'docs/resources/notifications',
    'Fulfillment Inbound' => 'docs/resources/fulfillment-inbound',
    'Feeds' => 'docs/resources/feeds',
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
            'Logging & Debugging' => 'docs/logging-and-debugging',
        ],
    ],
    'Resources' => [
        'url' => '#resources',
        'children' => $resource_children,
    ],
];
