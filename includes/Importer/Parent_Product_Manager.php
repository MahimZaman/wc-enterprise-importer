<?php

namespace WCEI\Importer;

use WC_Product_Variable;

class Parent_Product_Manager {

    public function resolve(array $row) {

        $normalized = $this->normalize(
            $row['product_name']
        );

        $existing = $this->find_existing($normalized);

        if ($existing) {
            return $existing;
        }

        return $this->create_parent(
            $normalized,
            $row
        );
    }

    private function normalize($name) {

        $name = strtolower($name);

        $patterns = [
            '/\b(black|white|blue|red)\b/',
            '/\b(xs|s|m|l|xl|xxl)\b/',
            '/\b\d+gb\b/',
        ];

        $name = preg_replace($patterns, '', $name);

        return sanitize_title($name);
    }

    private function find_existing($slug) {

        $posts = get_posts([
            'post_type' => 'product',
            'post_status' => 'any',
            'posts_per_page' => 1,
            'name' => $slug
        ]);

        return !empty($posts)
            ? $posts[0]->ID
            : false;
    }

    private function create_parent($slug, $row) {

        $product = new WC_Product_Variable();

        $product->set_name($row['product_name']);

        $product->set_slug($slug);

        $product->save();

        return $product->get_id();
    }
}