<?php
/*
 * Created by Artureanec
*/

if (!class_exists('helpo_donation_widget'))
{
    class helpo_donation_widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'helpo_donation_widget',
                'Donation Widget (Helpo Theme)',
                array('description' => esc_html__('Donation Widget by Helpo Theme', 'helpo_plugin'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = esc_attr($new_instance['title']);
            $instance['description'] = esc_attr($new_instance['description']);
            $instance['button_text'] = esc_attr($new_instance['button_text']);

            return $instance;
        }

        public function form($instance)
        {
            $default_values = array(
                'title' => '',
                'description' => '',
                'shortcode' => '',
                'button_text' => esc_html__('Donate', 'helpo_plugin')
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

                <label for="<?php echo esc_attr($this->get_field_id('description')); ?>">
                    <?php echo esc_html__('Description', 'helpo_plugin'); ?>:
                </label>
                <textarea class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('description')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('description')); ?>"
                ><?php echo esc_attr($instance['description']); ?></textarea>

                <label for="<?php echo esc_attr($this->get_field_id('button_text')); ?>">
                    <?php echo esc_html__('Donation Button Text', 'helpo_plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('button_text')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('button_text')); ?>"
                       value="<?php echo esc_html($instance['button_text']); ?>"
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
                <div class="helpo_donation_widget_wrapper">';
                    if ($instance['description'] !== '') {
                        echo '<p>' . esc_html($instance['description']) . '</p>';
                    }
                    echo '
                    <a class="helpo_button helpo_button--filled helpo_main_donate_popup_trigger" href="' . esc_js('javascript:void(0)') . '">' . esc_html($instance['button_text']) . '</a>
                </div>
            ';

            echo $after_widget;
        }
    }
}
