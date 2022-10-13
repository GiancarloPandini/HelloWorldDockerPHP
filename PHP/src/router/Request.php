<?php

namespace src\router;

use Exception;

class Request
{

    public static function queryParamAsInteger(string $nome, $defaultVal = null)
    {
        return filter_var(self::queryParam($nome, $defaultVal), FILTER_SANITIZE_NUMBER_INT);
    }

    public static function queryParamAsFloat(string $nome, $defaultVal = null)
    {
        return filter_var(self::queryParam($nome, $defaultVal), FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public static function queryParamAsString(string $nome, $defaultVal = null)
    {
        return htmlspecialchars(self::queryParam($nome, $defaultVal));
    }

    public static function postInputAsInteger(string $nome, $defaultVal = null)
    {
        return filter_var(self::postInput($nome, $defaultVal), FILTER_SANITIZE_NUMBER_INT);
    }

    public static function postInputAsFloat(string $nome, $defaultVal = null)
    {
        return filter_var(self::postInput($nome, $defaultVal), FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public static function postInputAsString(string $nome, $defaultVal = null)
    {
        return htmlspecialchars(self::postInput($nome, $defaultVal));
    }

    public static function initPostFromPhpInput()
    {
        $_POST = json_decode(file_get_contents("php://input"),true);
    }

    private static function queryParam(string $nome, $defaultVal)
    {
        if (isset($_GET[$nome])) {
            return $_GET[$nome];
        }

        if ($defaultVal !== null) {
            return $defaultVal;
        }

        throw new Exception("Query param '{$nome}' não enviado", 400);
    }

    private static function postInput(string $nome, $defaultVal)
    {
        if (isset($_POST[$nome])) {
            return $_POST[$nome];
        }

        if ($defaultVal !== null) {
            return $defaultVal;
        }

        throw new Exception("Parametro Post '{$nome}' não enviado", 400);
    }
}
