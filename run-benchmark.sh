#!/usr/bin/env bash

docker exec -it yadmbenchmark_app7_1 php /app/src/mongodb_benchmarks.php
docker exec -it yadmbenchmark_app7_1 php /app/src/yadm_benchmarks.php
docker exec -it yadmbenchmark_app7_1 php /app/src/doctrine_orm_benchmarks.php
docker exec -it yadmbenchmark_app5_1 php /app/src/doctrine_odm_benchmarks.php

