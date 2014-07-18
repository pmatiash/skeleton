<?php

$this->breadcrumbs = array(
    'Лог'
);

 $this->widget('GridView', array(
    'dataProvider' => $dataProvider,
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'logtime',
            'header' => _('Date'),
            'value' => '$data->getTime("d.m.Y H:i:s")',
            'htmlOptions'=>array('width'=>'200px'),
        ),
        array(
            'name' => 'level',
            'header' => _('Type'),
            'htmlOptions'=>array('width'=>'200px'),
        ),
        array(
            'name' => 'category',
            'header' => _('Category'),
            'htmlOptions'=>array('width'=>'200px'),
        ),
        array(
            'name' => 'message',
            'header' => _('Message'),
            'value' => 'htmlspecialchars($data->message)',
            'type' => 'raw',
            'htmlOptions' => ["style"=>"width: 100%;"]
        ),
    )
));