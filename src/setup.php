<?php

include __DIR__.'/../vendor/autoload.php';

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Configuration as OrmConfiguration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Makasim\Yadm\Hydrator;
use Makasim\Yadm\MongodbStorage;
use MongoDB\Client;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;
use YadmBenchmark\YadmOrder;

$stopwatch = new Stopwatch();

function print_event($msg, StopwatchEvent $event) {
    $msg = str_pad($msg, 35);

    $eventMsg = sprintf("%.2F MiB\t%d ms", $event->getMemory() / 1024 / 1024, $event->getDuration());

    echo 'Bench: '.$msg."\t".$eventMsg."\n";
}

// Yadm setup
$mongodbClient = new Client('mongodb://mongodb:27017');
$plainCollection = $mongodbClient->selectCollection('benchmarks', 'mongodb_benchmark');
$plainCollection->drop();

// Yadm setup
$mongodbClient = new Client('mongodb://mongodb:27017');
$yadmCollection = $mongodbClient->selectCollection('benchmarks', 'yadm_benchmark');
$yadmCollection->drop();

$yadmStorage = new MongodbStorage($yadmCollection, new Hydrator(YadmOrder::class));

// Doctrine ORM setup

$config = new OrmConfiguration();
$config->setAutoGenerateProxyClasses(true);
$config->setProxyDir(\sys_get_temp_dir());
$config->setProxyNamespace('Proxies');
$config->setQueryCacheImpl(new ArrayCache());
$config->setMetadataCacheImpl(new ArrayCache());

$driver = new MappingDriverChain();
$annotationDriver = $config->newDefaultAnnotationDriver(array(__DIR__.'/Entity'), false);
$driver->addDriver($annotationDriver, 'YadmBenchmark\Entity');
$config->setMetadataDriverImpl($driver);

$dbh = new PDO('mysql:host=mysql;', 'root', 'rootpass');
$dbh->exec('CREATE DATABASE yadm_benchmark;');
$dbh = null;

$connection = [
    'dbname' => 'yadm_benchmark',
    'user' => 'root',
    'password' => 'rootpass',
    'host' => 'mysql',
    'driver' => 'pdo_mysql'
];
$entityManager = EntityManager::create($connection, $config);

$schemaTool = new SchemaTool($entityManager);
$schemaTool->updateSchema($entityManager->getMetadataFactory()->getAllMetadata());