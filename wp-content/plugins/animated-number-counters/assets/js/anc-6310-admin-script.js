jQuery.fn.extend({
    live: function (event, callback) {
       if (this.selector) {
            jQuery(document).on(event, this.selector, callback);
        }
        return this;
    }
  });
  
  jQuery.fn.extend({
    size: function (event, callback) {
       if (this.selector) {
            jQuery(document).on(event, this.selector, callback);
        }
        return this;
    }
  });

jQuery(document).ready(function () {
  jQuery("#tab-2, #tab-3, #tab-4, #tab-5, #tab-6, #tab-7, #tab-8, #tab-9").hide(),
      jQuery("body").on("click", ".anc-6310-mytab", function () {
          jQuery(".anc-6310-mytab").removeClass("active"), jQuery(this).addClass("active");
          var t = jQuery(this).attr("id");
          return (
              (t = parseInt(t.substring(3))),
              jQuery("#tab-1, #tab-2, #tab-3, #tab-4, #tab-5, #tab-6, #tab-7, #tab-8, #tab-9").hide(),
              jQuery("#tab-" + t).show(),
              jQuery("#tab6").click(function (t) {
                  jQuery(".codemirror-textarea").focus();
              }),
              !1
          );
      });
});
