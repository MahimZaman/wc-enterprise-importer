<?php

namespace WCEI\Importer;

class Taxonomy_Manager {

    public function assign_terms(
        $product_id,
        array $terms,
        $taxonomy
    ) {

        $term_ids = [];

        foreach ($terms as $term) {

            $exists = term_exists($term, $taxonomy);

            if (!$exists) {

                $exists = wp_insert_term(
                    $term,
                    $taxonomy
                );
            }

            $term_ids[] = (int) $exists['term_id'];
        }

        wp_set_object_terms(
            $product_id,
            $term_ids,
            $taxonomy
        );
    }
}