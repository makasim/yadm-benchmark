<?php
include __DIR__.'/setup.php';

function mongodb_create_models(\MongoDB\Collection $collection)
{
    foreach (range(1, 10000) as $index) {
        $result = $collection->insertOne([
            'number' => 12345,
            'price' => [
                'amount' => 10,
                'currency' => 'USD',
            ]
        ]);
        if (false == $result->isAcknowledged()) {
            throw new \LogicException('Operation is not acknowledged');
        }
    }
}
$stopwatch->start('mongodb_create_models');
mongodb_create_models($plainCollection);
print_event('Mongodb create 10000 models', $stopwatch->stop('mongodb_create_models'));

function mongodb_create_models_single_flush(\MongoDB\Collection $collection)
{
    $data = [];
    foreach (range(1, 10000) as $index) {
        $data[] = [
            'number' => 12345,
            'price' => [
                'amount' => 10,
                'currency' => 'USD',
            ]
        ];
    }

    $result = $collection->insertMany($data);
    if (false == $result->isAcknowledged()) {
        throw new \LogicException('Operation is not acknowledged');
    }
}
$stopwatch->start('mongodb_create_models_single_flush');
mongodb_create_models_single_flush($plainCollection);
print_event('Mongodb create 10000 models. SF', $stopwatch->stop('mongodb_create_models_single_flush'));

function mongodb_find_models(\MongoDB\Collection $collection) {
    $cursor = $collection->find([]);
    $cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);

    foreach ($cursor as $order) {
    }
}

$stopwatch->start('mongodb_find_models');
mongodb_find_models($plainCollection);
print_event('Mongodb find 10000 models', $stopwatch->stop('mongodb_find_models'));
