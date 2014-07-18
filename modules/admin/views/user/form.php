<?php $this->breadcrumbs = array(
    'Users' => array('/admin/user/list'),
    $user->id ? _('Edit User')." #".$user->id : _('New User')
); ?>

<form method="POST" action ="/admin/user/save" id="frmUser">
    <input type="hidden" name="id" value="<?php echo $user->id; ?>" id="txtUserId" />

    <div class="form-group">
        <label><?= _('Email'); ?> <span class="required-asterisk">*</span></label>
        <input type="text" name="user[email]" class="form-control" value="<?php echo $user->email; ?>" placeholder="<?= _('Email'); ?>" autocomplete="off" />
    </div>

    <div class="form-group">
        <label><?= _('Password'); ?> <span class="required-asterisk">*</span></label>
        <input type="password" name="user[password]" class="form-control" placeholder="<?= _('Password'); ?>" autocomplete="off" />
    </div>

    <div class="form-group">
        <label><?= _('User Name'); ?></label>
        <input type="text" name="user[name]" class="form-control" value="<?php echo $user->name; ?>" placeholder="<?= _('User Name'); ?>" autocomplete="off" />
    </div>

    <div class="form-group">
        <label><?= _('Role'); ?></label>
        <select name="user[role]" class="form-control">
            <?php foreach(\Model\User::getRoleList() as $role => $roleCaption): ?>
                <option value="<?php echo $role; ?>"<?php if($role === $user->role) echo ' selected'; ?>>
                    <?php echo $roleCaption; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(function() {
            var currentUserId = <?= Yii::app()->user->id;?>;

            $('#frmUser').form({
                onSuccess: function(response) {
                    $('#txtUserId').val(response.id);

                    if (currentUserId == response.id) {
                        $('#userName').html(response.name);
                    }

                    if(history.pushState) {
                        history.pushState(null, null, '/admin/user/' + response.id);
                    }
                },
                modelToFormFieldName: function(field) {
                    return 'user\\[' + field + '\\]';
                }
            });
        });
    </script>
    <input type="submit" value="<?= _('Save'); ?>" class="btn btn-success" />
    <span class="status"></span>
</form>