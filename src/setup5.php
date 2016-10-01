<?php

include __DIR__.'/../vendor/autoload.php';

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\MongoDB\Configuration as OdmConfiguration;
use Doctrine\MongoDB\Connection as OdmConnection;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;

$stopwatch = new Stopwatch();

function print_event($msg, StopwatchEvent $event) {
    $msg = str_pad($msg, 35);

    $eventMsg = sprintf("%.2F MiB\t%d ms", $event->getMemory() / 1024 / 1024, $event->getDuration());

    echo 'Bench: '.$msg."\t".$eventMsg."\n";
}

// Doctrine ODM

$driver = new MappingDriverChain();
AnnotationDriver::registerAnnotationClasses();
$annotationDriver = new AnnotationDriver(new AnnotationReader(), [__DIR__.'/Document']);
$driver->addDriver($annotationDriver, 'YadmBenchmark\Document');

$config = new OdmConfiguration();
$config->setProxyDir(\sys_get_temp_dir());
$config->setProxyNamespace('OdmProxies');
$config->setHydratorDir(\sys_get_temp_dir());
$config->setHydratorNamespace('OdmHydrators');
$config->setMetadataDriverImpl($driver);
$config->setMetadataCacheImpl(new ArrayCache());
$config->setDefaultDB('doctrine_odm');
$connection = new OdmConnection('mongodb://mongodb:27017', array(), $config);
$documentManager = DocumentManager::create($connection, $config);
$documentManager->getConnection()->selectDatabase('doctrine_odm')->drop();