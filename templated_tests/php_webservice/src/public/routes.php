<?php

use Slim\Exception\HttpBadRequestException;

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write(json_encode(["message" => "Welcome to the Slim application!"]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/current-date', function ($request, $response, $args) {
    $response->getBody()->write(json_encode(["date" => date('Y-m-d')]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/add/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (int)$args['num1'];
    $num2 = (int)$args['num2'];
    $response->getBody()->write(json_encode(["result" => $num1 + $num2]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/subtract/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (int)$args['num1'];
    $num2 = (int)$args['num2'];
    $response->getBody()->write(json_encode(["result" => $num1 - $num2]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/multiply/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (int)$args['num1'];
    $num2 = (int)$args['num2'];
    $response->getBody()->write(json_encode(["result" => $num1 * $num2]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/divide/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (int)$args['num1'];
    $num2 = (int)$args['num2'];
    if ($num2 == 0) {
        throw new HttpBadRequestException($request, "Cannot divide by zero");
    }
    $response->getBody()->write(json_encode(["result" => $num1 / $num2]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/square/{number}', function ($request, $response, $args) {
    $number = (int)$args['number'];
    $response->getBody()->write(json_encode(["result" => $number ** 2]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/sqrt/{number}', function ($request, $response, $args) {
    $number = (float)$args['number'];
    if ($number < 0) {
        throw new HttpBadRequestException($request, "Cannot take square root of a negative number");
    }
    $response->getBody()->write(json_encode(["result" => sqrt($number)]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/is-palindrome/{text}', function ($request, $response, $args) {
    $text = $args['text'];
    $is_palindrome = $text === strrev($text);
    $response->getBody()->write(json_encode(["is_palindrome" => $is_palindrome]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/days-until-new-year', function ($request, $response, $args) {
    $today = new DateTime();
    $next_new_year = new DateTime(($today->format('Y') + 1) . '-01-01');
    $interval = $today->diff($next_new_year);
    $response->getBody()->write(json_encode(["days_until_new_year" => $interval->days]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/echo/{message}', function ($request, $response, $args) {
    $message = $args['message'];
    $response->getBody()->write(json_encode(["message" => $message]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();