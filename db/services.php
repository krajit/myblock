<?php

$functions = [
    'block_myblock_save_message' => [
        'classname'   => 'block_myblock\external\save_message',
        'methodname'  => 'execute',
        'description' => 'Save message via AJAX',
        'type'        => 'write',
        'ajax'        => true,
        'capabilities'=> ''
    ],
    'block_myblock_get_messages' => [
        'classname'   => 'block_myblock\external\get_messages',
        'methodname'  => 'execute',
        'description' => 'Get saved messages for current user',
        'type'        => 'read',
        'ajax'        => true,
    ]

];
