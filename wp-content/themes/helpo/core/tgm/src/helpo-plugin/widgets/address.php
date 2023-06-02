<?php
/*
 * Created by Artureanec
*/

if (!class_exists('helpo_address_widget'))
{
    class helpo_address_widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'helpo_address_widget',
                'Contacts Widget (Helpo Theme)',
                array('description' => esc_html__('Contacts Widget by Helpo Theme', 'helpo_plugin'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = esc_attr($new_instance['title']);
            $instance['address'] = esc_attr($new_instance['address']);
            $instance['phone'] = esc_attr($new_instance['phone']);
            $instance['email'] = esc_attr($new_instance['email']);

            return $instance;
        }

        public function form($instance)
        {
            $default_values = array(
                'title' => '',
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

            echo '
                <div class="helpo_contacts_widget_wrapper">';
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
                    echo '
                </div>
            ';

            echo $after_widget;
        }
    }
}
