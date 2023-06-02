<?php

anc_6310_fun_counter_read_more_style($cssData, $ids);
anc_6310_fun_counter_read_more_script($cssData, $ids);
?>
<script>
   jQuery(document).ready(function() {
      jQuery("body").on("mouseenter mouseleave", ".anc_6310_image_hover_effect, .anc_6310_modal-content", function(e) {
         e.preventDefault();
         var org_img = jQuery(this).find('img').attr('src');
         var hover_img = jQuery(this).find('img').attr('image_hover');
         if (hover_img.length > 5) {
            jQuery(this).find('img').attr("src", hover_img);
            jQuery(this).find('img').attr("image_hover", org_img);
         }
      });
   });
</script>