<?php

namespace WCEI\Importer;

class Queue_Manager {

    const CHUNK_SIZE = 100;

    public function push(array $rows) {

        $batch_id = uniqid('wcei_', true);

        $chunks = array_chunk($rows, self::CHUNK_SIZE);

        foreach ($chunks as $index => $chunk) {

            as_schedule_single_action(
                time() + ($index * 2),
                'wcei_process_chunk',
                [
                    'batch_id' => $batch_id,
                    'chunk' => $chunk
                ],
                'wcei'
            );
        }

        return $batch_id;
    }
}