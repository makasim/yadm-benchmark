Benchmarks for mongodb, yadm, doctrine orm and doctrine odm libraries.

To run them you have to build docker container and run them.

```bash
$ composer install
$ docker-compose build
$ docker-compose up -d
```

Now, you ready to start your tests:

```
$ ./run-benchmark.sh 
```

The output looks like this:

```
Bench: Mongodb create 10000 models        	6.00 MiB	2110 ms
Bench: Mongodb create 10000 models. SF    	10.00 MiB	103 ms
Bench: Mongodb find 10000 models          	10.00 MiB	24 ms
Bench: Yadm create 10000 models           	6.00 MiB	2650 ms
Bench: Yadm create 10000 models. SF       	28.00 MiB	226 ms
Bench: Yadm find 10000 models             	28.00 MiB	171 ms
Bench: DoctrineORM create 100 models      	6.00 MiB	2416 ms
Bench: DoctrineORM create 10000 models. SF	50.00 MiB	1957 ms
Bench: DoctrineORM find 10000 models.     	52.00 MiB	2041 ms
Bench: DoctrineODM create 100 models      	4.25 MiB	294 ms
Bench: DoctrineODM create 10000 models. SF	84.50 MiB	2452 ms
Bench: DoctrineODM find 10000 models.     	44.00 MiB	544 ms
```

Here's results: https://docs.google.com/spreadsheets/d/1CzVQuAz6cVAUKZyoQZyagQv48mgA3JAYJ2dNsoALV7A/edit#gid=0



