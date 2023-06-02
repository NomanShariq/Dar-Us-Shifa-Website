<?php

  /**
   * Main renderer for the Black Friday Banner
   *
   * @category Child Plugin
   * @author iClyde <kontakt@iclyde.pl>
   */

  // Namespace
  namespace Inisev\Subs;

  // Disallow direct access
  if (!defined('ABSPATH')) exit;

?>

<div id="inis-bf-box" data-slug="<?php echo $this->slug; ?>">
  <img id="inis-bf-bg" draggable="false" src="<?php echo $this->asset('img', 'bg.webp'); ?>" alt="background-black-friday">
  <img id="inis-bf-close" draggable="false" src="<?php echo $this->asset('img', 'close.svg'); ?>" alt="black-friday-banner-close-btn">
  <a href="<?php echo $this->dealURL; ?>" target="_blank">
    <img id="inis-bf-btn" draggable="false" src="<?php echo $this->asset('img', 'btn.svg'); ?>" alt="black-friday-check-deal-btn">
  </a>
  <div id="inis-brought-by">Brought to you with ❤️ by <b><?php echo $this->displayName; ?></b></div>
</div>
