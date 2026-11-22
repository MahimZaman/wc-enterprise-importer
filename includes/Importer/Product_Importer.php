<?php

namespace WCEI\Importer;

class Product_Importer {

    public function import(array $row) {

        $parent_manager = new Parent_Product_Manager();

        $parent_id = $parent_manager->resolve($row);

        $variation_manager = new Variation_Manager();

        $variation_manager->import(
            $parent_id,
            $row
        );
    }
}