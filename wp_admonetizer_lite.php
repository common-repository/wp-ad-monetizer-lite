<?php
/*
Plugin Name: WP Ad-Monetizer Lite
Plugin URI: http://mlxplugins.com/wp-ad-monetizer-lite
Description: WP Ad-Monetizer is a WordPress Plugin that gives option for Ad-banners or any Ad-sense codes in different Ad-group / Ad-block. Each Ad-block is defined to use on WordPress template using Widgets or custom coding in theme. An Ad-block have several option for showing Ads using ready shortcode to place on any widget/theme page.
Version:1.0  
Author: MindLogix Techologies

License: 
Copyright 2015  
*/

 set_time_limit(0);

include_once('meta-template.php');

add_action('admin_init', 'load_wpadm_lite_scripts');
function load_wpadm_lite_scripts(){
	wp_register_script( 'custom_mxlad_js',  plugins_url( 'js/mlxad_script.js' , __FILE__ )  );
	wp_enqueue_script( 'custom_mxlad_js' );
	wp_register_style( 'custom-mlxad-style_css',  plugins_url( 'css/custom-mlxad-style.css' , __FILE__ )  );
	wp_enqueue_style( 'custom-mlxad-style_css' );
	wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
}

add_action( 'init', 'create_wpadm_lite_blocks' );
	function create_wpadm_lite_blocks() {
	
		$labels = array(
			'name' => 'Ad Blocks',
			'singular_name' => 'Ad Blocks',
			'add_new' => 'Add New',
			'add_new_item' => 'Ad Block Name',
			'edit_item' => 'Ad Blocks Name',
			'new_item' => 'New Ad Blocks',
			'view_item' => 'view',
			'search_items' => 'Search Ad Blocks',
			'not_found' =>  'Nothing found',
			'not_found_in_trash' => 'Nothing found in Trash',
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => true,
			'supports' => array('title')
		); 
		  
		register_post_type( 'mlx_ad_blocks' , $args);
		


		
	}	

add_action( 'init', 'create_mlxads' );	
	function create_mlxads() {
	
		$labels = array(
			'name' => 'WP Ad-Monetizer',
			'singular_name' => 'WP Ad-Monetizer',
			'add_new' => 'Add New',
			'add_new_item' => 'WP Ad-Monetizer Name',
			'edit_item' => 'WP Ad-Monetizer Name',
			'new_item' => 'New WP Ad-Monetizer',
			'view_item' => 'View',
			'search_items' => 'Search Ad',
			'not_found' =>  'Nothing found',
			'not_found_in_trash' => 'Nothing found in Trash',
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => true,
			'supports' => array('title')
		); 
		  
		register_post_type( 'mlx_ads' , $args);
	}


