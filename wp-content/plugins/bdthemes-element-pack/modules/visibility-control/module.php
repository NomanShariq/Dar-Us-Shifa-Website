<?php

namespace ElementPack\Modules\VisibilityControl;

use Elementor\Controls_Manager;
use ElementPack;
use ElementPack\Element_Pack_Loader;
use ElementPack\Base\Element_Pack_Module_Base;
use WP_Roles;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

    public function __construct() {
        parent::__construct();
        $this->add_actions();
    }

    public function get_name() {
        return 'bdt-visibility-control';
    }

    public function register_section($element) {
        $element->start_controls_section(
            'element_pack_visibility_section',
            [
                'tab'   => Controls_Manager::TAB_ADVANCED,
                'label' => BDTEP_CP . esc_html__('Visibility control (deprecated)', 'visibility-logic-elementor'),
            ]
        );
        $element->end_controls_section();
    }

    public function register_controls($widget, $args) {
	
	    $widget->add_control(
		    'section_widget_visibility_deprecated',
		    [
			    'type' => Controls_Manager::RAW_HTML,
			    'raw' => sprintf( __( 'This extension is deprecated and will removed in next major version so please don\'t use this extension. Use our new visibility controls extension instead of this extension.' , 'bdthemes-element-pack' ) ),
			    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
		    ]
	    );

        $widget->add_control(
            'element_pack_widget_visibility', [
                'label'        => esc_html__('Enable Visibility Control', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'bdthemes-element-pack'),
                'label_off'    => esc_html__('No', 'bdthemes-element-pack'),
                'return_value' => 'yes',
            ]
        );

        $widget->add_control(
            'element_pack_role_visible',
            [
                'type'        => Controls_Manager::SELECT2,
                'label'       => esc_html__('Visible for:', 'bdthemes-element-pack'),
                'options'     => $this->get_user_roles(),
                'default'     => [],
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'element_pack_widget_visibility' => 'yes',
                    'element_pack_role_hidden'       => [],
                ],
            ]
        );

        $widget->add_control(
            'element_pack_role_hidden',
            [
                'type'        => Controls_Manager::SELECT2,
                'label'       => esc_html__('Hidden for:', 'bdthemes-element-pack'),
                'options'     => $this->get_user_roles(),
                'default'     => [],
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'element_pack_widget_visibility' => 'yes',
                    'element_pack_role_visible'      => [],
                ],
            ]
        );

    }

    private function get_user_roles() {
        global $wp_roles;

        if ( !isset($wp_roles) ) {
            $wp_roles = new WP_Roles();
        }
        $all_roles      = $wp_roles->roles;
        $editable_roles = apply_filters('editable_roles', $all_roles);

        $users = ['bdt-guest' => 'Guests', 'bdt-user' => 'Logged in users'];

        foreach ( $editable_roles as $er => $role ) {
            $users[$er] = $role['name'];
        }

        return $users;
    }

    public function content_change($content, $widget) {

        if ( Element_Pack_Loader::elementor()->editor->is_edit_mode() ) {
            return $content;
        }

        // Get the widget settings
        $settings = $widget->get_settings();

        if ( !$this->should_render($settings) ) {
            return '';
        }

        return $content;

    }

    public function section_should_render($should_render, $section) {
        // Get the section settings
        $settings = $section->get_settings();

        if ( !$this->should_render($settings) ) {
            return false;
        }

        return $should_render;

    }

    private function should_render($settings) {
        $user_status = is_user_logged_in();

        if ( $settings['element_pack_widget_visibility'] == 'yes' ) {

            //visible for
            if ( !empty($settings['element_pack_role_visible']) ) {
                if ( in_array('bdt-guest', $settings['element_pack_role_visible']) ) {
                    if ( $user_status == true ) {
                        return false;
                    }
                } elseif ( in_array('bdt-user', $settings['element_pack_role_visible']) ) {
                    if ( $user_status == false ) {
                        return false;
                    }
                } else {
                    if ( $user_status == false ) {
                        return false;
                    }
                    $user = wp_get_current_user();

                    $has_role = false;
                    foreach ( $settings['element_pack_role_visible'] as $setting ) {
                        if ( in_array($setting, (array)$user->roles) ) {
                            $has_role = true;
                        }
                    }
                    if ( $has_role === false ) {
                        return false;
                    }
                }

            }
            elseif ( !empty($settings['element_pack_role_hidden']) ) {

                if ( $user_status === false && in_array('bdt-guest', $settings['element_pack_role_hidden'], false) ) {
                    return false;
                } elseif ( $user_status === true && in_array('bdt-user', $settings['element_pack_role_hidden'], false) ) {
                    return false;
                } else {
                    if ( $user_status === false ) {
                        return true;
                    }
                    $user = wp_get_current_user();

                    foreach ( $settings['element_pack_role_hidden'] as $setting ) {
                        if ( in_array($setting, (array)$user->roles, false) ) {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    protected function add_actions() {

        // Add section for settings
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);

        add_action('elementor/element/common/element_pack_visibility_section/before_section_end', [$this, 'register_controls'], 10, 2);
        add_action('elementor/element/section/element_pack_visibility_section/before_section_end', [$this, 'register_controls'], 10, 2);

        add_filter('elementor/widget/render_content', [$this, 'content_change'], 987, 2);
        add_filter('elementor/section/render_content', [$this, 'content_change'], 987, 2);

        add_filter('elementor/frontend/section/should_render', [$this, 'section_should_render'], 10, 2);
        add_filter('elementor/frontend/widget/should_render', [$this, 'section_should_render'], 10, 2);
        add_filter('elementor/frontend/repeater/should_render', [$this, 'section_should_render'], 10, 2);

    }
}