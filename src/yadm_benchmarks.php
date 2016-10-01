<?php
include __DIR__.'/setup.php';

function yadm_create_models(\Makasim\Yadm\MongodbStorage $yadmStorage)
{
    foreach (range(1, 10000) as $index) {
        $price = new \YadmBenchmark\YadmPrice();
        $price->setAmount(10);
        $price->setCurrency('USD');

        $order = new \YadmBenchmark\YadmOrder();
        $order->setNumber(12345);
        $order->setPrice($price);

        $yadmStorage->insert($order);
    }
}
$stopwatch->start('yaml_create_models');
yadm_create_models($yadmStorage);
print_event('Yadm create 10000 models', $stopwatch->stop('yaml_create_models'));

function yadm_create_models_single_flush(\Makasim\Yadm\MongodbStorage $yadmStorage)
{
    $orders = [];
    foreach (range(1, 10000) as $index) {
        $price = new \YadmBenchmark\YadmPrice();
        $price->setAmount(10);
        $price->setCurrency('USD');

        $order = new \YadmBenchmark\YadmOrder();
        $order->setNumber(12345);
        $order->setPrice($price);

        $orders[] = $order;
    }

    $yadmStorage->insertMany($orders);
}
$stopwatch->start('yadm_create_10000_models_single_flush');
yadm_create_models_single_flush($yadmStorage);
print_event('Yadm create 10000 models. SF', $stopwatch->stop('yadm_create_10000_models_single_flush'));

function yadm_find_models(\Makasim\Yadm\MongodbStorage $yadmStorage) {
    $count = 0;
    foreach ($yadmStorage->find() as $yadmOrder) {
        /** @var \YadmBenchmark\YadmOrder $yadmOrder */

        $yadmOrder->getNumber();
        $yadmOrder->getPrice();
        $yadmOrder->getPrice()->getCurrency();
        $yadmOrder->getPrice()->getAmount();

        $count++;
    }
}

$stopwatch->start('yaml_find_models');
yadm_find_models($yadmStorage);
print_event('Yadm find 10000 models', $stopwatch->stop('yaml_find_models'));