/***********************************************/
// MLX AD BLOCKS 

	$show_on_opt = array('all_posts' => 'All Posts',
						 'all_pages' => 'All Pages' 
		 				 //'all_categories' => 'All Categories'
						 );
						 
	function getallposts()
	{
		$args = array(
	'posts_per_page'  => -1,	'offset'          => 0,	'category'        => '',	'orderby'         => 'post_date',
	'order'           => 'DESC',	'include'         => '',	'exclude'         => '',
	'meta_key'        => '',	'meta_value'      => '',	'post_type'       => 'post',
	'post_mime_type'  => '',	'post_parent'     => '',	'post_status'     => 'publish',	'suppress_filters' => true );

		$all_posts = get_posts($args); 
		foreach ( $all_posts as $page ) {
  			$pages [$page->ID] =  $page->post_title;	
	  	}
		return $pages;
	}
	
	function getallpages()
	{
		$args = array(
			'sort_order' => 'ASC',	'sort_column' => 'post_title',		'hierarchical' => 1,
			'exclude' => '',		'include' => '',		'meta_key' => '',
			'meta_value' => '',		'authors' => '',		'child_of' => 0,
			'parent' => -1,			'exclude_tree' => '',	'number' => '',
			'offset' => 0,			'post_type' => 'page',	'post_status' => 'publish'
		); 
		$all_pages = get_pages($args); 
		foreach ( $all_pages as $page ) {
  			$pages [$page->ID] =  $page->post_title;	
	  	}
		return $pages;
	}	



						 
	//$ad_block_format = array('single_ad' => 'Single Ad', 'link_ad' => 'Link Ad');					 
	$ads_post_type = array('all_posts' => 'All Posts', 'selected_posts' => 'Only Selected Posts');
	$ads_page_type = array('all_pages' => 'All Pages', 'selected_pages' => 'Only Selected Pages');
	$ads_cat_type = array('all_cats' => 'All Category Pages', 'selected_cats' => 'Only Selected Categories');
	
	$spec_ad_slides = array('single_slide' => 'Single Slide', 'multiple_slide' => 'Multiple Slide');
	
	
	
	
	$ads_otherpage_type = array('all_otherpages' => 'All Other Pages', 'selected_otherpages' => 'Only Selected Other Pages');
	
		

	
	
	$mlx_adblocks_meta_boxes = array(
		"Shortcode box" => array(
			'title'=>'Shortcode',
			'name'=>'mlx_shortcode_box',
			'type'=>'shortcodebox',
			'description'=>"use above shortcode in any theme/widget to show this Ad Block ",
			'hr'=>'none'),
		
		"Ad Slides" => array(
			'title'=>'Slides Settings',
			'name'=>'spec-ad-slides',
			'type'=>'radio',
			'options'=>$spec_ad_slides,
			//'description'=>"",
			'default'=>"single_slide",
			'hr'=>'none'
			),	
		// slider settings started here
		"No. of Ad" => array(
			'title'=>'No. of Ad per block',
			'name'=>'slider_no_of_ads',
			'type'=>'inputtext',
			'default'=>'5',
			'description'=>"2 or more Ads will be shown in a slider,default is 5",
			'hr'=>'none'
			),	
			
		"slider autoplay" => array(
			'title'=>'AutoPlay Slider',
			'name'=>'slider_autoplay',
			'type'=>'radio',
			'options'=> array('true' => 'Yes', 'false' => 'No'),
			//'description'=>"",
			'default'=>"true",
			'hr'=>'none'
			),	
		"autoplay after" => array(
			'title'=>'Slide Auto-play after seconds',
			'name'=>'slider_autoplay_after',
			'type'=>'inputtext',
			'default'=>'5000',
			'description'=>"Slide will auto-play after given milli seconds, default 5000",
			'hr'=>'none'),			
		
		"stop on hover" => array(
			'title'=>'Stop Slider on Mouse Hover',
			'name'=>'slider_stop_on_hover',
			'type'=>'radio',
			'options'=> array('true' => 'Yes', 'false' => 'No'),
			//'description'=>"",
			'default'=>"true",
			'hr'=>'none'
			),	
		"slider pagination" => array(
			'title'=>'Show Slider Pagination',
			'name'=>'slider_pagination',
			'type'=>'radio',
			'options'=> array('true' => 'Yes', 'false' => 'No'),
			//'description'=>"",
			'default'=>"true",
			'hr'=>'none'
			),		
		
		"slider transition" => array(
			'title'=>'Slide Transition Style',
			'name'=>'slider_transition',
			'type'=>'combobox',
			'options'=>array(	'slide' => 'Slide',
								'fade' => 'Fade',
								'backSlide' => 'backSlide',
								'goDown' => 'goDown',
								'fadeUp' => 'fadeUp',),
			'description'=>"",
			'default'=>"slide",
			'hr'=>'none'),
			
		
		"Show on posts" => array(
			'title'=>'Show on Posts',
			'name'=>'spec-ads-post-type',
			'type'=>'radio',
			'options'=>$ads_post_type,
			'default'=>"all_posts",
			'hr'=>'none'
			),	
		
		"Show on Posts" => array(
			'title'=>__('All Posts'),
			'name'=>'spec-ads-posts',
			'type'=>'multi_select',
			'default'=>array(),
			'options'=> getallposts(),
			'description'=>"Select Posts to display this Ad Block most preferable.",
			'hr'=>'none'),	
			
		"Show on pages" => array(
			'title'=>'Show on Pages',
			'name'=>'spec-ads-page-type',
			'type'=>'radio',
			'options'=>$ads_page_type,
			//'description'=>"",
			'default'=>"all_pages",
			'hr'=>'none'
			),	
			
		"Show on Pages" => array(
			'title'=>__('Show on Pages'),
			'name'=>'spec-ads-pages',
			'type'=>'multi_select',
			'default'=>array(),
			'options'=> getallpages(),
			'description'=>"Select Pages to display this Ad Block most preferable.",
			'hr'=>'none'),	
			
		"Show on category pages" => array(
			'title'=>'Show on Category Pages',
			'name'=>'spec-ads-cat-type',
			'type'=>'radio',
			'options'=>$ads_cat_type,
			'default'=>"all_cats",
			'hr'=>'none'
			),		
			
		"Show on Category Pages" => array(
			'title'=>__('Show on Category Pages'),
			'name'=>'spec-ads-categories',
			'type'=>'pro_avail_template',
			'description'=>"Select Category Pages to display this Ad Block most preferable.",
			'hr'=>'none'),			
		
		"Show on other pages" => array(
			'title'=>'Show on Other Pages',
			'name'=>'spec-ads-otherpage-type',
			'type'=>'radio',
			'options'=> $ads_otherpage_type,
			'default'=>"all_otherpages",
			'hr'=>'none'),	
			
		"Show on other Pages" => array(
			'title'=>__('All Other Pages'),
			'name'=>'spec-ads-otherpages',
			'type'=>'pro_avail_template',
			'description'=>"Select Pages to display this Ad Block most preferable.",
			'hr'=>'none'),
			
		"Show on countries" => array(
			'title'=>'Show on Countries',
			'name'=>'spec-ads-countries',
			'type'=>'radio',
			'options'=> array('all_countries' => 'All countries','selected_countries' => 'Selected Countries'),

			'default'=>"all_countries",
			'hr'=>'none'),	
			
		"Show on countries list" => array(
			'title'=>__('List of Countries'),
			'name'=>'spec-ads-countries-list',
			'type'=>'pro_avail_template',
			'default'=>array(),
			'options'=> $spec_ads_countries_list, 
			'description'=>"Select Countries to display this Ad Block most preferable.",
			'hr'=>'none'),	
		
		
	);	
	
	
	add_action('add_meta_boxes', 'add_mlx_ad_blocks_option');
	function add_mlx_ad_blocks_option(){	
	
		add_meta_box('mlx-ad-block-option', 'Ad-Block Settings', 'add_mlx_adblock_option_element',
			'mlx_ad_blocks', 'normal', 'high');
			
		add_meta_box('wpadm-lite-doc', 'Documentation', 'wpadm_lite_doc_option_element',
			'mlx_ad_blocks', 'normal', 'high');	
	}	
	
	function wpadm_lite_doc_option_element(){
	
	
	
		wpadm_print_meta(array('type'=>'doc_template'));
	
	}
	
	function add_mlx_adblock_option_element(){
	
		global $post, $mlx_adblocks_meta_boxes;
		echo '<div id="gdl-overlay-wrapper">';
		
		?> 
		
		
		<div class="testimonial-option-meta" id="testimonial-option-meta"> <?php
		
			set_nonce();
			
			foreach($mlx_adblocks_meta_boxes as $meta_box){
				//echo "here ";

				$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				wpadm_print_meta($meta_box);
				
				
				
				if( empty($meta_box['hr']) ){
					echo '<hr class="separator mt20" />';
				}
			}
			
		?> </div> <?php
		
		echo '</div>';
	}
	
	// save option function that trigger when saveing each post
	add_action('save_post','save_mlx_adblock_meta');
	function save_mlx_adblock_meta($post_id){
	
		global $mlx_adblocks_meta_boxes;
		$edit_meta_boxes = $mlx_adblocks_meta_boxes;
		
		foreach ($edit_meta_boxes as $edit_meta_box){

			if(isset($_POST[$edit_meta_box['name']])){	

 			if($edit_meta_box['name'] == 'mlx_shortcode_box' ){	
				
				$new_data = "[MLX_AD ID='".$post_id."']";	

				}
				else
				{
					if(is_array($_POST[$edit_meta_box['name']]))
					{	$new_data = $_POST[$edit_meta_box['name']];		}
					else
					{	$new_data = stripslashes($_POST[$edit_meta_box['name']]);	}	
				}
			}else{
				$new_data = '';
			}
			
			$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
			save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
			
		}
		
	}
	
