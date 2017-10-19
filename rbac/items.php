<?php
return [
    'adminBlog' => [
        'type' => 2,
        'description' => 'Admin blog',
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'adminBlog',
        ],
    ],
];
