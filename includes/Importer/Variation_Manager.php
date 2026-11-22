<?php

namespace WCEI\Importer;

use WC_Product_Variation;

class Variation_Manager {

    public function import($parent_id, array $row) {

        $variation_id = wc_get_product_id_by_sku(
            $row['sku']
        );

        if ($variation_id) {

            $variation = new WC_Product_Variation(
                $variation_id
            );

        } else {

            $variation = new WC_Product_Variation();

            $variation->set_parent_id($parent_id);
        }

        $variation->set_sku($row['sku']);

        $variation->set_regular_price(
            $row['price']
        );

        $variation->save();

        do_action(
            'wcei_after_variation_import',
            $variation,
            $row
        );
    }
}