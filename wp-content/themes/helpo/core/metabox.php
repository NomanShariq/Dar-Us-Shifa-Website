<?php
/*
 * Created by Artureanec
*/

if (!class_exists('RWMB_Loader')) {
    return;
}

if (!function_exists('helpo_custom_meta_boxes')) {
    add_filter('rwmb_meta_boxes', 'helpo_custom_meta_boxes');

    function helpo_custom_meta_boxes($meta_boxes) {
        # Image Post Format
        $meta_boxes[] = array(
            'title' => esc_attr__('Image Post Format Settings', 'helpo'),
            'post_types' => array('post', 'helpo-events', 'helpo-stories', 'helpo-causes'),
            'fields' => array(
                array(
                    'id' => 'helpo_pf_images',
                    'name' => esc_attr__('Select Images', 'helpo'),
                    'type' => 'image_advanced',
                ),
                array(
                    'id' => 'helpo_pf_images_crop_status',
                    'name' => esc_attr__('Crop Images', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'yes' => esc_attr__('Yes', 'helpo'),
                        'no' => esc_attr__('No', 'helpo'),
                    ),
                ),
                array(
                    'id' => 'helpo_pf_images_width',
                    'name' => esc_attr__('Image Width', 'helpo'),
                    'type' => 'text',
                    'desc' => esc_attr__('In pixels.', 'helpo'),
                    'std' => '1200',
                    'attributes' => array(
                        'data-dependency-id' => 'helpo_pf_images_crop_status',
                        'data-dependency-val' => 'yes'
                    ),
                ),
                array(
                    'id' => 'helpo_pf_images_height',
                    'name' => esc_attr__('Image Height', 'helpo'),
                    'type' => 'text',
                    'desc' => esc_attr__('In pixels.', 'helpo'),
                    'std' => '738',
                    'attributes' => array(
                        'data-dependency-id' => 'helpo_pf_images_crop_status',
                        'data-dependency-val' => 'yes'
                    ),
                ),
            ),
        );

        # Video Post Format
        $meta_boxes[] = array(
            'title' => esc_attr__('Video Post Format Settings', 'helpo'),
            'post_types' => array('post', 'helpo-events', 'helpo-stories', 'helpo-causes'),
            'fields' => array(
                array(
                    'id' => 'helpo_pf_video_url',
                    'name' => esc_attr__('Video URL', 'helpo'),
                    'type' => 'oembed',
                    'desc' => esc_attr__('Copy link to the video from YouTube or other video-sharing website.', 'helpo'),
                ),
                array(
                    'id' => 'helpo_pf_video_height',
                    'name' => esc_attr__('Video Height', 'helpo'),
                    'type' => 'text',
                    'desc' => esc_attr__('In pixels.', 'helpo'),
                    'std' => '500',
                ),
            ),
        );

        # Content Output Settings
        $meta_boxes[] = array(
            'title' => esc_attr__('Content Output Settings', 'helpo'),
            'post_types' => array('post'),
            'fields' => array(
                array(
                    'id' => 'media_output_status',
                    'name' => esc_html__('Media Output Container', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'post_meta_status',
                    'name' => esc_html__('Post Meta Container', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'after_content_panel_status',
                    'name' => esc_html__('Panel After Post Content', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'comments_status',
                    'name' => esc_html__('Post Comments', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'recent_posts_status',
                    'name' => esc_html__('Recent Posts', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'recent_posts_number',
                    'name' => esc_html__('Number of Posts', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        '2' => esc_attr__('2 Items', 'helpo'),
                        '3' => esc_attr__('3 Items', 'helpo')
                    )
                ),

                array(
                    'id' => 'recent_posts_order_by',
                    'name' => esc_html__('Order By', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'random' => esc_attr__('Random', 'helpo'),
                        'date' => esc_attr__('Date', 'helpo'),
                        'name' => esc_attr__('Name', 'helpo')
                    )
                ),

                array(
                    'id' => 'recent_posts_order',
                    'name' => esc_html__('Sort Order', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'desc' => esc_attr__('Descending', 'helpo'),
                        'asc' => esc_attr__('Ascending', 'helpo')
                    )
                ),

                array(
                    'id' => 'recent_posts_bg',
                    'name' => esc_html__('Recent Posts Container Background', 'helpo'),
                    'placeholder' => '',
                    'type' => 'color',
                    'class' => 'helpo_color_picker',
                )
            )
        );

        # Causes Custom Fields
        $meta_boxes[] = array(
            'title' => esc_attr__('Causes Fields', 'helpo'),
            'post_types' => array('helpo-causes'),
            'fields' => array(
                array(
                    'id' => 'cause_donation_shortcode',
                    'name' => esc_html__('Donation Shortcode', 'helpo'),
                    'type' => 'text'
                )
            )
        );

        # Events Custom Fields
        $meta_boxes[] = array(
            'title' => esc_attr__('Events Fields', 'helpo'),
            'post_types' => array('helpo-events'),
            'fields' => array(
                array(
                    'id' => 'event_address',
                    'name' => esc_html__('Event Address', 'helpo'),
                    'desc' => esc_html__('You can use HTML tags', 'helpo'),
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '1'
                ),

                array(
                    'id' => 'event_date',
                    'name' => esc_html__('Event Date', 'helpo'),
                    'desc' => esc_html__('You can use HTML tags', 'helpo'),
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '1'
                ),

                array(
                    'id' => 'event_time',
                    'name' => esc_html__('Event Time', 'helpo'),
                    'desc' => esc_html__('You can use HTML tags', 'helpo'),
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '1'
                )
            )
        );

        # Content Settings for Events and Stories
        $meta_boxes[] = array(
            'title' => esc_attr__('Content Settings', 'helpo'),
            'post_types' => array('helpo-events', 'helpo-stories', 'helpo-causes'),
            'fields' => array(
                array(
                    'id' => 'media_output_status',
                    'name' => esc_html__('Media Output Container', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'top_padding',
                    'name' => esc_html__('Content Area Top Padding', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'on' => esc_attr__('On', 'helpo'),
                        'off' => esc_attr__('Off', 'helpo')
                    )
                ),

                array(
                    'id' => 'bottom_padding',
                    'name' => esc_html__('Content Area Bottom Padding', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'on' => esc_attr__('On', 'helpo'),
                        'off' => esc_attr__('Off', 'helpo')
                    )
                )
            )
        );

        # Only Pages Settings
        $meta_boxes[] = array(
            'title' => esc_attr__('Page Padding Settings', 'helpo'),
            'post_types' => array('page'),
            'fields' => array(
                array(
                    'id' => 'page_top_padding',
                    'name' => esc_html__('Content Area Top Padding', 'helpo'),
                    'type' => 'select',
                    'std' => 'on',
                    'options' => array(
                        'off' => esc_attr__('Off', 'helpo'),
                        'on' => esc_attr__('On', 'helpo')
                    )
                ),

                array(
                    'id' => 'page_bottom_padding',
                    'name' => esc_html__('Content Area Bottom Padding', 'helpo'),
                    'type' => 'select',
                    'std' => 'on',
                    'options' => array(
                        'off' => esc_attr__('Off', 'helpo'),
                        'on' => esc_attr__('On', 'helpo')
                    )
                )
            )
        );

        # Post and Page Settings
        $meta_boxes[] = array(
            'title' => esc_attr__('Page Settings', 'helpo'),
            'post_types' => array('post', 'page', 'helpo-events', 'helpo-stories', 'helpo-causes'),
            'fields' => array(
                # Body Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Body Options', 'helpo'),
                    'desc' => '',
                ),

                array(
                    'id' => 'body_bg_type',
                    'name' => esc_html__('Body Background Color Type', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default Color', 'helpo'),
                        'alt' => esc_attr__('Alternative Color', 'helpo')
                    )
                ),

                array(
                    'id' => 'body_alt_bg_color',
                    'name' => esc_html__('Body Background Color', 'helpo'),
                    'type' => 'color',
                    'alpha_channel' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'body_bg_type',
                        'data-dependency-val' => 'alt'
                    )
                ),

                # Header Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Header Options', 'helpo'),
                    'desc' => '',
                ),

                array(
                    'id' => 'header_style',
                    'name' => esc_html__('Header Style', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'type_1' => esc_attr__('Style Type 1', 'helpo'),
                        'type_2' => esc_attr__('Style Type 2', 'helpo'),
                        'type_3' => esc_attr__('Style Type 3', 'helpo'),
                        'type_4' => esc_attr__('Style Type 4', 'helpo')
                    )
                ),

                array(
                    'id' => 'transparent_header',
                    'name' => esc_attr__('Transparent Header', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'on' => esc_attr__('On', 'helpo'),
                        'off' => esc_attr__('Off', 'helpo')
                    )
                ),

                array(
                    'id' => 'sticky_header',
                    'name' => esc_attr__('Sticky Header', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'on' => esc_attr__('On', 'helpo'),
                        'off' => esc_attr__('Off', 'helpo')
                    )
                ),

                array(
                    'id' => 'header_tagline',
                    'name' => esc_html__('Header Tagline', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'on' => esc_attr__('On', 'helpo'),
                        'off' => esc_attr__('Off', 'helpo')
                    ),
                    'attributes' => array(
                        'data-dependency-id' => 'header_style',
                        'data-dependency-val' => 'type_4'
                    )
                ),

                # Title Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Title Options', 'helpo'),
                    'desc' => '',
                ),

                array(
                    'id' => 'page_title_status',
                    'name' => esc_html__('Page Title', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'title_image',
                    'name' => esc_html__('Page Title Image', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'page_title_image_type',
                    'name' => esc_html__('Page Title Image Type', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'alt' => esc_attr__('Alternative', 'helpo')
                    )
                ),

                array(
                    'id' => 'page_title_alt_image',
                    'name' => esc_html__('Alternative Page Title Image', 'helpo'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '1',
                    'max_status' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_image_type',
                        'data-dependency-val' => 'alt'
                    )
                ),

                array(
                    'id' => 'page_title_settings',
                    'name' => esc_html__('Page Title Settings', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'custom' => esc_attr__('Custom', 'helpo'),
                    )
                ),

                array(
                    'id' => 'title_height',
                    'name' => esc_html__('Page Title Height', 'helpo'),
                    'type' => 'number',
                    'std' => '750',
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_settings',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'title_bg_color',
                    'name' => esc_html__('Page Title Background Color', 'helpo'),
                    'placeholder' => '#000000',
                    'type' => 'color',
                    'alpha_channel' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_settings',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'title_type',
                    'name' => esc_html__('Page Title Type', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'alt' => esc_attr__('Alternative', 'helpo')
                    )
                ),

                array(
                    'id' => 'alt_title',
                    'name' => esc_html__('Alternative Page Title', 'helpo'),
                    'desc' => esc_html__('You can use HTML tags in alternative title', 'helpo'),
                    'type' => 'textarea',
                    'cols' => '20',
                    'rows' => '1',
                    'attributes' => array(
                        'data-dependency-id' => 'title_type',
                        'data-dependency-val' => 'alt'
                    )
                ),

                array(
                    'id' => 'title_subtitle',
                    'name' => esc_html__('Page Subtitle', 'helpo'),
                    'type' => 'text'
                ),

                array(
                    'id' => 'site_title_status',
                    'name' => esc_html__('Site Title', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                # Sidebar Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Sidebar Options', 'helpo'),
                    'desc' => '',
                ),

                array(
                    'id' => 'sidebar_position',
                    'name' => esc_html__('Sidebar Position', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'left' => esc_attr__('Left', 'helpo'),
                        'right' => esc_attr__('Right', 'helpo'),
                        'none' => esc_attr__('None', 'helpo')
                    )
                ),

                #Footer Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Footer Options', 'helpo'),
                    'desc' => ''
                ),

                array(
                    'id' => 'bottom_image_status',
                    'name' => esc_html__('Bottom Image Status', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'bottom_image_type',
                    'name' => esc_html__('Bottom Image Type', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'custom' => esc_attr__('Custom', 'helpo')
                    )
                ),

                array(
                    'id' => 'custom_bottom_image',
                    'name' => esc_attr__('Select Images', 'helpo'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '1',
                    'max_status' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'bottom_image_type',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'bottom_image_bg_type',
                    'name' => esc_html__('Bottom Image Block Background Type', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'custom' => esc_attr__('Custom', 'helpo')
                    )
                ),

                array(
                    'id' => 'custom_bottom_image_bg',
                    'name' => esc_html__('Bottom Image Block Background', 'helpo'),
                    'placeholder' => '#ffffff',
                    'type' => 'color',
                    'class' => 'helpo_color_picker',
                    'attributes' => array(
                        'data-dependency-id' => 'bottom_image_bg_type',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'prefooter_status',
                    'name' => esc_html__('Footer Widgets Section', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'prefooter_type',
                    'name' => esc_html__('Footer Widgets Section Type', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'type_1' => esc_attr__('Type 1', 'helpo'),
                        'type_2' => esc_attr__('Type 2', 'helpo'),
                        'type_3' => esc_attr__('Type 3', 'helpo')
                    )
                ),

                array(
                    'id' => 'footer_status',
                    'name' => esc_html__('Footer', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'show' => esc_attr__('Show', 'helpo'),
                        'hide' => esc_attr__('Hide', 'helpo')
                    )
                ),

                array(
                    'id' => 'footer_type',
                    'name' => esc_html__('Footer Type', 'helpo'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'helpo'),
                        'type_1' => esc_attr__('Type 1', 'helpo'),
                        'type_2' => esc_attr__('Type 2', 'helpo')
                    )
                )
            ),
        );

        return $meta_boxes;
    }
}
