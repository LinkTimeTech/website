<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/17
 * Time: 14:43
 */


if (have_comments()) {
    $dom = new \DOMDocument('1.0','UTF-8');
    echo create_comment_template('',$dom);
    
}

?>

