<?php
/*
 * Created by Artureanec
*/

if (!class_exists('helpo_featured_posts_widget'))
{
    class helpo_featured_posts_widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'helpo_featured_posts_widget',
                'Featured Posts (Helpo Theme)',
                array('description' => esc_html__('Featured Posts Widget by Helpo Theme', 'helpo_plugin'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = esc_attr($new_instance['title']);
            $instance['number_of_posts'] = esc_attr($new_instance['number_of_posts']);
            $instance['orderby'] = esc_attr($new_instance['orderby']);

            return $instance;
        }

        public function form($instance)
        {
            $default_values = array(
                'title' => '',
                'number_of_posts' => '3',
                'orderby' => 'date'
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

                <label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>">
                    <?php echo esc_html__('Number of Posts', 'helpo_plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>">
                    <option value="2" <?php selected(absint($instance['number_of_posts']), 2); ?>>2</option>
                    <option value="3" <?php selected(absint($instance['number_of_posts']), 3); ?>>3</option>
                    <option value="4" <?php selected(absint($instance['number_of_posts']), 4); ?>>4</option>
                    <option value="5" <?php selected(absint($instance['number_of_posts']), 5); ?>>5</option>
                    <option value="6" <?php selected(absint($instance['number_of_posts']), 6); ?>>6</option>
                </select>

                <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>">
                    <?php echo esc_html__('Order By', 'helpo_plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('orderby')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('orderby')); ?>">
                    <option value="date" <?php selected($instance['orderby'], 'date'); ?>>Date</option>
                    <option value="rand" <?php selected($instance['orderby'], 'rand'); ?>>Random</option>
                </select>
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

            $args = array(
                'post_type' => 'post',
                'orderby' => esc_attr($instance['orderby']),
                'post_status' => 'publish',
                'posts_per_page' => absint($instance['number_of_posts']),
            );

            query_posts($args);

            if (have_posts()) {
                echo '<div class="helpo_featured_posts_widget_wrapper">';
                while (have_posts()) {
                    the_post();

                    echo '
                        <div class="recent-posts__item">
                            <div class="recent-posts__item-img">
                                <img class="helpo_img--bg" src="' . esc_url(helpo_get_featured_image_url()) . '" alt="' . esc_html__('Image', 'helpo_plugin') . '" />
                            </div>
                            
                            <div class="recent-posts__item-description">
                                <a class="recent-posts__item-link" href="' . esc_url(get_permalink()) . '">' . esc_attr(substr(get_the_title(), 0, 40)) . '</a>
                                <span class="recent-posts__item-value">' . esc_attr(get_the_date()) . '</span>
                            </div>
                        </div>
                    ';
                }
                echo '</div>';
            }

            echo $after_widget;
        }
    }
}