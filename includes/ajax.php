<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

add_action('wp_ajax_loadmorebutton', 'misha_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'misha_loadmore_ajax_handler');

function misha_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$params = json_decode( stripslashes( $_POST['query'] ), true ); // query_posts() takes care of the necessary sanitization 
	$params['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$params['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $params );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
 
			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			get_template_part( 'template-parts/content/content', 'archive' );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
 
 
		endwhile;

	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_mishafilter', 'misha_filter_function'); 
add_action('wp_ajax_nopriv_mishafilter', 'misha_filter_function');

function misha_filter_function(){
	
	$params = array(
	    'post_type'	=> 'buildings',
		'meta_query' => array()
	);

	// create $args['meta_query'] array if one of the following fields is filled
	if( isset( $_POST['<10'] ) && $_POST['<10'] == 'on' || isset( $_POST['10-20'] ) && $_POST['10-20'] == 'on'|| isset( $_POST['20-40'] ) && $_POST['20-40'] == 'on'|| isset( $_POST['40+'] ) && $_POST['40+'] == 'on')
		$params['meta_query'] = array( 'relation' => 'AND' ); // AND means that all conditions of meta_query should be true

	if( isset( $_POST['<10'] ) ) :
		$params['meta_query'][] = array(
			array(
				'key' => 'metro',
				'value' => 10,
				'type' => 'numeric', // specify it for numeric values
				'compare' => '<='
			)
		);
	endif;

	if( isset( $_POST['10-20'] ) ) :
		$params['meta_query'][] = array(
			array(
				'key' => 'metro',
				'value' => array( 10, 20 ),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
			)
		);
	endif;

	if( isset( $_POST['20-40'] ) ) :
		$params['meta_query'][] = array(
			array(
				'key' => 'metro',
				'value' => array( 20, 40 ),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
			)
		);
	endif;

	if( isset( $_POST['40+'] ) ) :
		$params['meta_query'][] = array(
			array(
				'key' => 'metro',
				'value' => 40,
				'type' => 'numeric', // specify it for numeric values
				'compare' => '>='
			)
		);
	endif;

	if( isset( $_POST['service'] ) ) :
		$params['meta_query'][] = array(
			array(
                'key'     => 'services',
                'value'   => '1',
                'compare' => 'LIKE'
            )
		);
	endif;
	
	query_posts( $params );
	
	global $wp_query;
	
	if( have_posts() ) :
 
 		ob_start(); // start buffering because we do not need to print the posts now
 		
		while( have_posts() ): the_post();
 
			// adapted for Twenty Seventeen theme
			get_template_part( 'template-parts/content/content', 'archive' );

		endwhile;
 
 		$posts_html = ob_get_contents(); // we pass the posts to variable
   		ob_end_clean(); // clear the buffer
	else:
		$posts_html = '<p>Nothing found for your criteria.</p>';
	endif;
	
	// no wp_reset_query() required
 
 	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html
	) );
 	
	die();
}