/***********************************************/

/***********************************************/
//   MLX ADS
	
	$ad_type_opt = array('image_ad' => 'Image Ad', 'link_ad' => 'Link Ad');
	$ad_target_opt = array('_blank' => 'New Window', '_self' => 'Current Window');
	
	$ad_block_opt = array(); 
	$args=array(
	  'post_type' => 'mlx_ad_blocks',
	  'post_status' => 'publish',
	  'posts_per_page' => -1,
	  );
	
	
	$myposts = get_posts( $args );
	//print_r($myposts); //exit;
	foreach ( $myposts as $mpost ) : //setup_postdata( $mpost ); 
		$k= $mpost->ID;
		$ad_block_opt[$k] = $mpost->post_title;
	endforeach; 
	wp_reset_postdata();
	
	$mlx_ads_meta_boxes = array(
		"Show on" => array(
			'title'=>'Image Type',
			'name'=>'mlx_ad_type',
			'type'=>'radio',
			'options'=>$ad_type_opt,
			'description'=>"",
			'hr'=>'none'),
		"Ad Image" => array(
			'title'=>'Ad Image',
			'name'=>'mlx_ad_img_url',
			'type'=>'imgupload',
			'description'=>"",
			'hr'=>'none'),	
		"Ad width" => array(
			'title'=>'Ad Width',
			'name'=>'mlx_ad_w',
			'type'=>'inputtext',
			'description'=>"width in pixels",
			'hr'=>'none'),		
		"Ad Height" => array(
			'title'=>'Ad Height',
			'name'=>'mlx_ad_h',
			'type'=>'inputtext',
			'description'=>"Height in pixels",
			'hr'=>'none'),			
		"Ad Content" => array(
			'title'=>'Ad Content',
			'name'=>'mlx_ad_content',
			'type'=>'textarea',
			'description'=>"",
			'hr'=>'none'),	
		"Ad Anchor Link" => array(
			'title'=>'Ad Anchor Link',
			'name'=>'mlx_ad_anchor_link',
			'type'=>'inputtext',
			'description'=>"",
			'hr'=>'none'),					
		"Ad Anchor Target" => array(
			'title'=>'Ad Anchor Target',
			'name'=>'mlx_ad_anchor_target',
			'type'=>'radio',
			'options'=>$ad_target_opt,
			'description'=>"",
			'hr'=>'none'),					
		"Ad Blocks" => array(
			'title'=>'Ad Blocks',
			'name'=>'mlx_ad_block',
			'type'=>'combobox',
			'options'=>$ad_block_opt,
			'description'=>"",
			'hr'=>'none'),			
	);	
	
	add_action('add_meta_boxes', 'add_mlx_ad_option');
	function add_mlx_ad_option(){	
		add_meta_box('mlx-ad-option', 'MLX Ad Option', 'add_mlx_ad_option_element',
			'mlx_ads', 'normal', 'high');
			
	}
	function add_mlx_ad_option_element(){
	
		global $post, $mlx_ads_meta_boxes;
		echo '<div id="gdl-overlay-wrapper">';
		
		?> <div class="testimonial-option-meta" id="testimonial-option-meta"> <?php
		
			set_nonce();
			
			foreach($mlx_ads_meta_boxes as $meta_box){

				$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				wpadm_print_meta($meta_box);
				
				if( empty($meta_box['hr']) ){
					echo '<hr class="separator mt20" />';
				}
			}
			
		?> </div> <?php
		
		echo '</div>';
	}
	
	// save option function that trigger when saveing each post
	add_action('save_post','save_mlx_ads_meta');
	function save_mlx_ads_meta($post_id){
	
		global $mlx_ads_meta_boxes;
		$edit_meta_boxes = $mlx_ads_meta_boxes;
		//print_r($edit_meta_boxes);
		// save
		foreach ($edit_meta_boxes as $edit_meta_box){
		
			if(isset($_POST[$edit_meta_box['name']])){	
				$new_data = stripslashes($_POST[$edit_meta_box['name']]);		
			}else{
				$new_data = '';
			}
			
			$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
			save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
			
		}
		
	}
	
	
