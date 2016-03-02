<?php 
	/*
	Template Name: Display Shortcode
	*/

/*
 * Displays all shortcodes of your wordpress
 */	
	 
 	 global $avia_config, $more;
	 get_header();
	 echo avia_title();
	 
	 do_action( 'ava_after_main_title' );
	 ?>
 
 
 <?php 
  global $shortcode_tags;
        echo '<pre>'; 
        print_r($shortcode_tags); 
        echo '</pre>';
?>
