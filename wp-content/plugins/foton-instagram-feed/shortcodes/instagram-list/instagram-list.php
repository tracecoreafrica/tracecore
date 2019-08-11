<?php

namespace FotonInstagram\Shortcodes\InstagramList;

use FotonInstagram\Lib;


class InstagramList implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'mkdf_instagram_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Mikado Instagram List', 'foton-instagram-feed'),
                    'base' => $this->base,
                    'category' => esc_html__('by FOTON', 'foton-instagram-feed'),
                    'icon' => 'icon-wpb-instagram-list extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'number_of_columns',
                            'heading' => esc_html__('Number of Columns', 'foton-instagram-feed'),
                            'value' => array_flip(foton_mikado_get_number_of_columns_array(false, array('one', 'six'))),
                            'save_always' => true
                        ),
                        array(
                            'param_name' => 'type',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Type', 'foton-instagram-feed'),
                            'value' => array(
                                esc_html__( 'Gallery', 'foton-instagram-feed') => 'gallery',
                                esc_html__( 'Carousel', 'foton-instagram-feed') => 'carousel'
                            )
                        ),
                        array(
                            'param_name' => 'space_between_columns',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Space Between Items', 'foton-instagram-feed'),
                            'value' => array_flip(foton_mikado_get_space_between_items_array())
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'number_of_photos',
                            'heading' => esc_html__('Number of Photos', 'foton-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'transient_time',
                            'heading' => esc_html__('Images Cache Time', 'foton-instagram-feed')
                        ),

                        array(
                            'param_name' => 'show_instagram_icon',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Show Instagram Icon', 'foton-instagram-feed'),
                            'value' => array_flip(foton_mikado_get_yes_no_select_array(false)),
                        ),

                        array(
                            'param_name' => 'image_size',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Image Size', 'foton-instagram-feed'),
                            'value' => array(
                                esc_html__( 'Small', 'foton-instagram-feed') => 'thumbnail',
                                esc_html__( 'Medium', 'foton-instagram-feed') => 'low_resolution',
                                esc_html__( 'Large', 'foton-instagram-feed') => 'standard_resolution'
                            )
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_loop',
                            'heading' => esc_html__('Enable Slider Loop', 'foton-instagram-feed'),
                            'value' => array_flip(foton_mikado_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'foton-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_autoplay',
                            'heading' => esc_html__('Enable Slider Autoplay', 'foton-instagram-feed'),
                            'value' => array_flip(foton_mikado_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'foton-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed',
                            'heading' => esc_html__('Slide Duration', 'foton-instagram-feed'),
                            'description' => esc_html__('Default value is 5000 (ms)', 'foton-instagram-feed'),
                            'group' => esc_html__('Slider Settings', 'foton-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed_animation',
                            'heading' => esc_html__('Slide Animation Duration', 'foton-instagram-feed'),
                            'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'foton-instagram-feed'),
                            'group' => esc_html__('Slider Settings', 'foton-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_navigation',
                            'heading' => esc_html__('Enable Slider Navigation Arrows', 'foton-instagram-feed'),
                            'value' => array_flip(foton_mikado_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'foton-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_pagination',
                            'heading' => esc_html__('Enable Slider Pagination', 'foton-instagram-feed'),
                            'value' => array_flip(foton_mikado_get_yes_no_select_array(false, false)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'foton-instagram-feed')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null)
    {
        $args = array(
            'number_of_columns' => '3',
            'space_between_columns' => 'normal',
            'number_of_photos' => '',
            'transient_time' => '',
            'show_instagram_icon' => 'no',
            'type' => 'gallery',
            'image_size' => 'thumbnail',
            'slider_loop' => 'yes',
            'slider_autoplay' => 'yes',
            'slider_speed' => '5000',
            'slider_speed_animation' => '600',
            'slider_navigation' => 'yes',
            'slider_pagination' => 'no'
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['carousel_classes'] = $this->getCarouselClasses($params);

        $instagram_api = new \FotonInstagramApi();
        $params['instagram_api'] = $instagram_api;

        $images_array = $instagram_api->getImages($params['number_of_photos'], array(
            'use_transients' => true,
            'transient_name' => rand(0, 1000),
            'transient_time' => $params['transient_time']
        ));

        $params['images_array'] = $images_array;
        $params['data_attr'] = $this->getSliderData($params);

        //Get HTML from template based on type of team
        $html = foton_instagram_get_shortcode_module_template_part('templates/holder', 'instagram-list', '', $params);

        return $html;
    }

    public function getHolderClasses($params)
    {
        $holderClasses = array();

        $holderClasses[] = $this->getColumnNumberClass($params['number_of_columns']);
        $holderClasses[] = !empty($params['space_between_columns']) ? 'mkdf-' . $params['space_between_columns'] . '-space' : 'mkdf-il-normal-space';

        return implode(' ', $holderClasses);
    }


    public function getCarouselClasses($params)
    {
        $carouselClasses = array();

        if ($params['type'] === 'carousel') {
            $carouselClasses = 'mkdf-instagram-carousel mkdf-owl-slider';

        } else if ($params['type'] == 'gallery') {
            $carouselClasses = 'mkdf-instagram-gallery';
        }

        return $carouselClasses;
    }


    public function getColumnNumberClass($params)
    {
        switch ($params) {
            case 1:
                $classes = 'mkdf-il-one-column';
                break;
            case 2:
                $classes = 'mkdf-il-two-columns';
                break;
            case 3:
                $classes = 'mkdf-il-three-columns';
                break;
            case 4:
                $classes = 'mkdf-il-four-columns';
                break;
            case 5:
                $classes = 'mkdf-il-five-columns';
                break;
            default:
                $classes = 'mkdf-il-three-columns';
                break;
        }

        return $classes;
    }

    private function getSliderData($params)
    {
        $slider_data = array();

        $slider_data['data-number-of-items'] = $params['number_of_columns'];
        $slider_data['data-enable-loop'] = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay'] = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed'] = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $slider_data;
    }
}