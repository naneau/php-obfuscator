FROM composer AS composer

WORKDIR /app

COPY composer.json .

RUN composer install \
        --ignore-platform-reqs \
        --no-interaction \
        --no-plugins \
        --no-scripts \
        --prefer-dist

# Final PHP Image
FROM php:7.2-alpine

WORKDIR /obfuscator

COPY ./ ./
COPY --from=composer /app/vendor/ /obfuscator/vendor/

ENV PATH="/obfuscator/bin:${PATH}"

ENTRYPOINT ["php", "/obfuscator/bin/obfuscate", "obfuscate"]