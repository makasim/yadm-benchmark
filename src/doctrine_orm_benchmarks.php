<?php
include __DIR__.'/setup.php';

function doctrine_orm_create_models(\Doctrine\ORM\EntityManagerInterface $entityManager)
{
    $count = 100;
    foreach (range(1, $count) as $index) {
        $price = new \YadmBenchmark\Entity\OrmPrice();
        $price->setAmount(10);
        $price->setCurrency('USD');

        $order = new \YadmBenchmark\Entity\OrmOrder();
        $order->setNumber(12345);
        $order->setPrice($price);

        $entityManager->persist($order);
        $entityManager->flush();
    }
}
$stopwatch->start('doctrine_orm_create_100_models');
doctrine_orm_create_models($entityManager);
print_event('DoctrineORM create 100 models', $stopwatch->stop('doctrine_orm_create_100_models'));

$entityManager->clear();

function doctrine_orm_create_models_single_flush(\Doctrine\ORM\EntityManagerInterface $entityManager)
{
    $count = 10000;
    foreach (range(1, $count) as $index) {
        $price = new \YadmBenchmark\Entity\OrmPrice();
        $price->setAmount(10);
        $price->setCurrency('USD');

        $order = new \YadmBenchmark\Entity\OrmOrder();
        $order->setNumber(12345);
        $order->setPrice($price);

        $entityManager->persist($order);
    }

    $entityManager->flush();
}
$stopwatch->start('doctrine_orm_create_10000_models_single_flush');
doctrine_orm_create_models_single_flush($entityManager);
print_event('DoctrineORM create 10000 models. SF', $stopwatch->stop('doctrine_orm_create_10000_models_single_flush'));

$entityManager->clear();

function doctrine_orm_find_models(\Doctrine\ORM\EntityManagerInterface $entityManager) {
    $count = 0;
    foreach ($entityManager->getRepository(\YadmBenchmark\Entity\OrmOrder::class)->findAll() as $ormOrder) {
        /** @var \YadmBenchmark\Entity\OrmOrder $ormOrder */

        $ormOrder->getNumber();
        $ormOrder->getPrice();
        $ormOrder->getPrice()->getCurrency();
        $ormOrder->getPrice()->getAmount();

        $count++;

        if ($count >= 10000) {
            break;
        }
    }
}
$stopwatch->start('doctrine_orm_find_10000_models');
doctrine_orm_create_models_single_flush($entityManager);
print_event('DoctrineORM find 10000 models.', $stopwatch->stop('doctrine_orm_find_10000_models'));

doctrine_orm_find_models($entityManager);