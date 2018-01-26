<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/12/21
 * Time: 21:40
 */
wp_enqueue_media();
?>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<div class="container">

    <div class="page-header"></div>
    <form method="post" class="form-horizontal" name="index-setting" id="index-setting">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    首页文字(中文)
                </label>
                <div class="col-sm-10">
                    <input type="text" name="index_message_zh" value="<?php echo get_option( 'index_message_zh' ); ?>"
                           class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    首页文字(英文)
                </label>
                <div class="col-sm-10">
                    <input type="text" name="index_message_en" value="<?php echo get_option( 'index_message_en' ); ?>"
                           class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    首页动态文字(中文)
                </label>
                <div class="col-sm-10">
                    <input type="text" name="index_dy_message_zh"
                           value="<?php echo get_option( 'index_dy_message_zh' ); ?>" class="form-control" placeholder="两个动态字用逗号(,)分隔">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    首页动态文字(英文)
                </label>
                <div class="col-sm-10">
                    <input type="text" name="index_dy_message_en"
                           value="<?php echo get_option( 'index_dy_message_en' ); ?>" class="form-control" placeholder="两个动态字用逗号(,)分隔">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    首页视频
                </label>
                <div class="col-sm-10">
                    <input type="text"  name="index_video_url"
                           value="<?php echo get_option( 'index_video_url' ); ?>" class="form-control">
                    <button id="index_video_url" class="ashu_upload_button btn btn-primary">上传</button>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    独角时代图片
                </label>
                <div class="col-sm-10">
                    <input type="text"  name="about_image_url"
                           value="<?php echo get_option( 'about_image_url' ); ?>" class="form-control">
                    <button id="about_image_url" class="ashu_upload_button btn btn-primary">上传</button>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    独角时代图片中文字
                </label>
                <div class="col-sm-10">
                    <input type="text"  name="about_image_font_zh"
                           value="<?php echo get_option( 'about_image_font_zh' ); ?>" class="form-control">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label no-padding-right col-sm-2">
                    独角时代图片英文字
                </label>
                <div class="col-sm-10">
                    <input type="text"  name="about_image_font_en"
                           value="<?php echo get_option( 'about_image_font_en' ); ?>" class="form-control">

                </div>
            </div>
            <div class="form-group">
                <input type="hidden" value="1" name="save_index_options"/>
                <button class="btn btn-primary">保存</button>
            </div>
        </div>

    </form>

</div>
<script>
    jQuery(document).ready(function () {
        var ashu_upload_frame;
        var value_id;
        jQuery('.ashu_upload_button').live('click', function (event) {
            value_id = jQuery(this).attr('id');
            event.preventDefault();
            if (ashu_upload_frame) {
                ashu_upload_frame.open();
                return;
            }
            ashu_upload_frame = wp.media({
                title: 'Insert image',
                button: {
                    text: 'Insert',
                },
                multiple: false
            });
            ashu_upload_frame.on('select', function () {
                attachment = ashu_upload_frame.state().get('selection').first().toJSON();
                jQuery('input[name=' + value_id + ']').val(attachment.url);
            });
            
            ashu_upload_frame.open();
        });
    });
</script>