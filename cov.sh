#!/bin/bash
docker run --rm -v $(pwd):/app php-xdebug php ./vendor/bin/phpunit --coverage-html report