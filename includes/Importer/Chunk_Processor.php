<?php

namespace WCEI\Importer;

class Chunk_Processor {

    public function process(array $chunk) {

        $importer = new Product_Importer();

        foreach ($chunk as $row) {

            try {

                $importer->import($row);

            } catch (\Throwable $e) {

                Retry_Manager::retry($row);

            }
        }
    }
}