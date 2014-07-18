<?php $this->breadcrumbs = array('Users'); ?>

<div class="btn-toolbox" style="margin-bottom: 10px;">
    <a href="/admin/user/new" class="btn btn-info btn-xs">
        <span class="glyphicon glyphicon-plus"></span> <?= _('Add'); ?>
    </a>
</div>

<div id="cntUserList">
    <table class="table table-striped table-hover">
        <col/><col/><col/><col width="100px" />
        <tr>
            <th><?= _('Name'); ?></th>
            <th><?= _('Email'); ?></th>
            <th><?= _('Role'); ?></th>
            <th></th>
        </tr>
        <?php foreach ($userList as $user): ?>
            <tr>
                <td><?php echo $user->name; ?></td>
                <td><a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></td>
                <td><?php echo $user->role; ?></td>
                <td>
                    <a class="update" href="/admin/user/<?php echo $user->id; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a class="delete btnDropUser" href="/admin/user/delete/<?php echo $user->id; ?>">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php $this->widget('TbPager', array('pages' => $pagination)); ?>
</div>

<script type="text/javascript">
    // delete user
    $('.btnDropUser').click(function(e) {
        e.preventDefault();
        var $a = $(this);
        if(!confirm("Do you really want to delete this user?")) {
            return false;
        }
        $.get($a.attr('href'), function(response) {
            if(response.error == 1) {
                alert(response.errorMessage);
                return;
            }
            $a.closest('tr').fadeOut(function() {
                $a.closest('tr').remove();
            });
        });
    });
</script>