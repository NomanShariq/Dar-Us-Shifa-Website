<?php
# One Click Demo Content Import
function helpo_ocdi_import_files() {
    return array(
        array(
            'import_file_name'              => 'Helpo',
            'categories'                    => array('With Images'),
            'import_file_url'               => trailingslashit(get_template_directory_uri()) . 'core/import/import.xml',
            'import_widget_file_url'        => trailingslashit(get_template_directory_uri()) . 'core/import/widgets.xml',
            'import_customizer_file_url'    => trailingslashit(get_template_directory_uri()) . 'core/import/customizer.xml',
            'import_preview_image_url'      => trailingslashit(get_template_directory_uri()) . 'screenshot.jpg',
            'preview_url'                   => 'https://helpocharity.artureanec.com/',
        ),
        array(
            'import_file_name'              => 'Helpo Monochrome',
            'categories'                    => array('With Images'),
            'import_file_url'               => trailingslashit(get_template_directory_uri()) . 'core/import/import-mono.xml',
            'import_widget_file_url'        => trailingslashit(get_template_directory_uri()) . 'core/import/widgets-mono.xml',
            'import_customizer_file_url'    => trailingslashit(get_template_directory_uri()) . 'core/import/customizer-mono.xml',
            'import_preview_image_url'      => trailingslashit(get_template_directory_uri()) . 'screenshot-mono.jpg',
            'preview_url'                   => 'https://helpocharity.artureanec.com/mono/',
        ),
    );
    #'import_notice'                => esc_attr__( 'After you import this demo, you will have to setup the slider separately. Slider Revolution > Import Slider. All the import files for the slider you will find in "Slider Revolution Import" folder.', 'helpo' ),
}
add_filter( 'pt-ocdi/import_files', 'helpo_ocdi_import_files' );

# Remove Branding Message
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

# Disable Regenerate for Thumbs
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

function helpo_after_activation($oldname, $oldtheme=false) {
$msg = '
    <div class="updated notice is-dismissible">
        <p>'.esc_attr__('After activating all the recommended plugins, you can import all demo content in one-touch. Appearance > Import Demo Data.', 'helpo').'</p>
    </div>
    ';

    add_action('admin_notices', $msg);
}
add_action("after_switch_theme", "helpo_after_activation", 10 ,  2);


function helpo_ocdi_after_import_setup() {
    # Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main' => $main_menu->term_id,
        )
    );
    # 'footer' => $footer_menu->term_id,

    # Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home 1' );
    # $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    # update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'helpo_ocdi_after_import_setup' );