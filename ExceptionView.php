<?php

namespace Jadob\Debug;


class ExceptionView
{
    public static function showErrorPage($template, $environment, array $params = [])
    {
        extract($params, true);

        require_once __DIR__ . '/Resources/templates/' . $environment . '/' . $template . '.php';

    }

    public static function getVariableType($variable)
    {

        if ($variable === null) {
            return 'null';
        }

        if (\is_scalar($variable)) {
            return $variable;
        }

        if (\is_object($variable)) {
            return \get_class($variable);
        }

        if (\is_array($variable)) {
            return 'array';
        }

        if (\is_resource($variable)) {
            return 'resource';
        }

        return 'unknown';
    }

    public static function parseParams($params)
    {
        $output = [];
        if (!\is_array($params)) {
            return htmlspecialchars(self::getVariableType($params));
        }
        foreach ($params as $param) {
            $output[] = htmlspecialchars(self::getVariableType($param));
        }

        return implode(',', $output);
    }
}