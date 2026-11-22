<?php

namespace WCEI\REST;

use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;
use WCEI\Importer\Queue_Manager;
use WCEI\Logger\Logger;

class Import_Controller extends WP_REST_Controller {

    public function register_routes() {

        register_rest_route('wcei/v1', '/import', [
            'methods' => 'POST',
            'callback' => [$this, 'import'],
            'permission_callback' => [$this, 'permission_check'],
        ]);
    }

    public function permission_check($request) {

        $token = $request->get_header('x-api-key');

        $saved = get_option('wcei_api_key');

        return hash_equals($saved, $token);
    }

    public function import(WP_REST_Request $request) {

        $body = $request->get_json_params();

        if (empty($body) || !is_array($body)) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Invalid payload.'
            ], 400);
        }

        $queue = new Queue_Manager();

        $batch_id = $queue->push($body);

        Logger::info('Batch queued', [
            'batch_id' => $batch_id
        ]);

        return new WP_REST_Response([
            'success' => true,
            'batch_id' => $batch_id,
            'queued' => count($body)
        ]);
    }
}