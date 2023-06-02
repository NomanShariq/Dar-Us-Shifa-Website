<?php

if ( !class_exists( 'ElementPack_Settings_API' ) ) :

    class ElementPack_Settings_API {

        /**
         * settings sections array
         *
         * @var array
         */
        protected $settings_sections = array();

        /**
         * Settings fields array
         *
         * @var array
         */
        protected $settings_fields = array();

        public function __construct() {
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

            add_action( 'wp_ajax_element_pack_settings_save', [ $this, "element_pack_settings_save"] );
        }

        /**
         * Enqueue scripts and styles
         */
        function admin_enqueue_scripts() {
            //wp_enqueue_style( 'wp-color-picker' );
            //wp_enqueue_media();
            //wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_script( 'jquery' );
        }

        /**
         * Set settings sections
         *
         * @param array   $sections setting sections array
         */
        function set_sections( $sections ) {
            $this->settings_sections = $sections;

            return $this;
        }

        /**
         * Add a single section
         *
         * @param array   $section
         */
        function add_section( $section ) {
            $this->settings_sections[] = $section;

            return $this;
        }

        /**
         * Set settings fields
         *
         * @param array   $fields settings fields array
         */
        function set_fields( $fields ) {
            $this->settings_fields = $fields;

            return $this;
        }

        function add_field( $section, $field ) {
            $defaults = array(
                'name'  => '',
                'label' => '',
                'desc'  => '',
                'type'  => 'text'
            );

            $arg = wp_parse_args( $field, $defaults );
            $this->settings_fields[$section][] = $arg;

            return $this;
        }

        function do_settings_sections( $page ) {
            global $wp_settings_sections, $wp_settings_fields;

            if ( ! isset( $wp_settings_sections[ $page ] ) ) {
                return;
            }

            foreach ( (array) $wp_settings_sections[ $page ] as $section ) {
                
                if ( $section['id'] == 'element_pack_api_settings') {
                    $section_class = ' bdt-child-width-1-3@xl';
                } else {
                    $section_class = ' bdt-grid-small bdt-child-width-1-4@xl';
                }

                if ( $section['callback'] ) {
                    call_user_func( $section['callback'], $section );
                }

                if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {
                    continue;
                }
                echo '<div class="ep-options bdt-grid bdt-child-width-1-1 bdt-child-width-1-2@m bdt-child-width-1-3@l'.$section_class.'" role="presentation" bdt-grid="masonry: true">';
                
                echo '<p class="ep-no-result bdt-text-center bdt-width-1-1 bdt-margin-small-top bdt-h4">Ops! Your Searched widget not found! Do you have any idea? If yes, <a href="https://feedback.elementpack.pro/b/3v2gg80n/feature-requests/idea/new" target="_blank">Submit here</a></p>';
                
                $this->do_settings_fields( $page, $section['id'] );
                echo '</div>';
            }
        }


        function do_settings_fields( $page, $section ) {
            global $wp_settings_fields;

            if ( ! isset( $wp_settings_fields[ $page ][ $section ] ) ) {
                return;
            }

            foreach ( (array) $wp_settings_fields[ $page ][ $section ] as $field ) {
                $class = '';

                if ( ! empty( $field['args']['class'] ) ) {
                    $class .= ' ' . esc_attr( $field['args']['class'] );
                }

                if ( !empty($field['args']['widget_type']) ) {
                    $class .= ' ep-widget-' . esc_attr( $field['args']['widget_type'] );
                }

                $data_type = ' data-widget-type="' . esc_attr( $field['args']['widget_type'] ) . '" data-content-type="' . esc_attr( $field['args']['content_type'] ) . '" data-widget-name="' . strtolower($field['args']['name']). '"';

                echo "<div class='ep-option-item {$class}' {$data_type}>";

                
                    
                    
                    call_user_func( $field['callback'], $field['args'] );
                    
                    

                echo '</div>';
            }
        }

        /**
         * Initialize and registers the settings sections and fileds to WordPress
         *
         * Usually this should be called at `admin_init` hook.
         *
         * This function gets the initiated settings sections and fields. Then
         * registers them to WordPress and ready for use.
         */
        function admin_init() {
            //register settings sections
            foreach ( $this->settings_sections as $section ) {
                if ( false == get_option( $section['id'] ) ) {
                    add_option( $section['id'] );
                }

                if ( isset($section['desc']) && !empty($section['desc']) ) {
                    $section['desc'] = '<div class="inside">' . $section['desc'] . '</div>';
                    $callback = function() use ( $section ) {
                        echo str_replace( '"', '\"', $section['desc'] );
                    };
                } else if ( isset( $section['callback'] ) ) {
                    $callback = $section['callback'];
                } else {
                    $callback = null;
                }

                add_settings_section( $section['id'], $section['title'], $callback, $section['id'] );
            }

            //register settings fields
            foreach ( $this->settings_fields as $section => $field ) {
                foreach ( $field as $option ) {

                    $name = $option['name'];
                    $type = isset( $option['type'] ) ? $option['type'] : 'text';
                    $label = isset( $option['label'] ) ? $option['label'] : '';
                    $callback = isset( $option['callback'] ) ? $option['callback'] : array( $this, 'callback_' . $type );

                    $args = array(
                        'id'                => $name,
                        'class'             => isset( $option['class'] ) ? 'ep-' . $name . ' ' . $option['class'] : 'ep-' . $name,
                        'label_for'         => "ep-{$section}[{$name}]",
                        'desc'              => isset( $option['desc'] ) ? $option['desc'] : '',
                        'name'              => $label,
                        'section'           => $section,
                        'size'              => isset( $option['size'] ) ? $option['size'] : null,
                        'options'           => isset( $option['options'] ) ? $option['options'] : '',
                        'std'               => isset( $option['default'] ) ? $option['default'] : '',
                        'sanitize_callback' => isset( $option['sanitize_callback'] ) ? $option['sanitize_callback'] : '',
                        'type'              => $type,
                        'placeholder'       => isset( $option['placeholder'] ) ? $option['placeholder'] : '',
                        'min'               => isset( $option['min'] ) ? $option['min'] : '',
                        'max'               => isset( $option['max'] ) ? $option['max'] : '',
                        'step'              => isset( $option['step'] ) ? $option['step'] : '',
                        'plugin_name'       => !empty( $option['plugin_name'] ) ? $option['plugin_name'] : null,
                        'plugin_path'       => !empty( $option['plugin_path'] ) ? $option['plugin_path'] : null,
                        'paid'              => !empty( $option['paid'] ) ? $option['paid'] : null,
                        'widget_type'       => !empty( $option['widget_type'] ) ? $option['widget_type'] : null,
                        'content_type'      => !empty( $option['content_type'] ) ? $option['content_type'] : null,
                        'demo_url'          => !empty( $option['demo_url'] ) ? $option['demo_url'] : null,
                        'video_url'         => !empty( $option['video_url'] ) ? $option['video_url'] : null,
                    );

                    add_settings_field( "{$section}[{$name}]", $label, $callback, $section, $section, $args );
                }
            }

            // creates our settings in the options table
            foreach ( $this->settings_sections as $section ) {
                register_setting( $section['id'], $section['id'], array( $this, 'sanitize_options' ) );
            }
        }

        /**
         * Get field description for display
         *
         * @param array   $args settings field args
         */
        public function get_field_description( $args ) {
            if ( ! empty( $args['desc'] ) ) {
                $desc = sprintf( '<p class="description">%s</p>', $args['desc'] );
            } else {
                $desc = '';
            }

            return $desc;
        }

        /**
         * Displays a text field for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_text( $args ) {

            $value       = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $class       = 'bdt-input';
            $type        = isset( $args['type'] ) ? $args['type'] : 'text';
            $placeholder = empty( $args['placeholder'] ) ? '' : ' placeholder="' . $args['placeholder'] . '"';
            $html = '';
                

            $html .= '<div class="ep-option-item-inner">';        
            if ($args['video_url']) {
                $html .= '<a href="' . $args['video_url'] . '" target="_blank" class="ep-option-video" bdt-tooltip="View '.$args['name'].' Video Tutorial"><i class="bdt-wi-tutorial" aria-hidden="true"></i></a>';
            }
            $html  .= sprintf( '<label for="bdt_ep_%1$s[%2$s]">', $args['section'], $args['id'] );
            $html .= '<span scope="row" class="ep-option-label">' . $args['name'] . '</span>';
            $html  .= '</label>';


            $html .= sprintf( '<input type="%1$s" class="%2$s" id="%3$s[%4$s]" name="%3$s[%4$s]" value="%5$s"%6$s/>', $type, $class, $args['section'], $args['id'], $value, $placeholder );

            $html  .= $this->get_field_description( $args );

            $html .= '</div>';

            echo $html;
        }

        /**
         * Displays a url field for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_url( $args ) {
            $this->callback_text( $args );
        }

        /**
         * Displays a number field for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_number( $args ) {
            $value       = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $size        = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';
            $type        = isset( $args['type'] ) ? $args['type'] : 'number';
            $placeholder = empty( $args['placeholder'] ) ? '' : ' placeholder="' . $args['placeholder'] . '"';
            $min         = ( $args['min'] == '' ) ? '' : ' min="' . $args['min'] . '"';
            $max         = ( $args['max'] == '' ) ? '' : ' max="' . $args['max'] . '"';
            $step        = ( $args['step'] == '' ) ? '' : ' step="' . $args['step'] . '"';

            $html        = sprintf( '<input type="%1$s" class="%2$s-number" id="%3$s[%4$s]" name="%3$s[%4$s]" value="%5$s"%6$s%7$s%8$s%9$s/>', $type, $size, $args['section'], $args['id'], $value, $placeholder, $min, $max, $step );
            $html       .= $this->get_field_description( $args );

            echo $html;
        }

        /**
         * Displays a checkbox for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_checkbox( $args ) {

            $value       = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $plugin_name = isset($args['plugin_name']) ? $args['plugin_name'] : '';
            $plugin_path = isset($args['plugin_path']) ? $args['plugin_path'] : '';
            $paid        = isset($args['paid']) ? $args['paid'] : '';

            $html = '';


            $html .= '<div class="ep-option-item-inner">';
                $html .= '<div class="bdt-grid bdt-grid-collapse bdt-flex bdt-flex-middle">';

                    $html .= '<div class="bdt-width-expand bdt-flex-inline bdt-flex-middle">';

                        $html .= '<i class="bdt-wi-' . esc_attr( $args['id'] ) . '" aria-hidden="true"></i>';
                        
                        $html  .= sprintf( '<label for="bdt_ep_%1$s[%2$s]">', $args['section'], $args['id'] );
                            $html .= '<span scope="row" class="ep-option-label">' . $args['name'] . '</span>';
                        $html  .= '</label>';


                        if ($args['demo_url']) {
                            $html .= '<a href=' . $args['demo_url'] . ' target="_blank" class="ep-option-demo" bdt-tooltip="View '.$args['name'].' Widget Demo"><i class="bdt-wi-preview" aria-hidden="true"></i></a>';
                        }
                        if ($args['video_url']) {
                            $html .= '<a href=' . $args['video_url'] . ' target="_blank" class="ep-option-video" bdt-tooltip="View '.$args['name'].' Video Tutorial"><i class="bdt-wi-tutorial" aria-hidden="true"></i></a>';
                        }
                    $html .= '</div>';
                    
                    $html .= '<div class="bdt-width-auto">';
                    
            
            
                // 3rd party widgets 
                if ($plugin_name and $plugin_path) {
                    if ($this->_is_plugin_installed($plugin_name, $plugin_path)) {
                        if ( ! current_user_can( 'activate_plugins' ) ) { return; }
                        if ( ! is_plugin_active($plugin_path) ) {
                            $active_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin_path . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin_path );
                            $html .= '<a href="' . $active_link . '" class="element-pack-3pp-active" bdt-tooltip="Activate the plugin first then you can activate this widget."><span class="dashicons dashicons-admin-plugins"></span></a>';
                        }
                    } else {
                        if ($paid) {
                            $html .= '<a href="' . $paid . '" class="element-pack-3pp-download" bdt-tooltip="Download and install plugin first then you can activate this widget."><span class="dashicons dashicons-download"></span></a>';
                        } else {
                            $install_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $plugin_name ), 'install-plugin_' . $plugin_name );
                            $html .= '<a href="' . $install_link . '" class="element-pack-3pp-install" bdt-tooltip="Install the plugin first then you can activate this widget."><span class="dashicons dashicons-download"></span></a>';
                        }            
                    }

                    if ( $this->_is_plugin_installed($plugin_name, $plugin_path) and is_plugin_active($plugin_path) ) {

                        $html  .= '<fieldset>';
                        $html  .= sprintf( '<label for="bdt_ep_%1$s[%2$s]">', $args['section'], $args['id'] );
                        $html  .= sprintf( '<input type="hidden" name="%1$s[%2$s]" value="off" />', $args['section'], $args['id'] );
                        $html  .= sprintf( '<input type="checkbox" class="checkbox" id="bdt_ep_%1$s[%2$s]" name="%1$s[%2$s]" value="on" %3$s />', $args['section'], $args['id'], checked( $value, 'on', false ) );
                        $html    .= '<span class="switch"></span>';
                        $html  .= '</label>';
                        $html  .= '</fieldset>';

                    }
                } else { // core widgets

                    $html  .= '<fieldset>';
                    $html  .= sprintf( '<label for="bdt_ep_%1$s[%2$s]">', $args['section'], $args['id'] );
                    $html  .= sprintf( '<input type="hidden" name="%1$s[%2$s]" value="off" />', $args['section'], $args['id'] );
                    $html  .= sprintf( '<input type="checkbox" class="checkbox" id="bdt_ep_%1$s[%2$s]" name="%1$s[%2$s]" value="on" %3$s />', $args['section'], $args['id'], checked( $value, 'on', false ) );
                    $html    .= '<span class="switch"></span>';
                    $html  .= '</label>';
                    $html  .= '</fieldset>';
                }

            $html  .= '</div>';
            $html  .= '</div>';
            $html  .= '</div>';

            echo $html;
        }

        function _is_plugin_installed($plugin, $plugin_path ) {
            $installed_plugins = get_plugins();
            return isset( $installed_plugins[ $plugin_path ] );
        }


        /**
         * Displays a multicheckbox for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_multicheck( $args ) {

            $value = $this->get_option( $args['id'], $args['section'], $args['std'] );
            $html  = '<fieldset>';
            $html .= sprintf( '<input type="hidden" name="%1$s[%2$s]" value="" />', $args['section'], $args['id'] );
            foreach ( $args['options'] as $key => $label ) {
                $checked = isset( $value[$key] ) ? $value[$key] : '0';
                $html    .= sprintf( '<label for="bdt_ep_%1$s[%2$s][%3$s]">', $args['section'], $args['id'], $key );
                $html    .= sprintf( '<input type="checkbox" class="checkbox" id="bdt_ep_%1$s[%2$s][%3$s]" name="%1$s[%2$s][%3$s]" value="%3$s" %4$s />', $args['section'], $args['id'], $key, checked( $checked, $key, false ) );
                $html    .= '<span class="switch"></span>';
                $html    .= sprintf( '%1$s</label><br>',  $label );
            }

            $html .= $this->get_field_description( $args );
            $html .= '</fieldset>';

            echo $html;
        }

        /**
         * Displays a radio button for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_radio( $args ) {

            $value = $this->get_option( $args['id'], $args['section'], $args['std'] );
            $html  = '<fieldset>';

            foreach ( $args['options'] as $key => $label ) {
                $html .= sprintf( '<label for="bdt_ep_%1$s[%2$s][%3$s]">',  $args['section'], $args['id'], $key );
                $html .= sprintf( '<input type="radio" class="radio" id="bdt_ep_%1$s[%2$s][%3$s]" name="%1$s[%2$s]" value="%3$s" %4$s />', $args['section'], $args['id'], $key, checked( $value, $key, false ) );
                $html .= sprintf( '%1$s</label><br>', $label );
            }

            $html .= $this->get_field_description( $args );
            $html .= '</fieldset>';

            echo $html;
        }

        /**
         * Displays a selectbox for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_select( $args ) {

            $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $size  = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';
            $html  = sprintf( '<select class="%1$s" name="%2$s[%3$s]" id="%2$s[%3$s]">', $size, $args['section'], $args['id'] );

            foreach ( $args['options'] as $key => $label ) {
                $html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $value, $key, false ), $label );
            }

            $html .= sprintf( '</select>' );
            $html .= $this->get_field_description( $args );

            echo $html;
        }
	
	    /**
	     * Displays a textarea for a settings field
	     *
	     * @param array $args settings field args
	     */
	    function callback_textarea( $args ) {
		
		    $value       = esc_textarea( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
		    $size        = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
		    $placeholder = empty( $args['placeholder'] ) ? '' : ' placeholder="' . $args['placeholder'] . '"';
		
		    $html  = '';
		    $html .= sprintf( '<label for="bdt_ep_%1$s[%2$s]">', $args['section'], $args['id'] );
		    $html .= '<span scope="row" class="ep-option-label">' . $args['name'] . '</span>';
		    $html .= '</label>';
		
		    $html .= sprintf( '<textarea rows="5" cols="55" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]" %4$s >%5$s</textarea>', $size, $args['section'], $args['id'], $placeholder, $value );
		    $html .= $this->get_field_description( $args );
		
		    echo $html;
	    }

        /**
         * Displays the html for a settings field
         *
         * @param array   $args settings field args
         * @return string
         */
        function callback_html( $args ) {
            echo $args['desc'];
        }

        /**
         * Displays a file upload field for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_file( $args ) {

            $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $size  = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';
            $id    = $args['section']  . '[' . $args['id'] . ']';
            $label = isset( $args['options']['button_label'] ) ? $args['options']['button_label'] : __( 'Choose File' );

            $html  = sprintf( '<input type="text" class="%1$s-text wpsa-url" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
            $html  .= '<input type="button" class="button wpsa-browse" value="' . $label . '" />';
            $html  .= $this->get_field_description( $args );

            echo $html;
        }

        /**
         * Displays a password field for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_password( $args ) {

            $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $size  = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

            $html  = sprintf( '<input type="password" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
            $html  .= $this->get_field_description( $args );

            echo $html;
        }

        /**
         * Displays a color picker field for a settings field
         *
         * @param array   $args settings field args
         */
        function callback_color( $args ) {

            $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $size  = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

            $html  = sprintf( '<input type="text" class="%1$s-text wp-color-picker-field" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s" data-default-color="%5$s" />', $size, $args['section'], $args['id'], $value, $args['std'] );
            $html  .= $this->get_field_description( $args );

            echo $html;
        }

        /**
         * Displays a  2 colspan subheading field for a settings field
         *
         * @param array $args settings field args
         */
        function callback_subheading( $args ) {

            $html  = '<h3 class="setting_subheading column-merge">'.$args['name'].'</h3>';
            $html .= $this->get_field_description( $args );
            $html .= '<hr class="setting_separator">';

            echo $html;
        }

        function callback_start_group( $args ) {

            $html  = '<div class="ep-option-item-inner ep-option-group">';

            $html  .= sprintf( '<label for="bdt_ep_%1$s[%2$s]">', $args['section'], $args['id'] );
            $html .= '<span scope="row" class="ep-option-label">' . $args['name'] . '</span>';
            $html  .= '</label>';

            if ($args['video_url']) {
                $html .= '<a href="' . $args['video_url'] . '" target="_blank" class="ep-option-video" bdt-tooltip="View '.$args['name'].' Video Tutorial"><i class="bdt-wi-tutorial" aria-hidden="true"></i></a>';
            }

            $html .= $this->get_field_description( $args );

            $html .= '<div class="bdt-grid" bdt-grid>';

            echo $html;
        }

        function callback_end_group( $args ) {

                $html  = '</div>';
            $html  .= '</div>';

            echo $html;
        }

        /**
         * Displays a  2 colspan separator field for a settings field
         *
         * @param array $args settings field args
         */
        function callback_separator( $args ) {

            $html  = '<hr class="setting_separator column-merge">';
            $html .= $this->get_field_description( $args );


            echo $html;
        }


        /**
         * Displays a select box for creating the pages select box
         *
         * @param array   $args settings field args
         */
        function callback_pages( $args ) {

            $dropdown_args = array(
                'selected' => esc_attr($this->get_option($args['id'], $args['section'], $args['std'] ) ),
                'name'     => $args['section'] . '[' . $args['id'] . ']',
                'id'       => $args['section'] . '[' . $args['id'] . ']',
                'echo'     => 0
            );
            $html = wp_dropdown_pages( $dropdown_args );
            echo $html;
        }

        /**
         * Sanitize callback for Settings API
         *
         * @return mixed
         */
        function sanitize_options( $options ) {

            if ( !$options ) {
                return $options;
            }

            foreach( $options as $option_slug => $option_value ) {
                $sanitize_callback = $this->get_sanitize_callback( $option_slug );

                // If callback is set, call it
                if ( $sanitize_callback ) {
                    $options[ $option_slug ] = call_user_func( $sanitize_callback, $option_value );
                    continue;
                }
            }

            return $options;
        }

        /**
         * Get sanitization callback for given option slug
         *
         * @param string $slug option slug
         *
         * @return mixed string or bool false
         */
        function get_sanitize_callback( $slug = '' ) {
            if ( empty( $slug ) ) {
                return false;
            }

            // Iterate over registered fields and see if we can find proper callback
            foreach( $this->settings_fields as $section => $options ) {
                foreach ( $options as $option ) {
                    if ( $option['name'] != $slug ) {
                        continue;
                    }

                    // Return the callback name
                    return isset( $option['sanitize_callback'] ) && is_callable( $option['sanitize_callback'] ) ? $option['sanitize_callback'] : false;
                }
            }

            return false;
        }

        /**
         * Get the value of a settings field
         *
         * @param string  $option  settings field name
         * @param string  $section the section name this field belongs to
         * @param string  $default default text if it's not found
         * @return string
         */
        function get_option( $option, $section, $default = '' ) {

            $options = get_option( $section );

            if ( isset( $options[$option] ) ) {
                return $options[$option];
            }

            return $default;
        }

        /**
         * Show navigations as tab
         *
         * Shows all the settings section labels as tab
         */
        function show_navigation() {

            $html = '<ul class="bdt-tab" bdt-tab="animation: bdt-animation-slide-bottom-small;">';

            $html .= sprintf( '<li><a href="#%1$s" class="bdt-tab-item" id="bdt-%1$s" data-tab-index="0">%2$s</a></li>', 'element_pack_welcome', 'Dashboard' );

            $count = 1;

            foreach ( $this->settings_sections as $tab ) {
                $html .= sprintf( '<li><a href="#%1$s" class="bdt-tab-item" id="bdt-%1$s" data-tab-index="%2$s">%3$s</a></li>', $tab['id'], $count++, $tab['title'] );
            }

	        if ( !defined('BDTEP_LO') ) {
		        $html .= sprintf( '<li><a href="#%1$s" class="bdt-tab-item" id="bdt-%1$s" data-tab-index="%2$s">%3$s</a></li>', 'element_pack_license_settings', $count, 'License' );
	        }

            $html .= '</ul>';

            echo $html;
        } 

        function element_pack_settings_save() {

            if ( ! check_ajax_referer( 'element-pack-settings-save-nonce' ) ) {
                wp_send_json_error();
            }

            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            $moudle_id = $_POST['id'];
            
            unset( $_POST['id'] );
            
            update_option( $moudle_id, $_POST[$moudle_id] ) OR add_option( $moudle_id, $_POST[$moudle_id] ) ;
                        
            wp_send_json_success();

        }

        /**
         * Show the section settings forms
         *
         * This function displays every sections in a different form
         */
        function show_forms() {
            ?>
           
            <?php $i=0; foreach ( $this->settings_sections as $form ) { $i++;?>
                <div id="<?php echo $form['id']; ?>_page" class="ep-option-page">

                    <div bdt-filter="target: .ep-options" class="ep-options-parent" id="ep-options-parent-<?php echo $i; ?>">


                        <?php if ($form['id'] == 'element_pack_active_modules' or $form['id'] == 'element_pack_third_party_widget' or $form['id'] == 'element_pack_elementor_extend') : ?>
                        
                        <div class="bdt-widget-filter-wrapper bdt-grid">

                            <div class="bdt-width-expand ep-widget-filter-nav bdt-visible@m">
                                
                                <ul class="bdt-subnav bdt-subnav-pill ep-widget-filter bdt-widget-type-content bdt-flex-inline">
                                    <li class="ep-widget-all bdt-active" bdt-filter-control="*"><a href="#">All</a></li>
                                    <li class="ep-widget-free" bdt-filter-control="filter: [data-widget-type='free']; group: data-content-type"><a href="#">Free</a></li>
                                    <li class="ep-widget-pro" bdt-filter-control="filter: [data-widget-type='pro']; group: data-content-type"><a href="#">Pro</a></li>

                                </ul>
			
			                    <?php if ($form['id'] == 'element_pack_active_modules' or $form['id'] == 'element_pack_third_party_widget' ) : ?>

                                <ul class="bdt-subnav bdt-subnav-pill ep-widget-filter bdt-flex-inline bdt-visible@m">
                                    <li class="ep-widget-post" bdt-filter-control="filter: [data-content-type*='post']; group: data-widget-type"><a href="#">Post</a></li>
                                    <li class="ep-widget-custom" bdt-filter-control="filter: [data-content-type*='custom']; group: data-widget-type"><a href="#">Custom</a></li>
                                    <li class="ep-widget-others" bdt-filter-control="filter: [data-content-type*='others']; group: data-widget-type"><a href="#">Others</a></li>
                                    <li class="ep-widget-gallery" bdt-filter-control="filter: [data-content-type*='gallery']; group: data-widget-type"><a href="#">Gallery</a></li>
                                    <li class="ep-widget-slider" bdt-filter-control="filter: [data-content-type*='slider']; group: data-widget-type"><a href="#">Slider</a></li>
                                    <li class="ep-widget-carousel" bdt-filter-control="filter: [data-content-type*='carousel']; group: data-widget-type"><a href="#">Carousel</a></li>
                                    <?php if ($form['id'] == 'element_pack_third_party_widget') : ?>
                                    <li class="ep-widget-forms" bdt-filter-control="filter: [data-content-type*='forms']; group: data-widget-type"><a href="#">Forms</a></li>
                                    <?php endif; ?>
                                    <li class="ep-widget-new" bdt-filter-control="filter: [data-content-type*='new']; group: data-widget-type"><a href="#">New</a></li>

                                    <?php if ($form['id'] == 'element_pack_third_party_widget') : ?>
                                    <li class="ep-widget-ecommerce" bdt-filter-control="filter: [data-content-type*='ecommerce']; group: data-widget-type"><a href="#">eCommerce</a></li>
                                    <?php endif; ?>
                                </ul>
                        
                                <?php endif; ?>
                                
                            </div>
                            
                            
                            <div class="bdt-width-auto@m bdt-search-active-wrap bdt-flex bdt-flex-middle bdt-flex-between">
                                <div class="bdt-widget-search">
                                    <input data-id="ep-options-parent-<?php echo $i; ?>" onkeyup="filterSearch(this);" bdt-filter-control="" class="bdt-search-input bdt-flex-middle" type="search" placeholder="Search widget..." autofocus>
                                </div>
			
			                    <?php //if ($form['id'] == 'element_pack_active_modules' or $form['id'] == 'element_pack_third_party_widget' ) : ?>
                                <ul class="bdt-subnav bdt-subnav-pill ep-widget-onoff">
                                    <li><a href="#" class="ep-active-all-widget">Active All</a></li>
                                    <li><a href="#" class="ep-deactive-all-widget">Deactive All</a></li>
                                </ul>
			                    <?php //endif; ?>
                                
                            </div>
                            
                        </div>

                        <?php endif; ?>

                        <form class="settings-save" method="post" action="admin-ajax.php?action=element_pack_settings_save">
                            <input type="hidden" name="id" value="<?php echo $form['id']; ?>">
                            <?php

                            wp_nonce_field( 'element-pack-settings-save-nonce' );

                            do_action( 'wsa_form_top_' . $form['id'], $form );
                            //settings_fields( $form['id'] );
                            $this->do_settings_sections( $form['id'] );
                            do_action( 'wsa_form_bottom_' . $form['id'], $form );
                            
                            if ( isset( $this->settings_fields[ $form['id'] ] ) ) :
                                ?>

                                <div class="ep-setting-save-btn">

                                    <button class="bdt-button bdt-button-primary element-pack-settings-save-btn" type="submit">Save Settings</button>
                                    
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            <?php }
            
        }

    }

endif;