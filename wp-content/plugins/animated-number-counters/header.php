<div class="anc-6310-header">
  <ul class="anc-6310-nav">
    <li>
      <a href="<?php echo admin_url("admin.php?page=anc-6310-animated-number-counter"); ?>" class="<?php if(isset($_GET['page']) && ($_GET['page'] == 'anc-6310-animated-number-counter' || $_GET['page'] == 'anc-6310-counter-01-10' || $_GET['page'] == 'anc-6310-counter-11-20')) echo "anc-6310-active" ?>">Short code &amp; Templates</a>
      <ul>
      <li>
        <a href="<?php echo admin_url("admin.php?page=anc-6310-animated-number-counter"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-animated-number-counter') echo "anc-6310-active" ?>">All Shortcode</a>
      </li>
      <li>
        <a href="<?php echo admin_url("admin.php?page=anc-6310-counter-01-10"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-counter-01-10') echo "anc-6310-active" ?>">Template 01-10</a>
      </li>
      <li>
        <a href="<?php echo admin_url("admin.php?page=anc-6310-counter-11-20"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-counter-11-20') echo "anc-6310-active" ?>">Template 11-20</a>
      </li>
      <li>
        <a href="<?php echo admin_url("admin.php?page=anc-6310-counter-21-30"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-counter-21-30') echo "anc-6310-active" ?>">Template 21-30</a>
      </li>
      </ul>
    </li>

    <li>
      <a href="<?php echo admin_url("admin.php?page=anc-6310-accordion-add-edit"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-accordion-add-edit') echo "anc-6310-active" ?>">Manage Counter Profiles</a>
    </li>
    <li>
      <a href="<?php echo admin_url("admin.php?page=anc-6310-animated-number-counter-license"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-animated-number-counter-license') echo "anc-6310-active" ?>">License</a>
    </li>
    <li>
      <a href="<?php echo admin_url("admin.php?page=anc-6310-animated-number-counter-use"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-animated-number-counter-use') echo "anc-6310-active" ?>">How to Use</a>
    </li>
    <li>
      <a href="<?php echo admin_url("admin.php?page=anc-6310-wpmart-plugins"); ?>" class="<?php if(isset($_GET['page']) && $_GET['page'] == 'anc-6310-wpmart-plugins') echo "anc-6310-active" ?> anc-6310-plugin-menu">WpMart Plugins</a>
    </li>
    <li>
      <a href="https://www.wpmart.org/downloads/animated-number-counters/" target="_blank" class="anc-6310-pro">Upgrade to Pro<i class="fas fa-star"></i></a>
    </li>
  </ul>

  <h3>
    <span class="dashicons dashicons-flag"></span>
    Notifications
  </h3>
  <p>Thank you for using the "Animated Number Counter" plugin free version. I Just wanted to see if you have any questions or concerns about my plugins. If you do, Please do not hesitate to <a href="https://wordpress.org/support/plugin/team-showcase-supreme/" target="_blank">file a bug report</a></p>
  <p>By the way, did you know we also have a <a href="https://wpmart.org/downloads/number-counter//" target="_blank">Premium Version</a>? It offers 30+ templates with exclusive CSS3 effects. It also comes with 16/7 personal support.</p>
  <p>Thank you Again!</p>
  <?php 
    anc_6310_check_field_exists();
    anc_6310_version_status(); 
  ?>
</div>