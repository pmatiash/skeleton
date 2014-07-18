<?php

$this->breadcrumbs = array(
    _('Pages')
);
?>

<div class="btn-toolbox">
    <a href="/admin/page/new" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-plus"></i> <?=_('Add');?></a>
</div>

<div>
    <?php $this->widget('GridView', array(
        'id' => 'pages-grid',
        'dataProvider' => $dataProvider,
        'itemsCssClass' => 'table table-hover table-striped table-condensed',
        'pagerCssClass' => 'pagination',
        'columns' => array(
            array(
                'name' => 'id',
            ),
            array(
                'name' => 'url',
                'type' => 'html',
                'value' => 'CHtml::link($data["url"], $data["url"])',
            ),
            array(
                'name' => 'title',
                'type' => 'html',
                'value' => 'CHtml::link($data->getTitle(), "/admin/page/" . $data["id"])',
            ),
            array(
                'class' => '\TbButtonColumn',
                'template' => '{update} {delete}',
                'deleteButtonUrl' => 'Yii::app()->createUrl("admin/page/delete", array("id" =>  $data["id"]))',
                'updateButtonUrl' => '"/admin/page/" . $data["id"]',
            ),
        ),
    )); ?>
</div>