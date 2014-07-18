<?php

return array(
    /**
     * Roles
     */
    'guest' => array(
        'type'          => CAuthItem::TYPE_ROLE,
        'description'   => 'Guest',
        'bizRule'       => null,
        'data'          => null
    ),
    'user' => array(
        'type'          => CAuthItem::TYPE_ROLE,
        'description'   => 'User',
        'bizRule'       => null,
        'data'          => null,
        'children'      => array(
            'guest',
        ),
    ),
    'admin' => array(
        'type'          => CAuthItem::TYPE_ROLE,
        'description'   => 'Administrator',
        'bizRule'       => null,
        'data'          => null,
        'children'      => array(
        ),
    ),
);