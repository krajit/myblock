<?php

$functions = [
    'block_myblock_save_message' => [
        'classname'   => 'block_myblock\external\save_message',
        'methodname'  => 'execute',
        'description' => 'Save message via AJAX',
        'type'        => 'write',
        'ajax'        => true,
        'capabilities'=> ''
    ]
];
