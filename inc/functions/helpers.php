<?php
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function get_unattached_image($size = 'full') {
	global $post;

	$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($photos) {
		foreach ( $photos as $photo )	{
			$src = wp_get_attachment_url( $photo->ID );
		}
	}

	return $src;
}

/**
 * Helper function to call timthumb images
 *
 * @param	string $src  The absolute URL of image.
 * @param	int $height  The desired image height.
 * @param	int $width  The desired image width.
 * @param	string $position  Position of the crop, will default to 'center'.
 * @param	int $crop  The crop method. Default value is 1.
 * @param	int $quality  Quality of the cropped image. Default is 99.
 *
 * @return	Generated timthumb url
 *
 * @author d.latoga
 *
 *  Postion values
 *	c : position in the center (this is the default)
 *	t : align top
 *	tr : align top right
 *	tl : align top left
 *	b : align bottom
 *	br : align bottom right
 *	bl : align bottom left
 *	l : align left
 *	r : align right
 */
function get_resized_image($src, $height, $width, $position = "c", $crop = "1", $quality = "99"){
	if ($position) $pos = "&amp;a={$position}";
	return get_bloginfo('template_url') . "/inc/timthumb.php?src={$src}&amp;h={$height}&amp;w={$width}&amp;zc={$crop}&amp;q={$quality}" . $pos;
}

/**
 * Variable & intelligent excerpt length
 *
 * @param	int $length  Length of excerpt in characters
 * @param	int $apply_filters
 *
 *
 */

function print_excerpt( $length, $apply_filters = 1 ) {
	global $post;
	$text = $post->post_excerpt;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}
	$text = strip_shortcodes($text); // optional, recommended
	$text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

	$text = substr($text,0,$length);
	$excerpt = reverse_strrchr($text, ' ', 1);

	if ( $apply_filters == 1 ) :
		if( $excerpt ) {
			echo apply_filters('the_excerpt',$excerpt);
		} else {
			echo apply_filters('the_excerpt',$text);
		}
	else :
		if( $excerpt ) {
			echo $excerpt;
		} else {
			echo $text;
		}
	endif;
}

// custom pagination
function int_pagination($pages = '', $pageslug = ''){
	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){
			$pages = 1;
		}
	}

	if(1 != $pages){
		echo '<div class="navigation">';
		if($paged - 1 != 0){
			echo "<a href='".get_pagenum_link($paged - 1)."' class=\"pagination-previous pagination-nav\">Previous</a>";
		} else {
			echo "<span>Previous</span>";
		}

		echo ' | ' . '<a href="' . home_url() .'/' . $pageslug . '/?list_all=true">List All</a>' . ' | ';

		if ($paged != $pages){
			echo "<a href='".get_pagenum_link($paged + 1)."' class=\"pagination-next pagination-nav\">Next</a>";
		} else {
			echo '<span>Next</span>';
		}

		echo "</div>\n";
	}
}