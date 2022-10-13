<?php

spl_autoload_register(function($classe) {
    $classe = str_replace('\\', '/', $classe);
    require '../'.$classe.'.php';
});