/*********************************************/
//  SHORTCODE

add_action('wp_enqueue_scripts','add_ad_scripts');

function add_ad_scripts(){
	wp_register_script('owl-carousel-script', plugins_url('/js/owl.carousel.js', __FILE__), array('jquery'));
	wp_enqueue_script('owl-carousel-script');
	wp_enqueue_style( "ad_carousel_css1", plugins_url('/css/owl.carousel.css',__FILE__));	
	wp_enqueue_style( "ad_carousel_css2", plugins_url('/css/owl.theme.css',__FILE__));	
	wp_enqueue_style( "ad_carousel_css3", plugins_url('/css/owl.transitions.css',__FILE__));	

	//wp_enqueue_style( "ad_carousel_css", plugins_url('/css/ad.css',__FILE__));	
}


add_filter('widget_text', 'do_shortcode'); 

/*****************************************************************/


function MLX_display_ads_func($atts){
	
	ob_start();
	
	if(isset($atts['id'])){
		$ad_block_id = $atts['id'];
	}
	else
		$ad_block_id = "0";
		
	$geoMD5 = md5(getGeoIpAddress());
	
	$geoLocs = get_transient('geoLoc-' . $geoMD5);
	
	if(!$geoLocs)
	{ 	$geoLocs = getCountryData($geoMD5,true); //echo " yes geo locs"; 
	}

	
	if(is_single())
	{
		$adkey = get_the_ID();
		$metakey = 'spec-ads-posts';

		$meta_ids = get_post_meta($ad_block_id,$metakey);
		$meta_ids = $meta_ids[0];
		
		$show_type = get_post_meta($ad_block_id,"spec-ads-post-type");
		$show_type = $show_type[0];
		
		if( is_array($meta_ids) && !in_array($adkey,$meta_ids) && $show_type == "selected_posts")
			return;
		
		
	}else if(is_page())
	{
		$adkey = get_the_ID();
		$metakey = 'spec-ads-pages';
		
		$meta_ids = get_post_meta($ad_block_id,$metakey);
		$meta_ids = $meta_ids[0];
		
		$show_type = get_post_meta($ad_block_id,"spec-ads-page-type");
		$show_type = $show_type[0];
		
		if( is_array($meta_ids) && !in_array($adkey,$meta_ids) && $show_type == "selected_pages")
			return;
			
			
	}else if(is_category())
	{
		$adkey = get_cat_id( single_cat_title("",false) );
		$metakey = 'spec-ads-categories';

		$meta_ids = get_post_meta($ad_block_id,$metakey);
		$meta_ids = $meta_ids[0];
		
		$show_type = get_post_meta($ad_block_id,"spec-ads-cat-type");
		$show_type = $show_type[0];
		
		if( is_array($meta_ids) && !in_array($adkey,$meta_ids) && $show_type == "selected_cats")
			return;
		
	}		


	$rnd = rand(1,999);
	
	$block_post = get_post($ad_block_id);
	
	//print_r($block_post);
	
	$block_post_id =  $block_post->ID;
	
	$slider_countries = get_post_meta( $block_post_id, 'spec-ads-countries'); 
	$slider_countries = $slider_countries[0]; 
	

	if($slider_countries != 'all_countries')
	{
		$slider_countries_list = get_post_meta( $block_post_id, 'spec-ads-countries-list'); 
		$slider_countries_list = $slider_countries_list[0]; 
		
		//print_r($slider_countries_list);
		

		$geoLoc = json_decode($geoLocs);

		$country = $geoLoc->country_code;
		
		if(!in_array($country,$slider_countries_list))
			return;
		
	}
	
	
	$slider_setting = get_post_meta( $block_post_id, 'spec-ad-slides'); 
	$slider_setting = $slider_setting[0]; 
	
	if($slider_setting == 'multiple_slide')
	{
		$slider_ads = get_post_meta( $block_post_id, 'slider_no_of_ads'); 
		$slider_ads = $slider_ads[0]; 
	}	
	else
	{	$slider_ads = 1; }		
	

		$args = array(	
			'post_type' => 'mlx_ads',
			'post_status'   => 'publish',
			'meta_key' => 'mlx_ad_block',
			'meta_value' => $ad_block_id,
			'posts_per_page' => $slider_ads ,
			'orderby' => 'rand'
		);	

		wp_reset_postdata();
		$query = new WP_Query($args);

		if ( $query->have_posts() ) :
			

			if($slider_ads > 1){
			
			$slider_autoplay = get_post_meta( $block_post_id, 'slider_autoplay'); 
			$slider_autoplay = $slider_autoplay[0]; 
			
			$slider_autoplay_after = get_post_meta( $block_post_id, 'slider_autoplay_after'); 
			$slider_autoplay_after = $slider_autoplay_after[0]; 
			
			$slider_stop_on_hover = get_post_meta( $block_post_id, 'slider_stop_on_hover'); 
			$slider_stop_on_hover = $slider_stop_on_hover[0]; 
			
			$slider_pagination = get_post_meta( $block_post_id, 'slider_pagination'); 
			$slider_pagination = $slider_pagination[0]; 
			
			$slider_transition = get_post_meta( $block_post_id, 'slider_transition'); 
			$slider_transition = $slider_transition[0]; 
			
			
			
			?>
			<style>
			#ads-slider-<?php echo $ad_block_id.'-'.$rnd; ?> .owl-item div{
			 /* padding:5px; */
			}
			#ads-slider-<?php echo $ad_block_id.'-'.$rnd; ?> .owl-item img{
			  display: block;
			  width: 100%;
			  height: auto;
			}
			</style>

			<script type="text/javascript">
			jQuery(document).ready(function($) { //alert(" ");
			  $("#ads-slider-<?php echo $ad_block_id.'-'.$rnd; ?>").owlCarousel({
				<?php if( $slider_autoplay){ ?>
				autoPlay : <?php echo $slider_autoplay_after; ?>,
				<?php  } ?>
				stopOnHover : <?php echo $slider_stop_on_hover; ?>,
				navigation:false,
				pagination:<?php echo $slider_pagination; ?>,
				paginationSpeed : 1000,
				goToFirstSpeed : 2000,
				singleItem : true,
				slideSpeed : 300,
				autoHeight : true,
				<?php if( $slider_transition !='slide'){ ?>
				transitionStyle:"<?php echo $slider_transition; ?>",
				<?php  } ?>
				lazyLoad : true
			  });
			  //alert(" ");
			});
			</script>
			
			<?php }  ?>
			
			  <div class="slider-container slider-container-<?php echo $ad_block_id.'-'.$rnd; ?> ">
				
				<div id="ads-slider-<?php echo $ad_block_id.'-'.$rnd; ?>" 
					<?php if($slider_setting == 'multiple_slide') { ?> class="owl-carousel" <?php }  ?> >
				<?php
				
				while ( $query->have_posts() ) : $query->the_post(); 
		
					 $post_id = get_the_id(); 
					 
					 $views = get_post_meta( $post_id, 'spec_ads_views');
					 if(empty($views))
					 	$view = 1;
					 else
					 	$view =  (is_array($views))? $views[0] + 1: $views + 1;	
						
					 update_post_meta($post_id,"spec_ads_views",$view);

					$ad_w = get_post_meta( $post_id, 'mlx_ad_w');
					$ad_w = $ad_w[0]."px";
					
					$ad_h = get_post_meta( $post_id, 'mlx_ad_h');
					$ad_h = $ad_h[0]."px";
					
					$ad_anchor_target = get_post_meta( $post_id, 'mlx_ad_anchor_target');
					$ad_anchor_target = $ad_anchor_target [0];
					
					$ad_type = get_post_meta( $post_id, 'mlx_ad_type');
					$ad_type = $ad_type[0];
					
					$ad_href = get_post_meta( $post_id, 'mlx_ad_anchor_link');
					$ad_href = $ad_href[0];
					
					if($ad_type == 'link_ad'){
						$ad_w = "90%";	$ad_h = "auto";
					}
					else
					{
					}
					
					?>
				<div class="mlx-ad-wrapper" style="width:<?php echo $ad_w; ?>; height:<?php echo $ad_h; ?>; margin:13px auto;">	
					<a href="<?php echo $ad_href; ?>" target="<?php echo $ad_anchor_target; ?>"
						rel="<?php echo $post_id;?>" class="track_ads" >
								<?php 
							if($ad_type == 'image_ad'){
								$ad_img = get_post_meta( $post_id, 'mlx_ad_img_url');
								echo "<img src='".$ad_img[0]."' class='ad-image' >";			
							}
							if($ad_type == 'link_ad'){
								$ad_content = get_post_meta( $post_id, 'mlx_ad_content');
								$ad_content = $ad_content[0];			

								echo $ad_content;
							} ?>
					</a>	
				   </div>
					<?php 	endwhile;	?>
						</div>
				   </div> 
			<?php
			endif;		


	return ob_get_clean();
}

