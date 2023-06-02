<?php
/*
 * Created by Artureanec
*/

if (!class_exists('helpo_socials_widget'))
{
    class helpo_socials_widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'helpo_socials_widget',
                'Socials Widget (Helpo Theme)',
                array('description' => esc_html__('Display Your Logo and Social Icons from Customizer', 'helpo_plugin'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = esc_attr($new_instance['title']);
            $instance['logo'] = esc_attr($new_instance['logo']);
            $instance['logo_type'] = esc_attr($new_instance['logo_type']);
            $instance['logo_width'] = esc_attr($new_instance['logo_width']);
            $instance['logo_height'] = esc_attr($new_instance['logo_height']);
            $instance['address'] = esc_attr($new_instance['address']);
            $instance['phone'] = esc_attr($new_instance['phone']);
            $instance['email'] = esc_attr($new_instance['email']);

            return $instance;
        }

        public function form($instance)
        {
            $default_values = array(
                'title' => esc_html__('Socials', 'helpo_plugin'),
                'logo' => 'enabled',
                'logo_type' => 'transparent',
                'logo_width' => 175,
                'logo_height' => 64,
                'address' => 'Elliott Ave, Parkville VIC 3052, Melbourne Canada',
                'phone' => '+31 85 964 47 25',
                'email' => 'support@helpo.org'
            );

            $instance = wp_parse_args((array)$instance, $default_values);
            ?>
            <p class="helpo_widget">
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php echo esc_html__('Title', 'helpo_plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php echo esc_html($instance['title']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('logo')); ?>">
                    <?php echo esc_html__('Logo Image', 'helpo_plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('logo')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('logo')); ?>">
                    <option value="enabled" <?php selected($instance['logo'], 'enabled'); ?>><?php echo esc_html__('Enabled', 'helpo_plugin'); ?></option>
                    <option value="disabled" <?php selected($instance['logo'], 'disabled'); ?>><?php echo esc_html__('Disabled', 'helpo_plugin'); ?></option>
                </select>

                <label for="<?php echo esc_attr($this->get_field_id('logo_type')); ?>">
                    <?php echo esc_html__('Type of Logo Image', 'helpo_plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('logo_type')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('logo_type')); ?>">
                    <option value="default" <?php selected($instance['logo_type'], 'default'); ?>><?php echo esc_html__('Default Logo Image', 'helpo_plugin'); ?></option>
                    <option value="transparent" <?php selected($instance['logo_type'], 'transparent'); ?>><?php echo esc_html__('Transparent Header Logo Image', 'helpo_plugin'); ?></option>
                </select>

                <label for="<?php echo esc_attr($this->get_field_id('logo_width')); ?>">
                    <?php echo esc_html__('Enter Logo Image Width', 'helpo_plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('logo_width')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('logo_width')); ?>"
                       value="<?php echo esc_html($instance['logo_width']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('logo_height')); ?>">
                    <?php echo esc_html__('Enter Logo Image Height', 'helpo_plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('logo_height')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('logo_height')); ?>"
                       value="<?php echo esc_html($instance['logo_height']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('address')); ?>">
                    <?php echo esc_html__('Address', 'helpo_plugin'); ?>:
                </label>
                <textarea class="widefat"
                          id="<?php echo esc_attr($this->get_field_id('address')); ?>"
                          name="<?php echo esc_attr($this->get_field_name('address')); ?>"
                ><?php echo esc_attr($instance['address']); ?></textarea>

                <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>">
                    <?php echo esc_html__('Phone Number', 'helpo_plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('phone')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('phone')); ?>"
                       value="<?php echo esc_html($instance['phone']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('email')); ?>">
                    <?php echo esc_html__('Email', 'helpo_plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('email')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('email')); ?>"
                       value="<?php echo esc_html($instance['email']); ?>"
                />
            </p>
            <?php
        }

        public function widget($args, $instance)
        {
            extract($args);

            echo $before_widget;
            if ($instance['title']) {
                echo $before_title;
                echo apply_filters('widget_title', $instance['title']);
                echo $after_title;
            }

            if ($instance['logo'] == 'enabled') {
                if ($instance['logo_type'] == 'default') {
                    $logo_image = helpo_get_theme_mod('logo_image');
                } else {
                    $logo_image = helpo_get_theme_mod('logo_transparent_image');
                }

                echo '
                    <div class="helpo_socials_widget_logo">
                        <a href="' . esc_url(home_url('/')) . '">
                            <img src="' . esc_url($logo_image) . '" alt="Footer Logo" width="' . absint($instance['logo_width']) . '" height="' . absint($instance['logo_height']) . '" />
                        </a>
                    </div>
                ';
            }

            if ($instance['address'] !== '' || $instance['phone'] !== '' || $instance['email'] !== '') {
                echo '<div class="helpo_additional_info">';

                    if ($instance['address'] !== '') {
                        echo '<p class="helpo_contacts_widget_address">' . esc_html($instance['address']) . '</p>';
                    }

                    if ($instance['phone'] !== '') {
                        echo '
                            <p class="helpo_contacts_widget_phone">
                                ' . esc_html__('Phone:', 'helpo_plugin') . '
                                <a href="tel:' . esc_attr(str_replace(' ', '', $instance['phone'])) . '">
                                    ' . esc_html($instance['phone']) . '
                                </a>
                            </p>
                        ';
                    }

                    if ($instance['email'] !== '') {
                        echo '
                            <p class="helpo_contacts_widget_email">
                                ' . esc_html__('Email:', 'helpo_plugin') . '
                                <a href="mailto:' . esc_attr($instance['email']) . '">
                                    ' . esc_html($instance['email']) . '
                                </a>
                            </p>
                        ';
                    }

                echo '</div>';
            }

            echo helpo_socials_output('helpo_footer-socials');

            echo $after_widget;
        }
    }
}
