<?php
get_header();
?>

    <div class="helpo_404_error_container">
        <div class="helpo_404_error_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-6">
                        <div class="helpo_404_content">
                            <h1 class="helpo_404_error_title"><?php echo esc_html('404', 'helpo'); ?></h1>

                            <h2 class="helpo_404_error_subtitle"><?php echo esc_html(helpo_get_theme_mod('404_title')); ?></h2>

                            <p class="helpo_404_error_info_text"><?php echo esc_html(helpo_get_theme_mod('404_text')); ?></p>

                            <a class="helpo_404_home_button helpo_button helpo_button--primary" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(helpo_get_theme_mod('404_button_text')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer('empty');