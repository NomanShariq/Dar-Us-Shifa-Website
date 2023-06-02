jQuery(document).ready(function () {
    jQuery('body').on('click', '.bdt-element-link', function () {
        var $el      = jQuery(this),
            settings = $el.data('settings'),
            data     = settings.element_pack_wrapper_link,
            id   = 'bdt-element-link-' + $el.data('id');

        if (jQuery('#' + id).length === 0) {
            jQuery('body').append(
                jQuery(document.createElement('a')).prop({
                    target: data.is_external ? '_blank' : '_self',
                    href  : data.url,
                    class : 'bdt-hidden',
                    id    : id,
                    rel   : data.nofollow ? 'nofollow noreferer' : ''
                })
            );
        }

        jQuery('#' + id)[0].click();

    });
});