add_shortcode('MLX_AD', 'MLX_display_ads_func');


/*****************************************************************/
 

function mlx_ads_cpt_columns($columns) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'block' => __( 'Block' ),
		'views' => __( 'Views/Impression' ),
		'clicks' => __( 'Clicks' ),
		'date' => __( 'Date' )
	);

	return $columns;
}
add_filter('manage_edit-mlx_ads_columns' , 'mlx_ads_cpt_columns');


add_action( 'manage_mlx_ads_posts_custom_column', 'my_manage_mlx_ads_columns', 10, 2 );

function my_manage_mlx_ads_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'block' :
			$block = get_post_meta( $post_id, 'mlx_ad_block', true );
			if ( empty( $block ) )
				echo __( '-' );
			else
				echo get_the_title($block); 
			break;

		case 'views' :
			$views = get_post_meta( $post_id, 'spec_ads_views', true );
			if ( empty( $views) )
				echo __( '0' );
			else
				echo (is_array($views))? $views[0]: $views; 
			break;

		case 'clicks' :
			$clicks = get_post_meta( $post_id, 'spec_ads_clicks', true );
			if ( empty( $clicks) )
				echo __( '0' );
			else
				echo (is_array($clicks))? $clicks[0] : $clicks; 
			break;

		default :
			break;
	}
}

