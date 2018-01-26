<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/17
 * Time: 14:32
 */
header('Location:/?lang='.substr(get_locale(),0,2));
// echo "<pre>";
// debug_print_backtrace();
die('404');