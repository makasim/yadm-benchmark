FROM ubuntu:16.04

RUN set -x && \
    mkdir -p /app

## libs
RUN set -x && \
    apt-get update && \
    apt-get install -y --no-install-recommends wget curl openssl ca-certificates nano && \
    apt-get install -y --no-install-recommends php php-mysql php-curl php-intl php-mbstring php-xml php-zip php-mcrypt php-mongodb

ADD . /app

WORKDIR /app

CMD /app/run-container.sh