<?php

namespace Universum\Router;

/**
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
 * @since february-2023
 * @version 1.0
 */
class Routes
{
    public static function getRoutes()
    {
        return [
            'GET' => [
                '/' => ['IndexController', 'render']
            ],
            'POST' => [
            ]
        ];
    }
}
