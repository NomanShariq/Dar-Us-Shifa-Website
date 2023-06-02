// Always close the code, cause you can make conflicts (same for css use prefixes)
(function ($) {

  let deactivation_urls = {};

  function getUrl(plugin_dir) {

    let plugin_slug = plugin_dir.split('/')[0];
    return 'https://wordpress.org/support/plugin/' + plugin_slug + '/#wporg-footer';

  }

  function closeModal() {

    setTimeout(function () {
      $('#iiev-modal-leave').animate({'opacity': 0}, 400);
    }, 200);

    $('.iiev-modal-leave__body').animate({'opacity': 0, 'top': '-50px'}, 300, function () {
      setTimeout(function () {
        $('#iiev-modal-leave').hide();
      }, 100);
    });

  }

  function openModal(e) {

    e.preventDefault();

    let plugin_dist = $(e.target).attr('data-plugin-dist');

    $('.iiev-modal-leave__away-link').attr('href', getUrl(plugin_dist));
    $('.iiev-modal-leave__deactivated-link').attr('href', deactivation_urls[plugin_dist]);

    $('#iiev-modal-leave').show();
    $('#iiev-modal-leave').animate({'opacity': 1}, 300);
    $('.iiev-modal-leave__body').animate({'opacity': 1, 'top': '0px'}, 300);

  }

  function addHook($tr) {

    $tr.find('.deactivate').find('a').on('click', openModal);

  }

  function tryToFindItAndAddEvent(plugin) {

    let $tr = $('#the-list').find('tr[data-plugin="' + plugin + '"]');
    let deactivate_btn = $tr.find('.deactivate')
    if (typeof deactivate_btn != 'undefined' && deactivate_btn.length > 0) {
      deactivate_url = deactivate_btn.find('a')[0].getAttribute('href');
      if (typeof deactivate_url != 'undefined' && deactivate_url.length > 0) {
        deactivation_urls[plugin] = deactivate_url;
        deactivate_btn.find('a').attr('href', '#');
        deactivate_btn.find('a').attr('data-plugin-dist', plugin);
        addHook($tr);
      }
    }

  }

  $('.iiev-modal-leave__btn-close').on('click', closeModal);

  for (let i = 0; i < IIEV_DEACTIV_PLUG_LIST.length; ++i) {

    let plugin = IIEV_DEACTIV_PLUG_LIST[i];
    tryToFindItAndAddEvent(plugin);

  }


})(jQuery);
