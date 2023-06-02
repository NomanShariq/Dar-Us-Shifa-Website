<?php

/*
 * Created by Artureanec
*/

class helpoHelper
{
    static private $instance;
    public $footerJS = array();

    public static function getInstance()
    {
        if (empty(self::$instance))
            self::$instance = new self;

        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    public function addJSToFooter($name, $string, $init = 'document-ready')
    {
        $this->footerJS[$name]['init'] = $init;
        $this->footerJS[$name]['string'] = $string;
    }

    public function echoJSToFooter()
    {
        if (is_array($this->footerJS)) {
            $array_dready = array();
            $array_window_load = array();
            $array_none = array();
            foreach ($this->footerJS as $key => $value) {

                if ($value['init'] == 'document-ready') {
                    $array_dready[] = $value['string'];
                }

                if ($value['init'] == 'window-load') {
                    $array_window_load[] = $value['string'];
                }

                if ($value['init'] == 'none') {
                    $array_none[] = $value['string'];
                }

            }

            wp_add_inline_script('helpo-theme', '
                ' . (count($array_dready) > 0 ? 'jQuery(document).ready(function () {' . implode(' ', $array_dready) . '});' : '') . '
                ' . (count($array_window_load) > 0 ? 'jQuery(window).load(function () {' . implode(' ', $array_window_load) . '});' : '') . '
                ' . implode(' ', $array_none) . '
            ');
        }
    }

    public function echoFooter()
    {
        self::echoJSToFooter();
    }
}