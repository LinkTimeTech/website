<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/12/21
 * Time: 21:17
 */
function test_function(){
    add_menu_page( '首页设置', '首页设置', 'edit_themes', 'index_setting','display_function','',6);
}

function display_function(){
    if(isset($_POST['save_index_options'])){
        foreach($_POST as $key=>$value){
            if($key == 'save_index_options') continue;
            $old = get_option($key);
            if($old != $value){
                update_option($key,$value);
            }
        }
    }
    require_once(__DIR__ . '/admin/index_setting_form.php');
}
add_action('admin_menu', 'test_function');