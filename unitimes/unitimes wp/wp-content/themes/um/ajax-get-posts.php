<?php
require_once( __DIR__ . '/../../../wp-load.php' );
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
	global $paged;
	$ret = array('code'=>0,'data'=>'','page'=>$paged);
	$map = array(
		'page'=>$paged,
		'posts_per_page' => 8,
	);
	query_posts($map);
	if(have_posts()){
		$dom = new DOMDocument('1.0','UTF-8');
		while(have_posts()){
			the_post();
			$post = get_post();
			$body = $dom->createElement('div');
			$body->setAttribute('class','col-lg-4 col-md-4 col-sm-6 animate-box card-box fadeInUp animated-fast');
			$a = $dom->createElement('a');
			$a->setAttribute('href',get_the_permalink($post->ID));
			$a->setAttribute('class','fh5co-project-item image-popup');
			$figure = $dom->createElement('figure');
			$figure_div = $dom->createElement('div');
			$figure_div->setAttribute('class','overlay item-center');
			$card_inter = $dom->createElement('div',the_post_desc(32,false));
			$card_inter->setAttribute('class','card-intro');
			$figure_div->appendChild($card_inter);
			$figure_img = $dom->createElement('img');
			$figure_img->setAttribute('src',get_the_post_thumbnail_url($post->ID,'full'));
			$figure_img->setAttribute('class','img-responsive');
			$figure->appendChild($figure_div);
			$figure->appendChild($figure_img);
			$a->appendChild($figure);
			$text_div = $dom->createElement('div');
			$text_div->setAttribute('class','fh5co-text');
			$h = $dom->createElement('h2',get_the_title());
			$h->setAttribute('class','content-two-line');
			$text_div->appendChild($h);
			$post_time = $dom->createElement('div',um_get_date());
			$post_time->setAttribute('class','post-time');
			$text_div->appendChild($post_time);
			$post_stat = $dom->createElement('div');
			$post_stat->setAttribute('class','post-stat');
			$span_like = $dom->createElement('span',(int)get_post_meta($post->ID,'bigfa_ding',true));
			$span_like->setAttribute('class','post-like');
			$post_stat->appendChild($span_like);
			$span_review = $dom->createElement('span',$post->comment_count);
			$span_review->setAttribute('class','post-review');
			$post_stat->appendChild($span_review);
			$text_div->appendChild($post_stat);
			$a->appendChild($text_div);
			$body->appendChild($a);
			$dom->appendChild($body);
		}
		$ret['data'] = $dom->saveHTML();
		$ret['next_page'] = um_get_next_posts_page_link($post->max_num_pages);
		$ret['map'] = $map;
	}else{
		$ret['code'] = 1;
		$ret['desc'] = _e('没有更多相关文章');
	}
	header('Content-Type:application/json;charset=utf8');
	die(json_encode($ret));
}
?>