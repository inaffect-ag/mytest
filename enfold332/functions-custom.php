<?php
//[author]
function author_func( $atts ){
	$a =  get_the_author();
	return $a;
}
add_shortcode( 'author', 'author_func' );

//[category]
function category_func( $atts ){
	$c =  get_the_category();
	if ( ! empty( $c ) ) {
    	return esc_html( $c[0]->name );   
	}
}
add_shortcode( 'category', 'category_func' );


add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'klv-verlag' ), // Don't display products in the klv-verlag category on the shop page
			'operator' => 'NOT IN'
		)));
	
	}

	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}

function autor( $atts, $content = null )
{	
	
	$postdata = get_post(get_the_ID(), ARRAY_A);
	$authorID = $postdata['post_author'];
	$authorname = get_author_name( $authorID );
	//$email = the_author_meta( 'user_email', $authorID );
						
	if($authorname == "Nicole Simmen" || $authorname == "Stefan Milius" || $authorname == "Nadia Meier" ) {
		$output .= '<div class="author_container"><div class="author_ava">' . get_avatar( $authorID, 45 ) . '</div>';
		$output .= '<div class="author_nick">' . get_author_name( $authorID ) . '</div><div style="clear:both;"></div></div><br/>';
	}
	else {
		$output = 'no blog entry';
	}
	
	
	return $output;
}
add_shortcode('autor', 'autor');