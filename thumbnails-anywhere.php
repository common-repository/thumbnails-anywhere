<?php
/*
Plugin Name: Thumbnails Anywhere
Version: 1.0
Description: Add image thumbnails anywhere in your content (including sidebar & footer)
Author: Nina @ ninanet site solutions & inlineVision
Author URI: http://ninanet.com http://inlinevision.com
Plugin URI: http://ninanet.com/dev_thumbnails-anywhere.php

*/
?>
<?
global $wp_version;
$exit_msg='Thumbnails Anywhere requires WordPress 2.9 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
if (version_compare($wp_version,"2.9","<")) { exit ($exit_msg); }

// thumbnail randomizer 
function random_img($atts, $content = null) {
	 extract(shortcode_atts(array(
	    "cat" => '',
	    "num" => '',
		"thumb"	=> '',
		"w" => '',
		"h" => '',
		"css" => '',
		"showlink" => '',
		"post" => ''
	 ), $atts));
	// initiate some vars: our output $thout and the counter $ct, and the $style string
	$style = "";
	$thout = "";
	$ct = 0;
	$pp = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	if(!$num) {$num = 2;}
	if($css != '') {$style = " style='".$css."'";}
	if($w == '' || !$w) {$w = "100";}
	if($h == '' || !$h) {$h = "100";}
	query_posts('cat='.$cat.'&posts_per_page='.$num.'&orderby=rand&p='.$post );
		
	if (have_posts()) : 
		$thout = "<div style='' class='thumbany'>";
		while (have_posts()) : the_post();
			// increment counter
			$ct++;
			// need to set $post global - it's a loop within the loop
			global $post;
			if($ct <= $num) {
				$title = get_the_title($post->ID);
				$link = "<br><h6><a href='".get_permalink($post->ID)."'>".$title."</a></h6>";
				
				// first - get meta full_image_value - important for MU installs (changed in 0.9)
				if(get_post_meta($post->ID, 'full_image_value', true) != '') {
					$thimg = get_post_meta($post->ID, 'full_image_value', true);
				// else: get thumbnail - if we have one	
				} elseif ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				  	$iurl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				   	$thimg = $iurl[0];
				// else - show default image	
				} else {
					$thimg = $pp."comingsoon.jpg";
				}
				// auto-take care of absolute URLs in WP / causes issues especially on hostgator installations
				$srv_name = $_SERVER['SERVER_NAME'];
				$full_dom = "http://".$srv_name;
				if(strpos($thimg, "http") !== false) {
					$thimg = str_replace($full_dom, "", $thimg);
				}
				// -- end HG/WP absolute URL issue (added in 0.8)
				
				
				$thout .= "<div style='' class='thumbany2'><a href='".$thimg."' rel='prettyPhoto' title='".$title."'><img src='".$pp."timthumb.php?src=".$thimg."&w=".$w."&h=".$h."&zc=1&aq=90' alt='".$title."'  class='dimg' ".$style." width='".$w."' height='".$h."' /></a>";
				if($showlink) {$thout .= $link;}
				$thout .= "</div>";
			} else {$thout .= "<div style='clear:both;height:10px'></div>";}
		endwhile; 
		$thout .= "<div style='clear:both;height:10px'></div></div>";
	endif;
	// DO NOT forget to reset query :) Funny results if you don't.  
	// Also notable the difference in results if you switch the last two lines ;)
	wp_reset_query();
	// spit out images as requested
	return $thout;
}
add_shortcode("randomimg", "random_img");

add_action('wp_print_styles', 'ri_styles');
    // Enqueue style-file, if it exists.
    function ri_styles() {
        $ris_url = WP_PLUGIN_URL . '/thumbnails-anywhere/style.css';
        $ris_file = WP_PLUGIN_DIR . '/thumbnails-anywhere/style.css';
        if ( file_exists($ris_file) ) {
            wp_register_style('ris_styles', $ris_url);
            wp_enqueue_style( 'ris_styles');
        }
    }

?>
