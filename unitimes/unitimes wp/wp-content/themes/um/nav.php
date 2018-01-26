<?php
/**
 * Created by PhpStorm.
 * User: Sweerinn
 * Date: 2017/11/17
 * Time: 15:07
 */
?>

<ul class="u-textAlignLeft u-noWrap   u-paddingLeft20 u-paddingRight20 u-sm-paddingLeft20 u-sm-paddingRight20">
	<li class="link--mbda metabar-navItem u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
		<a class="link <?php nav_select(2);?> link--darken u-accentColor--textDarken  u-baseColor--link ui-linkSubtle"
		   href="<?php echo get_category_link(2);?>">
			<!----><?php echo _e('独角访谈','um');?>
		
		</a>
	</li>
	<li class="metabar-navItem  u-uiTextMedium u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
		<a class="link <?php nav_select(3);?>  link--darken u-accentColor--textDarken link--noUnderline u-baseColor--link ui-linkSubtle"
		   href="<?php echo get_category_link(3);?>">
			<!----><?php echo _e('新闻','um');?>
			<?php //echo __('news')?>
		</a>
	</li>
	<li class="metabar-navItem metabar-twonav metabar-<?php echo get_locale();?>  u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
		<a class="link <?php nav_select(5);?> link--darken u-accentColor--textDarken link--noUnderline u-baseColor--link ui-linkSubtle"
		   href="<?php echo get_category_link(5);?>">
			<?php echo _e('知识库','um');?>
		</a>
        <ol class="metabar-twonavmenu">
        	<li><a href="<?php echo get_category_link(349);?>"><?php _e('白皮书','um');?></a></li>
            <li><a href="<?php echo get_category_link(245);?>"><?php _e('特约作者','um');?></a></li>
            <li><a href="<?php echo get_category_link(350);?>"><?php _e('技术文章','um');?></a></li>
            <li><a href="<?php echo get_category_link(368)?>"><?php _e('其他','um');?></a></li>
        </ol>
	</li>
	<li class="metabar-navItem  u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
		<a class="link <?php nav_select(4);?> link--darken u-accentColor--textDarken link--noUnderline u-baseColor--link ui-linkSubtle"
		   href="<?php echo get_category_link(4);?>">
			<?php echo _e('活动','um');?>
		</a>
	</li>
	<span class="u-borderLeft1 u-paddingLeft22 u-xs-paddingLeft12 u-baseColor--borderLight"></span>
	<li class="metabar-navItem  is-external u-uiTextMedium u-xs-fontSize11 u-fontSize14 u-inlineBlock u-textUppercase u-letterSpacing003 u-textColorNormal u-xs-paddingRight12 u-xs-marginRight0 u-paddingTop5 u-xs-paddingTop10">
		<a class="link link--darkenOnHover link--darken u-accentColor--textDarken link--noUnderline u-baseColor--link ui-linkSubtle"
		   href="/">
			<?php echo _e('首页','um');?>
		</a>
	</li>
</ul>
