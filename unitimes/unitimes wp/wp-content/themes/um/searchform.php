<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/22
 * Time: 17:31
 */
$unique_id = esc_attr( uniqid( 'search-form-' ) );
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="J_searchForm">
	<input placeholder="<?php echo _e('搜索','um');?>" class="J_searchInput" type="text" name="s">
	<input value="<?php echo _e('搜索','um');?>" class="J_search-btn" type="submit">
</form>
