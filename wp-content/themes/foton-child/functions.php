<?php

/*** Child Theme Function  ***/

if ( !function_exists( 'foton_mikado_child_theme_enqueue_scripts' ) ) {
	function foton_mikado_child_theme_enqueue_scripts() {
		$parent_style = 'foton-mikado-default-style';
		
		wp_enqueue_style( 'foton-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'foton_mikado_child_theme_enqueue_scripts' );
}