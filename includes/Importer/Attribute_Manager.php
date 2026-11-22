<?php

namespace WCEI\Importer;

class Attribute_Manager {

    public function ensure_global_attribute($name, $label) {

        global $wpdb;

        $exists = wc_attribute_taxonomy_id_by_name($name);

        if ($exists) {
            return $exists;
        }

        return wc_create_attribute([
            'name' => $label,
            'slug' => $name,
            'type' => 'select'
        ]);
    }

    public function ensure_term($taxonomy, $term) {

        $exists = term_exists($term, $taxonomy);

        if ($exists) {
            return $exists['term_id'];
        }

        $created = wp_insert_term(
            $term,
            $taxonomy
        );

        return $created['term_id'];
    }
}