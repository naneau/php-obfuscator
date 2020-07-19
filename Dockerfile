FROM alpine

MAINTAINER Alexander Zierhut <info@zierhut-it.de>
LABEL maintainer="info@zierhut-it.de"

RUN apk add --no-cache git composer openssl php-common php-bcmath php-json php-mbstring php-tokenizer

WORKDIR /obfuscate
RUN git clone https://github.com/naneau/php-obfuscator . && composer install

ENTRYPOINT ["/obfuscate/bin/obduscate" "obfuscate"]