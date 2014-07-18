<?php /* @var $this BaseController */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="/favicon.ico">
    <title><?php echo $this->pageTitle; ?> :: <?php echo Yii::app()->name; ?></title>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin"><img src="/images/logo.png" style="height: 40px; margin-top: -10px;"/></a>
        </div>

        <div class="collapse navbar-collapse">
            <?php $this->widget('zii.widgets.CMenu', array(
                'htmlOptions'   => array(
                    'class' => 'nav navbar-nav',
                ),
                'items'=>array(
                    array(
                        'label' => _('Pages'),
                        'url' => ['/admin/page/list'],
                    ),
                    array(
                        'label' => _('Users'),
                        'url' => ['/admin/user/list'],
                    ),
                    array(
                        'label'     => _('Log'),
                        'url'       => ['/admin/log/index'],
                    ),
                ),
            )); ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin/user/<?php echo Yii::app()->user->getId(); ?>"><span class="glyphicon glyphicon-user"></span> <span id="userName"><?php echo Yii::app()->user->name; ?></span></a></li>
                <li><a href="/admin/auth/logout"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
        <div class="alert alert-<?php echo $key; ?>">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <?php echo $message; ?>
        </div>
    <?php endforeach; ?>
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'tagName' => 'ul',
            'htmlOptions' => array('class' => 'breadcrumb'),
            'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
            'inactiveLinkTemplate' => '<li class="active">{label}</li>',
            'separator' => '',
            'homeLink' => false,
            'links' => $this->breadcrumbs
        )); ?>
    <?php endif; ?>
    <?php echo $content; ?>
</div>

<div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<script type="text/javascript">
    $('#modal')
        .on('hidden.bs.modal', function() {
            $(this).removeData('bs.modal');
            $(this).find('.modal-content').empty();
        });
</script>
</body>
</html>
