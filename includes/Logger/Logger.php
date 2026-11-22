<?php

namespace WCEI\Logger;

class Logger {

    public static function info($message, array $context = []) {

        error_log(
            '[WCEI] ' .
            $message .
            ' ' .
            wp_json_encode($context)
        );
    }

    public static function error($message, array $context = []) {

        error_log(
            '[WCEI ERROR] ' .
            $message .
            ' ' .
            wp_json_encode($context)
        );
    }
}