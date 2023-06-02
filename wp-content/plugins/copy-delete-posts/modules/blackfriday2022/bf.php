<?php

  /**
   * File for our cool Black Friday info the header on our plugin menu page
   *
   * @category Child Plugin
   * @version v0.1.0
   * @since v0.1.0
   * @author iClyde <kontakt@iclyde.pl>
   */

  // Namespace
  namespace Inisev\Subs;

  // Disallow direct access
  if (defined('ABSPATH')) {

    /**
     * Main class for handling the Black Friday Banner
     */
    if (!class_exists('Inisev\Subs\InisevBlackFriday')) {
      class InisevBlackFriday {

        /**
         * __construct - Construct of the module for particular plugin
         *
         * @param  {sting}  $slug            Slug of the plugin
         * @param  {string} $displayName     Display name of the plugin
         * @param  {array}  $pluginURLs = [] URLs to all menu pages in back-end
         * @return {self}
         */
        function __construct($slug, $displayName, $dealURL, $pluginURLs = []) {

          $currentDate = explode(' ', date('Y m d'));

          if (intval($currentDate[0]) > 2022) return;
          if (intval($currentDate[1]) > 11) return;
          if (intval($currentDate[2]) > 29) return;

          $dismisses = get_option('ins_bf20_dismisses', []);
          $this->slug = $slug;
          add_action('wp_ajax_inis_bf20_dismiss', [&$this, 'handleActionsDismiss']);

          if (!is_array($dismisses)) return;
          if (!is_array($pluginURLs)) return;
          if (in_array($slug, $dismisses)) return;

          $notFoundInAllowed = true;
          for ($i = 0; $i < sizeof($pluginURLs); ++$i) {
            $part = $pluginURLs[$i];
            if (strpos(strtolower($_SERVER['REQUEST_URI']), strtolower($part)) !== false) {
              $notFoundInAllowed = false;
              break;
            }
          }

          if ($notFoundInAllowed) return;

          $this->displayName = $displayName;
          $this->dealURL = $dealURL;
          $this->dir = __DIR__ . DIRECTORY_SEPARATOR;
          $this->assets = 'assets' . DIRECTORY_SEPARATOR;
          add_action('admin_notices', [&$this, 'insertBanner']);
          add_action('admin_enqueue_scripts', [&$this, 'enqueueAssets']);

        }

        public function asset($type, $file) {

          $path = $this->assets . $type . DIRECTORY_SEPARATOR . $file;
          return plugins_url($path, __FILE__);

        }

        public function enqueueAssets() {

          wp_enqueue_script($this->slug . '-black-friday', $this->asset('', 'script.js'), [], '0.1.0', true);
          wp_enqueue_style($this->slug . '-black-friday', $this->asset('', 'styles.css'), [], '0.1.0');

        }

        public function insertBanner() {

          include_once $this->dir . 'views' . DIRECTORY_SEPARATOR . 'banner.php';

        }

        public function handleActionsDismiss() {

          $token = sanitize_text_field($_POST['token']);
          $slug = sanitize_text_field($_POST['slug']);
          if ($token === 'inis_bf20') {

            $dismissed = get_option('ins_bf20_dismisses', []);
            $dismissed[] = $slug;

            update_option('ins_bf20_dismisses', $dismissed);

            wp_send_json_success();

          }

        }

      }
    }

  }
