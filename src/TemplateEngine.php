<?php

namespace Universum;

use Exception;

/**
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
 * @since february-2023
 * @version 1.0
 */
class TemplateEngine
{
    protected $templateDir = "templates/";

    protected $vars = [];

    /**
     * @method __construct
     * @param $templatesDir
     * @return void
     */
    public function __construct($templatesDir = null)
    {
        if($templatesDir !== null)
        {
            $this->templateDir = $templatesDir;
        }
    }

    /**
     * @method render
     * @param $templateFile
     * @return void
     */
    public function render($templateFile)
    {
        $path = "{$this->templateDir}{$templateFile}";
        if(file_exists($path))
        {
            include $path;
        }
        else {
            throw new Exception("Template file {$templateFile} not present in {$this->templateDir}");
        }
    }

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function __get($name) {
        return $this->vars[$name];
    }
}
