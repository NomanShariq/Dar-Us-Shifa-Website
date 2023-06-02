/*
 * Created by Artureanec
*/

"use strict";

function helpo_reactivate_sortable() {
    jQuery('.helpo_text_table_rows').sortable(
        {
            handle: '.helpo_text_table_row_move',
        }
    );
}

function helpo_rwmb_and_customizer_condition() {
    jQuery("[data-dependency-id]").each(function (index) {
        var helpo_target = jQuery(this).attr('data-dependency-id');
        var helpo_needed_val = jQuery(this).attr('data-dependency-val');
        var helpo_needed_val_array = new Array();
        var helpo_array_just_ok = false;

        if(helpo_needed_val.indexOf(',') + 1) {
            // Work with array value
            helpo_needed_val = helpo_needed_val.replace(/\s+/g,'');
            helpo_needed_val_array = helpo_needed_val.split(",");

            var helpo_this = jQuery(this);

            helpo_needed_val_array.forEach(function(item, i, helpo_arr) {
                if (helpo_this.hasClass('helpo_dependency_customizer')) {
                    if (helpo_array_just_ok !== true) {
                        if (jQuery('#customize-control-' + helpo_target).find('select').val() == item) {
                            helpo_array_just_ok = true;
                        }
                    }
                }
                else {
                    if (helpo_array_just_ok !== true) {
                        if (jQuery('#' + helpo_target).val() == item) {
                            helpo_array_just_ok = true;
                        }
                    }
                }
            });

            if (jQuery(this).hasClass('helpo_dependency_customizer')) {
                var helpo_target_status = jQuery('#customize-control-' + helpo_target).find('select').val();
                var helpo_dependency_elem_cont = jQuery(this).parents('.customize-control');
            } else {
                var helpo_target_status = jQuery('#' + helpo_target).val();
                var helpo_dependency_elem_cont = jQuery(this).parents('.rwmb-field');
            }

            if (helpo_array_just_ok == true) {
                helpo_dependency_elem_cont.show('fast');
            } else {
                helpo_dependency_elem_cont.hide('fast');
            }
        } else {
            // Just one value
            if (jQuery(this).hasClass('helpo_dependency_customizer')) {
                var helpo_target_status = jQuery('#customize-control-' + helpo_target).find('select').val();
                var helpo_dependency_elem_cont = jQuery(this).parents('.customize-control');
            } else {
                var helpo_target_status = jQuery('#' + helpo_target).val();
                var helpo_dependency_elem_cont = jQuery(this).parents('.rwmb-field');
            }

            if (helpo_needed_val == helpo_target_status) {
                helpo_dependency_elem_cont.show('fast');
            } else {
                helpo_dependency_elem_cont.hide('fast');
            }
        }
    });
}

function helpo_hide_unnecessary_options() {
    if (jQuery('.helpo_this_template_file').size() < 1) {
        var helpo_this_template_file = 'helpo_temp_333';
    }
    if (jQuery('.helpo_this_template_file').size() > 0) {
        helpo_this_template_file = jQuery('.helpo_this_template_file').val();
    }
    jQuery("[data-show-on-template-file]").each(function (index) {
        var helpo_unnecessary_target = jQuery(this).attr('data-show-on-template-file');
        if (helpo_unnecessary_target.indexOf(',') > -1) {
            var helpo_unnecessary_target_array = helpo_unnecessary_target.split(',');
            var helpo_rwmb_del_status = 'not find';
            jQuery.each(helpo_unnecessary_target_array, function (i, val) {
                if (helpo_this_template_file == val.trim()) {
                    helpo_rwmb_del_status = 'find';
                }
            });
            if (helpo_rwmb_del_status == 'not find') {
                jQuery(this).parents('.rwmb-field').remove();
            }
        } else {
            if (helpo_this_template_file !== helpo_unnecessary_target) {
                jQuery(this).parents('.rwmb-field').remove();
            }
        }
    });

    jQuery("[data-hide-on-template-file]").each(function (index) {
        var helpo_unnecessary_target = jQuery(this).attr('data-hide-on-template-file');
        if (helpo_unnecessary_target.indexOf(',') > -1) {
            var helpo_unnecessary_target_array = helpo_unnecessary_target.split(',');
            var helpo_rwmb_del_status = 'not find';
            jQuery.each(helpo_unnecessary_target_array, function (i, val) {
                if (helpo_this_template_file == val.trim()) {
                    helpo_rwmb_del_status = 'find';
                }
            });
            if (helpo_rwmb_del_status == 'find') {
                jQuery(this).parents('.rwmb-field').remove();
            }
        } else {
            if (helpo_this_template_file == helpo_unnecessary_target) {
                jQuery(this).parents('.rwmb-field').remove();
            }
        }
    });
}

jQuery(window).on('load', function () {
    var val = jQuery('#post-format-selector-0').val();

    helpo_onchange_post_formats2(val);
});

jQuery(document).on('change', '#post-format-selector-0', function(){
    helpo_onchange_post_formats2(jQuery(this).val());
});

function helpo_onchange_post_formats2(val) {
    jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');

    if (val == 'gallery') {
        jQuery('#gallery-post-format-settings').show('fast');
    }
    if (val == 'link') {
        jQuery('#link-post-format-settings').show('fast');
    }
    if (val == 'image') {
        jQuery('#image-post-format-settings').show('fast');
    }
    if (val == 'quote') {
        jQuery('#quote-post-format-settings').show('fast');
    }
    if (val == 'standard') {
        jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
    }
    if (val == 'video') {
        jQuery('#video-post-format-settings').show('fast');
    }
    if (val == 'audio') {
        jQuery('#audio-past-format-settings').show('fast');
    }
}

