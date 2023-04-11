<?php

namespace Universum\Utils;

use ReflectionObject;

/**
 * Tranforma um objeto de classe em Json
 * 
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
 * @since july-2022
 * @version 1.0
 **/
class JsonObject 
{
    private $object;
    private $json;

    private function __construct() {}

    /**
     * Consome uma instancia de classe
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version july-2022
     * @since 1.0
     * 
     * @method build
     * @param object $object
     * @return self
     */
    public static function buildFromObject($object) 
    {
        $instance = new self();
        $instance->object = $object;
        return $instance;
    }

    /**
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version july-2022
     * @since 1.0
     * 
     * @method buildFromJson
     * @param string $json
     * @return self
     */
    public static function buildFromJson($json)
    {
        $instance = new self();
        $instance->setJson($json);
        return $instance;
    }

    /**
     * Retorna a string Json da classe
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version july-2022
     * @since 1.0
     * 
     * @method getJson
     * @param boolean $pretty : formata Json
     * @return string
     */
    public function getJsonFromObject($pretty = false)
    {
        if(!isset($this->json)) {
            return $this->buildJsonFromObject($pretty);
        }

        return $this->json;
    }

    /**
     * Gera um objeto a partir de um Json
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version july-2022
     * @since 1.0
     * 
     * @method getObjectFromJson
     * @return object
     */
    public function getObjectFromJson()
    {
        $json = $this->getJson();
        $decoded = json_decode($json);
        $object = [];

        foreach(
            new RecursiveArrayIterator(
                new RecursiveArrayIterator($decoded),
                RecursiveIteratorIterator::CATCH_GET_CHILD
            ) as $key => $value
        )
        {
            $object[$key] = $value;
        }

        return (object) $object;
    }

    /**
     * Constroi o JSON a partir do objeto
     * 
     * @author Samuel Oberger Rockenbach <samuel.rockenbach@univates.br>
     * @version july-2022
     * @since 1.0
     * 
     * @method buildJsonFromObject
     * @param boolean $pretty : formata Json
     * @param object
     * @return string
     */
    private function buildJsonFromObject($pretty = true)
    {
        $reflection = new ReflectionObject($this->object);

        $jsonArray = [];
        foreach($reflection->getProperties() as $property)
        {
            $property->setAccessible(true);
            $propertyName = $property->name;
            $this->object->$propertyName = $property->getValue($this->object);

            $jsonArray[$propertyName] = $property->getValue($this->object);
        }
        $pretty ? ($this->jsonString = stripslashes(json_encode($jsonArray, JSON_PRETTY_PRINT))) 
                : ($this->jsonString = stripslashes(json_encode($jsonArray)));

        return $this->jsonString;
    }

    /**
     * @method getJson
     */
    public function getJson()
    {
        return $this->json;
    }
    /**
     * @method setJson
     * @return self
     */
    public function setJson($json)
    {
        $this->json = $json;

        return $this;
    }
}
