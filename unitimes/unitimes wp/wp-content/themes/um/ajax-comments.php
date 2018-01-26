<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/12/13
 * Time: 17:32
 */

require_once( __DIR__ . '/../../../wp-load.php' );
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    nocache_headers();
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
    $user = wp_get_current_user();
    do_action( 'set_comment_cookies', $comment, $user );
    // comment_class();
}
?>