function helpo_onchange_post_formats() {
    var helpo_post_format = jQuery('#post-formats-select input:checked').val();

    jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');

    if (helpo_post_format == 'standard') {
        jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
    }

    if (helpo_post_format == 'gallery') {
        jQuery('#gallery-post-format-settings').show('fast');
    }

    if (helpo_post_format == 'image') {
        jQuery('#image-post-format-settings').show('fast');
    }

    if (helpo_post_format == 'video') {
        jQuery('#video-post-format-settings').show('fast');
    }

    if (helpo_post_format == 'audio') {
        jQuery('#audio-past-format-settings').show('fast');
    }

    if (helpo_post_format == 'quote') {
        jQuery('#quote-post-format-settings').show('fast');
    }

    if (helpo_post_format == 'link') {
        jQuery('#link-post-format-settings').show('fast');
    }

    if (jQuery('#post-formats-select').length < 1) {
        // Body Class
        if (jQuery('body').hasClass('post-type-gallery')) {
            jQuery('#gallery-post-format-settings').show('fast');
            setTimeout("jQuery('#gallery-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-image')) {
            jQuery('#image-post-format-settings').show('fast');
            setTimeout("jQuery('#image-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-video')) {
            jQuery('#video-post-format-settings').show('fast');
            setTimeout("jQuery('#video-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-audio')) {
            jQuery('#audio-past-format-settings').show('fast');
            setTimeout("jQuery('#audio-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-quote')) {
            jQuery('#quote-post-format-settings').show('fast');
            setTimeout("jQuery('#quote-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-link')) {
            jQuery('#link-post-format-settings').show('fast');
            setTimeout("jQuery('#link-post-format-settings').show('fast')",100);
        } else {
            jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
        }
    }
}

jQuery(document).ready(function () {
    if (jQuery('#centered_content_hide').length) {
        console.log('i found it');
        console.log(jQuery('#centered_content_hide').val());
        if (jQuery('#centered_content_hide').val() == 'yes') {
            console.log('this is yes');
            jQuery('body').addClass('helpo_hide_content');
        } else {
            console.log('this is no');
            jQuery('body').removeClass('helpo_hide_content');
        }
    }
    jQuery('#centered_content_hide').on('change', function(){
        if (jQuery(this).val() == 'yes') {
            jQuery('body').addClass('helpo_hide_content');
        } else {
            jQuery('body').removeClass('helpo_hide_content');
        }
    });
    if (jQuery('#page_template').size() > 0 && jQuery('#page_template').val() !== 'default') {
        jQuery('body').addClass(jQuery('#page_template').val().split('.')[0]);
    }

    jQuery("[data-dependency-id]").parents('.rwmb-field').hide();

    helpo_onchange_post_formats();
    helpo_rwmb_and_customizer_condition();
    helpo_hide_unnecessary_options();

    jQuery('.rwmb-select, .customize-control-select select').change(function () {
        helpo_rwmb_and_customizer_condition();
    });

    jQuery('#post-formats-select input').on("click", function () {
        helpo_onchange_post_formats();
    });

    jQuery('.helpo_reset_all_settings').on("click", function () {
        if (confirm("Are you sure? All settings will be reset to default state.")) {
            jQuery.post(ajaxurl, {
                action: 'helpo_reset_all_settings'
            }, function (response) {
                alert(response);
            });
        }
    });

    jQuery(document).on("click", '.helpo_text_table_add_row', function () {
        var helpo_text_table_data_storage_name = jQuery(this).parents('.widget-content').find('.helpo_text_table_data_storage_name').val();
        var helpo_text_table_name_text = jQuery(this).parents('.widget-content').find('.helpo_text_table_name_text').val();
        var helpo_text_table_value_text = jQuery(this).parents('.widget-content').find('.helpo_text_table_value_text').val();

        jQuery(this).parents('.widget-content').find('.helpo_text_table_rows').append('<div class="helpo_text_table_row helpo_dn"><div class="helpo_50_dib"><label>' + helpo_text_table_name_text + ':</label><input class="widefat" type="text" name="' + helpo_text_table_data_storage_name + '[][name]" value=""></div><div class="helpo_50_dib"><label>' + helpo_text_table_value_text + ':</label><textarea class="widefat" type="text" name="' + helpo_text_table_data_storage_name + '[][value]"></textarea></div><div class="helpo_text_table_row_remove"><i class="fa fa-trash"></i></div><div class="helpo_text_table_row_move"><i class="fa fa-arrows"></i></div></div>');
        jQuery('.helpo_dn').slideDown("fast").removeClass('helpo_dn');
    });

    jQuery(document).on("click", '.helpo_text_table_row_remove', function () {
        jQuery(this).parents('.helpo_text_table_row').slideUp("normal", function () {
            jQuery(this).remove();
        });
    });

    jQuery(document).on("click", '.widget-control-save', function () {
        setTimeout(function () {
            helpo_reactivate_sortable()
        }, 1000);
        setTimeout(function () {
            helpo_reactivate_sortable()
        }, 2000);
        setTimeout(function () {
            helpo_reactivate_sortable()
        }, 3000);
    });

    helpo_reactivate_sortable();
});

jQuery('.helpo_color_picker .rwmb-color').each(function(){
    var color = jQuery(this).attr('placeholder');

    if (jQuery(this).val() == '') {
        jQuery(this).val(color);
    }
});