/*****************************************************************/



function mlx_ad_blocks_cpt_columns($columns) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'block_shortcode' => __( 'Shortcode' ),
		'total_ads' => __( '#Ads' ),
		'date' => __( 'Date' )
	);

	return $columns;
}
add_filter('manage_edit-mlx_ad_blocks_columns' , 'mlx_ad_blocks_cpt_columns');


add_action( 'manage_mlx_ad_blocks_posts_custom_column', 'my_manage_mlx_ad_blocks_columns', 10, 2 );

function my_manage_mlx_ad_blocks_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'block_shortcode' :

			$block_shortcode = get_post_meta( $post_id, 'mlx_shortcode_box', true );

			if ( empty( $block_shortcode ) )
				echo __( '-' );
			else
				echo $block_shortcode; 
			
			break;
		
		case 'total_ads' :

			$args = array(	'post_type' => 'mlx_ads', 'meta_key' => 'mlx_ad_block', 'meta_value' => $post_id );
			$query = new WP_Query($args);	
			if ( $query->have_posts() ) { 
				echo $query->post_count;	
			}
			else{
				echo __( '-' );
			}
			
			break;
		default :
			break;
	}
} 

////////////////////////////////////////////////////////////////

add_action("wp_head","camsetAddClickViews");
function camsetAddClickViews(){
?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('a.track_ads').each(function(i) {
		jQuery(this).click(function() {

		jQuery.post(
		'<?php echo site_url();?>/wp-admin/admin-ajax.php', 
		{
			action:'camsetAddClickViewAjax'  ,
			redirect: jQuery(this).attr('href'),
			adpostid:jQuery(this).attr('rel')
			
		}, 
		function(jsontext){

		});	
		});
	});
	
});
	</script>
<?php }


add_action('wp_ajax_camsetAddClickViewAjax', 'camsetAddClickViewAjax' );
add_action( 'wp_ajax_nopriv_camsetAddClickViewAjax', 'camsetAddClickViewAjax' );

function camsetAddClickViewAjax() {

	extract($_POST);
	$clicks = get_post_meta( $adpostid, 'spec_ads_clicks');
	if(empty($clicks))
		$click = 1;
	else
		$click = $clicks[0] + 1;	
	
	update_post_meta($adpostid,"spec_ads_clicks",$click);
	die('0');
}	

?>