# PHP Slim Application Example
An example web application written in PHP using the Slim framework for code coverage generation testing.

## Requirements
- Docker
- Composer

## How to run
1. Build the Docker image:
    ```sh
    docker build -t php-slim-app .
    ```

2. Run the Docker container:
    ```sh
    docker run -p 8080:8080 php-slim-app
    ```

The application will be accessible at `http://localhost:8080`.

## How to run tests
1. Install PHPUnit via Composer:
    ```sh
    composer require --dev phpunit/phpunit
    ```

2. Run the tests:
    ```sh
    vendor/bin/phpunit tests
    ```

## How to generate code coverage
1. Install Xdebug for code coverage:
    ```sh
    pecl install xdebug
    ```

2. Enable Xdebug in your `php.ini` file:
    ```ini
    zend_extension=xdebug.so
    xdebug.mode=coverage
    ```

3. Run the tests with code coverage:
    ```sh
    vendor/bin/phpunit --coverage-cobertura=cobertura.xml coverage
    ```

The coverage report will be generated in the `coverage` directory.