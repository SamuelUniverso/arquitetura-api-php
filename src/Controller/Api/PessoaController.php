<?php

namespace Universum\Controller\Api;

use InvalidArgumentException;
use Throwable;
use Universum\Model\Pessoa;
use Universum\Service\PessoaService;

/**
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
 * @since march-2023
 * @version 1.0
 */
class PessoaController
{
    /**
     * @method get
     * @param array
     * 
     * @since 1.0
     */
    public function get($route, $param)
    {
        if(is_numeric($route)) {
            exit(
                json_encode([
                    "success" => true,
                    "reponse" => "Pessoa {$route}"
                ])
            );
            
        }

        if($route == "all") {
            exit(
                json_encode([
                    "success"  => true,
                    "reponse" => "[Pessoas]"
                ])
            );
        }

    }

    /**
     * @method post
     * 
     * @since 1.0
     *  {
     *      "nome: "Nome",
     *      "email": "email@test.net",
     *      "telefone": "51987654321",
     *      "aniversario: "yyyy-mm-dd"
     *  }
     */
    public function post($route, $param)
    {
        $object = json_decode($param);
        $object->id = 1;
        exit(
            json_encode([
                "success"  => true,
                "message"  => "Pessoa successfully created",
                "response" => json_encode($object)
            ])
        );
    }

    /**
     * @method put
     * 
     * @since 1.0
     *  {
     *      "id": 221,
     *      "nome: "Nome",
     *      "email": "email@test.net",
     *      "telefone": "51987654321",
     *      "aniversario: "yyyy-mm-dd"
     *  }
     */
    public function put($route, $param)
    {
        exit(
            json_encode([
                "success"  => true,
                "message"  => "Pessoa sucessfully updated!",
                "response" => $param
            ])
        );
    }

    /**
     * @method delete
     * 
     * @since 1.0
     */
    public function delete($route, $param)
    {
        if(is_numeric($route)) {
            exit(
                json_encode([
                    "success" => true,
                    "message" => "Pessoa with id '{$route}' sucessfully deleted"
                ])
            );
        }
    }
    
}
