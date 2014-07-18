<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'), array(
        'modules' => array(
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => 'skeleton123',
            ),
        ),
    )
);
