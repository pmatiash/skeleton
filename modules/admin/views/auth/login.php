<?php
/* @var $this AuthController */

$this->pageTitle = 'Login';
?>

<div class="row-fluid" style="margin-top: 100px;">
    <form method="post" action="<?= $this->createUrl('login'); ?>" class="form col-md-3 col-md-offset-4" role="form">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="/images/logo.png" />
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" name="email" placeholder="<?= _('Email'); ?>" autocomplete="off" maxlength="50" />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-asterisk"></span></span>
                <input type="password" class="form-control" name="password" placeholder="<?= _('Password'); ?>" autocomplete="off" maxlength="50" />
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="1"/> Remember me
                </label>
            </div>
        </div>
        <div>
            <?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
                <div class="alert alert-<?php echo $key; ?>">
                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                    <?php echo $message; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-default" value="Login" />
        </div>
    </form>
</div>