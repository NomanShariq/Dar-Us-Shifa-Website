<?php
$featured_image_url = helpo_get_featured_image_url();
$image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

if (function_exists('aq_resize')) {
    $featured_image_src = aq_resize(esc_url($featured_image_url), 350, 260, true, true, true);
} else {
    $featured_image_src = $featured_image_url;
}

$categories = get_the_category();
$categ_code = array();

if (is_array($categories)) {
    foreach ($categories as $category) {
        $categ_code[] = '
            <span class="helpo_category">' . esc_html($category->name) . '</span>
        ';
    }
}

if ($featured_image_url !== false) {
    $helpo_content_container_class = 'col-lg-7 col-xl-8';
} else {
    $helpo_content_container_class = 'col-12';
}

$helpo_excerpt = substr(get_the_excerpt(), 0, 190);
?>

<div class="helpo_standard_blog_item <?php echo ((is_sticky()) ? 'helpo_sticky_post' : ''); ?>">
    <div class="helpo_standard_blog_item_wrapper">
        <div class="row align-items-center">
            <?php
            if ($featured_image_url !== false) {
                ?>
                <div class="col-lg-5 col-xl-4">
                    <div class="helpo_featured_image_container">
                        <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="<?php echo esc_attr($helpo_content_container_class); ?>">
                <div class="helpo_content_wrapper">
                    <?php
                    if (!is_search()) {
                        ?>
                        <div class="helpo_category_container"><?php echo (is_array($categ_code) ? join('', $categ_code) : ''); ?></div>
                        <?php
                    }
                    ?>

                    <h5 class="helpo_post_title">
                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo wp_kses(get_the_title(), 'post'); ?></a>
                    </h5>

                    <p class="helpo_post_excerpt"><?php echo wp_kses($helpo_excerpt, 'post'); ?></p>

                    <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_button helpo_button--primary"><?php echo esc_html__('Read More', 'helpo'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
