<?php

if ( ! function_exists( 'foton_core_add_image_gallery_shortcodes' ) ) {
	function foton_core_add_image_gallery_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'FotonCore\CPT\Shortcodes\ImageGallery\ImageGallery'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcode', 'foton_core_add_image_gallery_shortcodes' );
}

if ( ! function_exists( 'foton_core_set_image_gallery_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for image gallery shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function foton_core_set_image_gallery_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image-gallery';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', 'foton_core_set_image_gallery_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'foton_core_add_image_gallery_attachment_custom_field' ) ) {
	function foton_core_add_image_gallery_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'image_gallery_masonry_image_size', true );
			
			$form_fields['image_gallery_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'foton-core' ),
				'helps' => esc_html__( 'Choose image size for Image Gallery shortcode item - Masonry layout', 'foton-core' )
			);
			
			$form_fields['image_gallery_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][image_gallery_masonry_image_size]'>";
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, '', false ) . ' value="">' . esc_html__( 'Default', 'foton-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'small', false ) . ' value="small">' . esc_html__( 'Small', 'foton-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-width', false ) . ' value="large-width">' . esc_html__( 'Large Width', 'foton-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-height', false ) . ' value="large-height">' . esc_html__( 'Large Height', 'foton-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-width-height', false ) . ' value="large-width-height">' . esc_html__( 'Large Width Height', 'foton-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '</select>';
		}
		
		return $form_fields;
	}
	
	add_filter( 'attachment_fields_to_edit', 'foton_core_add_image_gallery_attachment_custom_field', 10, 2 );
}

if ( ! function_exists( 'foton_core_save_image_gallery_attachment_fields' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function foton_core_save_image_gallery_attachment_fields( $post, $attachment ) {
		
		if ( isset( $attachment['image_gallery_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'image_gallery_masonry_image_size', $attachment['image_gallery_masonry_image_size'] );
		}
		
		return $post;
	}
	
	add_filter( 'attachment_fields_to_save', 'foton_core_save_image_gallery_attachment_fields', 10, 2 );
}