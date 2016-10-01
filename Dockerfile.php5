FROM ubuntu:14.04

RUN set -x && \
    mkdir -p /app

## libs
RUN set -x && \
    apt-get update && \
    apt-get install -y --no-install-recommends wget curl openssl ca-certificates nano

RUN apt-get install -y --no-install-recommends php5 php5-cli php5-mysql php5-curl php5-intl php5-mcrypt php5-mongo

ADD . /app

WORKDIR /app

CMD /app/run-container.sh