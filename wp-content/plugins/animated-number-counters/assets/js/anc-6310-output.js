jQuery(document).ready(function () {
  setTimeout(() => {
    let content = jQuery(".anc-6310-counter-count-content-hidden");
    content.each(function () {
      let width = jQuery(this).width() + 20;
      jQuery(this)
        .siblings(".span1")
        .css({
          width: `calc(88% - ${width}px)`,
        });
    });
  }, 10);
});
