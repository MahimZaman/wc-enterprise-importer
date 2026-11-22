<?php

namespace WCEI\Importer;

class Media_Handler {

    public function attach_images(
        $product_id,
        array $urls
    ) {

        foreach ($urls as $url) {

            $existing = attachment_url_to_postid($url);

            if ($existing) {
                continue;
            }

            media_sideload_image(
                $url,
                $product_id,
                null,
                'id'
            );
        }
    }
}