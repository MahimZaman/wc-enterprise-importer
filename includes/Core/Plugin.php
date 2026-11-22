<?php

namespace WCEI\Core;

use WCEI\REST\Import_Controller;

class Plugin {

    private static $instance = null;

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        $this->autoload();
        $this->hooks();
    }

    private function autoload() {
        spl_autoload_register(function ($class) {

            if (strpos($class, 'WCEI\\') !== 0) {
                return;
            }

            $class = str_replace('WCEI\\', '', $class);
            $class = str_replace('\\', '/', $class);

            $file = WCEI_PLUGIN_PATH . 'includes/' . $class . '.php';

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }

    private function hooks() {

        add_action('rest_api_init', function () {
            (new Import_Controller())->register_routes();
        });

    }
}