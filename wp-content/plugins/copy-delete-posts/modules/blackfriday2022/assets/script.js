jQuery(function ($) {

  $('#inis-bf-close').on('click', function (e) {
    e.preventDefault();

    $('#inis-bf-box').hide(300);
    let slug = $('#inis-bf-box').attr('data-slug');
    $.post(ajaxurl, { action: 'inis_bf20_dismiss', token: 'inis_bf20', slug: slug }).done(function (res) {

    }).fail(function (err) {
      console.error(err);
    });
  });

});
