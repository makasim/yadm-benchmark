<?php
include __DIR__.'/setup5.php';

function doctrine_odm_create_models(\Doctrine\ODM\MongoDB\DocumentManager $documentManager)
{
    $count = 100;
    foreach (range(1, $count) as $index) {
        $price = new \YadmBenchmark\Document\OdmPrice();
        $price->setAmount(10);
        $price->setCurrency('USD');

        $order = new \YadmBenchmark\Document\OdmOrder();
        $order->setNumber(12345);
        $order->setPrice($price);

        $documentManager->persist($order);
        $documentManager->flush();
    }
}
$stopwatch->start('doctrine_odm_create_100_models');
doctrine_odm_create_models($documentManager);
print_event('DoctrineODM create 100 models', $stopwatch->stop('doctrine_odm_create_100_models'));

$documentManager->clear();

function doctrine_odm_create_models_single_flush(\Doctrine\ODM\MongoDB\DocumentManager $documentManager)
{
    $count = 10000;
    foreach (range(1, $count) as $index) {
        $price = new \YadmBenchmark\Document\OdmPrice();
        $price->setAmount(10);
        $price->setCurrency('USD');

        $order = new \YadmBenchmark\Document\OdmOrder();
        $order->setNumber(12345);
        $order->setPrice($price);

        $documentManager->persist($order);
    }

    $documentManager->flush();
}
$stopwatch->start('doctrine_odm_create_10000_models_single_flush');
doctrine_odm_create_models_single_flush($documentManager);
print_event('DoctrineODM create 10000 models. SF', $stopwatch->stop('doctrine_odm_create_10000_models_single_flush'));

$documentManager->clear();

function doctrine_odm_find_models(\Doctrine\ODM\MongoDB\DocumentManager $documentManager) {
    $count = 0;
    foreach ($documentManager->getRepository(\YadmBenchmark\Document\OdmOrder::class)->findAll() as $odmOrder) {
        /** @var \YadmBenchmark\Document\OdmOrder $odmOrder */

        $odmOrder->getNumber();
        $odmOrder->getPrice();
        $odmOrder->getPrice()->getCurrency();
        $odmOrder->getPrice()->getAmount();

        $count++;

        if ($count >= 10000) {
            break;
        }
    }
}
$stopwatch->start('doctrine_odm_find_10000_models');
doctrine_odm_find_models($documentManager);
print_event('DoctrineODM find 10000 models.', $stopwatch->stop('doctrine_odm_find_10000_models'));