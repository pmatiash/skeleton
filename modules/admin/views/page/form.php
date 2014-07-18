<?php
$this->breadcrumbs = array(
    _('Pages') => ('/admin/page/list'),
    $page->id ? _('Edit Page')." #".$page->id : _('New Page')
);
?>

<form method="post" action="/admin/page/save" role="form" class="form form-horizontal top-space" id="frmPage">
    <input type="hidden" name="id" value="<?php echo $page->id; ?>" />
    <div class="form-group top-space bottom-space">
        <label class="col-sm-2 control-label"><?php echo _('Page Url');?></label>
        <div class="col-sm-10 descrCnt">
            <input type="text" name="url" class="form-control" value="<?php echo $page->url; ?>" placeholder="Page Url" />
        </div>
    </div>
    <ul class="nav nav-tabs top-space">
        <li class="en"><a id="tab_en" href="#lang_en" data-toggle="tab"><img src="/images/flags/en.png" /></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane bottom-space" id="lang_en">
            <div class="form-group top-space">
                <label class="col-sm-2 control-label required"><?php echo _('Title');?></label>
                <div class="col-sm-10">
                    <input type="text" id="inpTitle" name="title" class="form-control" placeholder="Title" value="<?php echo $page->getTitle()?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo _('Page Description');?></label>
                <div class="col-sm-10 descrCnt">
                    <textarea id="txtDescr_en" class="form-control" name="description" rows="3" placeholder="Page Description"><?php echo $page->getDescription()?></textarea>
                </div>
            </div>
            <script type="text/javascript">
                tinymce.init({
                    selector: "#txtDescr_en",
                    height: 350,
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste moxiemanager"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    language: "en"
                });

            </script>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo _('Meta Keywords');?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="metaKeywords" placeholder="Meta Keywords" value="<?php echo $page->getMetaKeywords()?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo _('Meta Description');?></label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="metaDescription" placeholder="Meta Description"><?php echo $page->getMetaDescription()?></textarea>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Save">
    <span style="display: none;" class="status alert alert-danger"></span>
</form>

<script type="text/javascript">
    $('#tab_en').click();

    $.each($('.descrCnt'), function(){
        var $data = $(this).find('textarea').html();
        $(this).find('iframe').contents().find('body#tinymce').html($data);
    });

    $('#frmPage').form({
        onBeforeSubmit: function() {
            $('span.status').removeClass('alert-success').addClass('alert-danger');
            $.each($('.descrCnt'), function(){
                var $data = $(this).find('iframe').contents().find('body#tinymce').html();
                $(this).find('textarea').val($data);
            });
        },
        onSuccess: function(response) {
            if (response.error == 0) {
                $('span.status').removeClass('alert-danger').addClass('alert-success');
            }
            $('#frmPage input[name=id]').val(response.id);
            if(history.pushState) {
                history.pushState(null, null, '/admin/page/id/' + response.id);
            }
        }
    });
</script>