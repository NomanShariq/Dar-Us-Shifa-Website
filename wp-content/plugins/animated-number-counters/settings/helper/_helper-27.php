<script type="text/javascript">
    jQuery(document).ready(function() {
        //default load start
        if (jQuery('#anc_6310_counter_description').prop('checked') != true) {
            jQuery('.description-act-field').hide();
        }
        if (jQuery('#anc_6310_prefix_icon_show_hide').prop('checked') != true) {
            jQuery('.prefix-act-field').hide();
        }
        if (jQuery('#anc_6310_suffix_icon_show_hide').prop('checked') != true) {
            jQuery('.suffix-act-field').hide();
        }
        if (jQuery('#anc_6310_counter_button').prop('checked') != true) {
            jQuery('.button-act-field').hide();
        }
        // default load end
        jQuery("#anc_6310_box_background_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:before { background:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_box_background_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover:before { background:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
      
        jQuery("#anc_6310_box_border_width").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27:before { height:" + value + "; width:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_box_border_color, #anc_6310_box_border_color_2, #anc_6310_box_border_color_3").on("change", function() {
            var border_color = jQuery('#anc_6310_box_border_color').val();
            var border_color2 = jQuery('#anc_6310_box_border_color_2').val();
            var border_color3 = jQuery('#anc_6310_box_border_color_3').val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:before {  box-shadow: 0 0 10px " + border_color3 + " inset, 0 0 0 12px " + border_color2 +", 0 0 0 17px " + border_color + ", 0 0 35px darkcyan;} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_box_border_hover_color, #anc_6310_box_border_hover_color_2, #anc_6310_box_border_hover_color_3").on("change", function() {
            var border_hover_color = jQuery('#anc_6310_box_border_hover_color').val();
            var border_hover_color2 = jQuery('#anc_6310_box_border_hover_color_2').val();
            var border_hover_color3 = jQuery('#anc_6310_box_border_hover_color_3').val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover:before { box-shadow: 0 0 10px " + border_hover_color3 + " inset, 0 0 0 12px " + border_hover_color2 + ", 0 0 0 17px " + border_hover_color + ", 0 0 35px darkcyan;} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_full_background_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-paralax { background-color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_full_background_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-paralax:hover { background-color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        // anc_6310_box_shadow_blur
        jQuery("#anc_6310_box_shadow_width, #anc_6310_box_shadow_blur, #anc_6310_box_shadow_color, #anc_6310_box_shadow_hover_color").on("change", function() {
            var spread = jQuery("#anc_6310_box_shadow_width").val() + "px";
            var blur = (parseInt(jQuery("#anc_6310_box_shadow_blur").val()) * 2) + "px";
            var color = jQuery("#anc_6310_box_shadow_color").val().replace(/\+/g, ' ');
            var hover_color = jQuery("#anc_6310_box_shadow_hover_color").val().replace(/\+/g, ' ');
            jQuery("<style type='text/css'> .anc-6310-counter-27 { box-shadow: 0 0 " + blur + " " + spread + " " + color + "; -moz-box-shadow: 0 0 " + blur + " " + spread + " " + color + "; -webkit-box-shadow: 0 0 " + blur + " " + spread + " " + color + "; -ms-box-shadow: 0 0 " + blur + " " + spread + " " + color + "; -o-box-shadow: 0 0 " + blur + " " + spread + " " + color + ";} </style>").appendTo(".anc-6310-preview");
            jQuery("<style type='text/css'> .anc-6310-counter-27:hover { box-shadow: 0 0 " + blur + " " + spread + " " + hover_color + "; -moz-box-shadow: 0 0 " + blur + " " + spread + " " + hover_color + "; -webkit-box-shadow: 0 0 " + blur + " " + spread + " " + hover_color + "; -ms-box-shadow: 0 0 " + blur + " " + spread + " " + hover_color + "; -o-box-shadow: 0 0  " + blur + " " + spread + " " + hover_color + ";} </style>").appendTo(".anc-6310-preview");
        });

        //Title Start
        jQuery("#anc_6310_title_font_size").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-title { font-size:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_heading_line_height").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'> .anc-6310-counter-27-title { line-height:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_font_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-title { color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_font_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover .anc-6310-counter-27-title { color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_font_weight").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-title { font-weight:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_text_transform").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-title { text-transform:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });      
        jQuery("#anc_6310_jquery_heading_font").on("change", function() {
            var value = jQuery(this).val().replace(/\+/g, ' ');
            value = value.split(':');
            jQuery("<style type='text/css'>.anc-6310-counter-27-title { font-family:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_margin_top").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-title{  margin-top:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_margin_bottom").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-title{  margin-bottom:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_margin_left").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-title{  margin-left:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_title_margin_right").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-title{  margin-right:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });

        // Description Start
        jQuery('#anc_6310_counter_description').on('click', function() {
            if (jQuery('#anc_6310_counter_description').prop('checked') == true) {
                jQuery('.description-act-field').show();
                jQuery("<style type='text/css'>.anc-6310-counter-27-description { display:block;}</style>").appendTo(".anc-6310-preview");
            } else {
                jQuery('.description-act-field').hide();
                jQuery("<style type='text/css'>.anc-6310-counter-27-description { display:none;}</style>").appendTo(".anc-6310-preview");
            }
        });
        jQuery("#anc_6310_description_font_size").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'> .anc-6310-counter-27-description { font-size:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_line_height").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'> .anc-6310-counter-27-description { line-height:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_font_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'> .anc-6310-counter-27-description { color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_font_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'> .anc-6310-counter-27:hover .anc-6310-counter-27-description { color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_font_weight").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'> .anc-6310-counter-27-description { font-weight:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_text_transform").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'> .anc-6310-counter-27-description { text-transform:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_text_align").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'> .anc-6310-counter-27-description { text-align:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_jquery_description_font").on("change", function() {
            var value = jQuery(this).val().replace(/\+/g, ' ');
            value = value.split(':');
            jQuery("<style type='text/css'>.anc-6310-counter-27-description { font-family:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_margin_top").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-description{  margin-top:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_margin_bottom").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-description{  margin-bottom:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_margin_left").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-description{  margin-left:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_description_margin_right").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-description{  margin-right:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });

        //Icon Start
        jQuery("#anc_6310_icon_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-icon i{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover .anc-6310-counter-27-icon i{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_border_size, #anc_6310_icon_border_color").on("change", function() {
            var border_size = jQuery('#anc_6310_icon_border_size').val();
            var border_color = jQuery('#anc_6310_icon_border_color').val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-icon { border: " + border_size + "px solid " + border_color + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_border_size, #anc_6310_icon_border_hover_color").on("change", function() {
            var border_size = jQuery('#anc_6310_icon_border_size').val();
            var border_hover_color = jQuery('#anc_6310_icon_border_hover_color').val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover .anc-6310-counter-27-icon { border: " + border_size + "px solid " + border_hover_color + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_background_size").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-icon {line-height:" + value + ";  height: " + value + "; width: " + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_size").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-icon i{ font-size:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_background_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-icon {  background:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_margin_bottom").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-icon {  margin-bottom:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_icon_background_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover .anc-6310-counter-27-icon {  background:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });    


        //Number Start
        jQuery("#anc_6310_number_font_size").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{ font-size:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_line_height").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-number { line-height:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_font_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_font_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover .anc-6310-counter-27-number{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_font_weight").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{ font-weight:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_jquery_number_font").on("change", function() {
            var value = jQuery(this).val().replace(/\+/g, ' ');
            value = value.split(':');
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{ font-family:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });     
        jQuery("#anc_6310_number_margin_top").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{  padding-top:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_margin_bottom").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{  padding-bottom:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_margin_left").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{  margin-left:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_margin_right").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-number{  margin-right:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        //Activate Number Prefix settings
        var pre_hidden = <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 2 : 1; ?>;
        jQuery('#anc_6310_prefix_icon_show_hide').on('click', function() {
            if (jQuery('#anc_6310_prefix_icon_show_hide').prop('checked') == true) {
                jQuery('.prefix-act-field').show();
                pre_hidden = 2;
                jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix { display:inline-block;}</style>").appendTo(".anc-6310-preview");
            } else {
                jQuery('.prefix-act-field').hide();
                pre_hidden = 1;
                jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix { display:none;}</style>").appendTo(".anc-6310-preview");
            }
            calculateWidth(hidden);
        });
        jQuery("#anc_6310_number_prefix_font_size").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix{ font-size:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_prefix_font_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_prefix_font_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover .anc-6310-counter-27-count-prefix{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_prefix_position").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix{  vertical-align:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_prefix_margin_left").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix{  margin-left:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_prefix_margin_right").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix{  margin-right:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        //Activate Number Suffix settings
        var suf_hidden = <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 2 : 1; ?>;
        jQuery('#anc_6310_suffix_icon_show_hide').on('click', function() {
            if (jQuery('#anc_6310_suffix_icon_show_hide').prop('checked') == true) {
                jQuery('.suffix-act-field').show();
                suf_hidden = 2;
                jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix { display:inline-block;}</style>").appendTo(".anc-6310-preview");
            } else {
                jQuery('.suffix-act-field').hide();
                suf_hidden = 1;
                jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix { display:none;}</style>").appendTo(".anc-6310-preview");
            }
            calculateWidth(hidden);
        });
        jQuery("#anc_6310_number_suffix_font_size").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix{ font-size:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_suffix_font_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_suffix_font_hover_color").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27:hover .anc-6310-counter-27-count-suffix{ color:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_suffix_position").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix{  vertical-align:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_suffix_margin_left").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix{  margin-left:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_suffix_margin_right").on("change", function() {
            var value = jQuery(this).val() + "px";
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix{  margin-right:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_jquery_number_prefix_font").on("change", function() {
            var value = jQuery(this).val().replace(/\+/g, ' ');
            value = value.split(':');
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix { font-family:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_prefix_font_weight").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-prefix { font-weight:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_jquery_number_suffix_font").on("change", function() {
            var value = jQuery(this).val().replace(/\+/g, ' ');
            value = value.split(':');
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix { font-family:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
        jQuery("#anc_6310_number_suffix_font_weight").on("change", function() {
            var value = jQuery(this).val();
            jQuery("<style type='text/css'>.anc-6310-counter-27-count-suffix { font-weight:" + value + ";} </style>").appendTo(".anc-6310-preview");
        });
    });
</script>