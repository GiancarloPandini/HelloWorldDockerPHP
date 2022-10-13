<?php

set_exception_handler(function ($exception) {
    /** @var Exception $exception */
    if ($exception->getCode() == 404) {
        http_response_code($exception->getCode());
        include('../public/notFound.html');
        return;
    }
    if ($exception->getCode() == 400) {
        http_response_code($exception->getCode());
        echo "{\"error\":\"{$exception->getMessage()}\"}";
        return;
    }
    
    throw $exception;
    
});