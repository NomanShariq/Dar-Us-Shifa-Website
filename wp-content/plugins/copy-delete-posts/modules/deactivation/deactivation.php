<?php

  /**
   * Deactivation free help offer module
   *
   * @category Child Plugin
   * @version v0.1.0
   * @since v0.1.0
   * @author iClyde <kontakt@iclyde.pl>
   * @author Artem K
   */

  // Namespace
  namespace Inisev\Subs;

  // Disallow direct access
  if (!defined('ABSPATH')) exit;

  /**
  * Main class for handling the Deactivation
  */
  if (!class_exists('Inisev\Subs\Inisev_Deactivation')) {
    class Inisev_Deactivation {

      // Variables
      private $assets_url;
      private $plugin_dir;

      /**
       * __construct - Initialization of the module
       * @param string $plugin Name with path to the plugin source file e.g. "backup-backup/backup-backup.php"
       *
       * @return void
      */
      function __construct($plugin, $plugin_dir, $plugin_file) {

        global $pagenow;
        if ($pagenow != 'plugins.php') return;

        $this->plugin_file = $plugin_file;
        $this->plugin_dir = $plugin_dir;
        $this->assets_url = plugin_dir_url($this->plugin_dir) . basename($plugin_dir);

        if (file_exists(trailingslashit(WP_PLUGIN_DIR) . $plugin)) {
          if (!isset($GLOBALS['IIEV_PLUGINS_DEACTIVATION'])) {
            $GLOBALS['IIEV_PLUGINS_DEACTIVATION'] = [];
          }
          if (!in_array($plugin, $GLOBALS['IIEV_PLUGINS_DEACTIVATION'])) {
            $GLOBALS['IIEV_PLUGINS_DEACTIVATION'][] = $plugin;
          }
        }

        $this->enableDeactivation();

      }

      /**
       * add_assets - Will add assets for that module
       *
       * @return void
       */
      public function add_assets() {

        wp_enqueue_script('inisev-deactivation-script', $this->__asset('assets/script.js'), [], filemtime($this->__asset('assets/script.js', true)), true);
        wp_enqueue_style('inisev-deactivation-style', $this->__asset('assets/style.css'), [], filemtime($this->__asset('assets/style.css', true)));

        add_action('wp_after_admin_bar_render', [&$this, 'render_content']);

      }

      /**
       * render_content - Will render content of our deactivation modal
       *
       * @return void
       */
      public function render_content() {

        require_once trailingslashit(__DIR__) . 'modal.php';

      }

      /**
       * __asset - Asset handler will return path
       *
       * @param  string $name Relative path to the file
       * @return string Absolute path to that file
       */
      private function __asset($name, $dir = false) {

        if ($dir == false) {
          return trailingslashit($this->assets_url) . 'modules' . DIRECTORY_SEPARATOR . 'deactivation' . DIRECTORY_SEPARATOR . $name;
        } else {
          return trailingslashit(__DIR__) . $name;
        }

      }

      /**
       * add_plugin_list - Will print out script with plugin array
       *
       * @return void
       */
      public function add_plugin_list() {

        $plugin_list = $GLOBALS['IIEV_PLUGINS_DEACTIVATION'];
        if (is_array($plugin_list) && sizeof($plugin_list) >= 1) {
          echo '<script type="text/javascript"> const IIEV_DEACTIV_PLUG_LIST = ' . json_encode($plugin_list) . ';</script>';
        }

      }

      /**
       * enableDeactivation - It will enable deactivation script & style
       *
       * @return void
       */
      private function enableDeactivation() {

        if (!defined('IIEV_ASSETS_LOADED_DEACTIV')) {
          define('IIEV_ASSETS_LOADED_DEACTIV', true);
          add_action('admin_enqueue_scripts', [&$this, 'add_assets']);
        }

        if (!defined('IIEV_LIST_MODULE_DEACTIV')) {
          define('IIEV_LIST_MODULE_DEACTIV', true);
          add_action('wp_print_scripts', [&$this, 'add_plugin_list']);
        }

      }

    }
  }
