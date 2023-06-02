"use strict";

jQuery(document).ready(function () {
    jQuery('.helpo_single_product_page .quantity').prepend('<div class="helpo_minus_button">-</div>').append('<div class="helpo_plus_button">+</div>');
    jQuery('.woocommerce-cart-form .product-quantity .quantity').prepend('<div class="helpo_minus_button">-</div>').append('<div class="helpo_plus_button">+</div>');
});

jQuery(window).on('load', function () {
    jQuery('.woocommerce ul.products li.product .button.ajax_add_to_cart').prepend('<svg class="icon">\n' +
        '        <svg viewBox="0 0 12.8 16" id="bag" xmlns="http://www.w3.org/2000/svg"><path d="M12.797 13.831l-.916-10.317a.441.441 0 00-.438-.402H9.559C9.533 1.391 8.127 0 6.4 0S3.267 1.391 3.241 3.112H1.357a.437.437 0 00-.438.402L.003 13.831 0 13.87C0 15.045 1.076 16 2.4 16h8c1.324 0 2.4-.955 2.4-2.13 0-.013 0-.026-.003-.039zM6.4.883a2.28 2.28 0 012.276 2.228H4.124A2.28 2.28 0 016.4.883zm4 14.234h-8c-.831 0-1.504-.55-1.517-1.227l.876-9.891h1.478V5.34a.44.44 0 00.441.442.44.44 0 00.442-.442V3.998h4.556V5.34a.44.44 0 00.441.442.44.44 0 00.442-.442V3.998h1.478l.88 9.891c-.013.678-.69 1.228-1.517 1.228z" fill-rule="evenodd" clip-rule="evenodd"/></svg>\n' +
        '    </svg>'
    );

    jQuery('.woocommerce ul.products li.product .button.product_type_variable').prepend('<svg class="icon">\n' +
        '        <svg viewBox="0 0 488.878 488.878" id="check" xmlns="http://www.w3.org/2000/svg"><path d="M143.294 340.058l-92.457-92.456L0 298.439l122.009 122.008.14-.141 22.274 22.274L488.878 98.123l-51.823-51.825z"/></svg>\n' +
        '    </svg>'
    );

    jQuery('.helpo_single_product_page.woocommerce div.product form.cart .button').prepend('<svg class="icon">\n' +
        '        <svg viewBox="0 0 12.8 16" id="bag" xmlns="http://www.w3.org/2000/svg"><path d="M12.797 13.831l-.916-10.317a.441.441 0 00-.438-.402H9.559C9.533 1.391 8.127 0 6.4 0S3.267 1.391 3.241 3.112H1.357a.437.437 0 00-.438.402L.003 13.831 0 13.87C0 15.045 1.076 16 2.4 16h8c1.324 0 2.4-.955 2.4-2.13 0-.013 0-.026-.003-.039zM6.4.883a2.28 2.28 0 012.276 2.228H4.124A2.28 2.28 0 016.4.883zm4 14.234h-8c-.831 0-1.504-.55-1.517-1.227l.876-9.891h1.478V5.34a.44.44 0 00.441.442.44.44 0 00.442-.442V3.998h4.556V5.34a.44.44 0 00.441.442.44.44 0 00.442-.442V3.998h1.478l.88 9.891c-.013.678-.69 1.228-1.517 1.228z" fill-rule="evenodd" clip-rule="evenodd"/></svg>\n' +
        '    </svg>'
    );

    jQuery('.helpo_single_product_page .helpo_plus_button').each(function () {
        let cont_height = jQuery(this).parent().height();

        jQuery(this).css('line-height', cont_height + 'px');
    });

    jQuery('.helpo_single_product_page .helpo_minus_button').each(function () {
        let cont_height = jQuery(this).parent().height();

        jQuery(this).css('line-height', cont_height + 'px');
    });

    jQuery('.helpo_minus_button').on('click', function () {
        var input_value = jQuery(this).parent().find('.qty').val();

        if (input_value > 1) {
            input_value--;

            jQuery(this).parent().find('.qty').val(input_value);
        }
    });

    jQuery('.helpo_plus_button').on('click', function () {
        var input_value = jQuery(this).parent().find('.qty').val();

        input_value++;

        jQuery(this).parent().find('.qty').val(input_value);
    });

    jQuery(window).on('scroll', function () {
        if (jQuery('div').is('.helpo_minus_button')){} else {
            jQuery('.woocommerce-cart-form .product-quantity .quantity').prepend('<div class="helpo_minus_button">-</div>').append('<div class="helpo_plus_button">+</div>');

            jQuery('.helpo_minus_button').on('click', function () {
                var input_value = jQuery(this).parent().find('.qty').val();

                if (input_value > 1) {
                    input_value--;

                    jQuery(this).parent().find('.qty').val(input_value);
                }
            });

            jQuery('.helpo_plus_button').on('click', function () {
                var input_value = jQuery(this).parent().find('.qty').val();

                input_value++;

                jQuery(this).parent().find('.qty').val(input_value);
            });
        }
    });

    jQuery('.helpo_single_product_page .related.products h2').html(function (index, text) {
        return text.replace(new RegExp("products", 'g'), "<span>products</span>");
    });
});

jQuery(window).on('resize', function () {
    jQuery('.helpo_single_product_page .helpo_plus_button').each(function () {
        let cont_height = jQuery(this).parent().height();

        jQuery(this).css('line-height', cont_height + 'px');
    });

    jQuery('.helpo_single_product_page .helpo_minus_button').each(function () {
        let cont_height = jQuery(this).parent().height();

        jQuery(this).css('line-height', cont_height + 'px');
    });
});
