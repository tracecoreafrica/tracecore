<?php
if ( ! function_exists( 'foton_core_add_triple_frame_image_highlight_shortcode' ) ) {
	function foton_core_add_triple_frame_image_highlight_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'FotonCore\CPT\Shortcodes\TripleFrameImageHighlight\TripleFrameImageHighlight',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcode', 'foton_core_add_triple_frame_image_highlight_shortcode' );
}

if ( ! function_exists( 'foton_core_set_triple_frame_image_highlight_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for triple frame image highlight shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function foton_core_set_triple_frame_image_highlight_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-triple-frame-image-highlight';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', 'foton_core_set_triple_frame_image_highlight_icon_class_name_for_vc_shortcodes' );
}