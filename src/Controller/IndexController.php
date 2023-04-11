<?php

namespace Universum\Controller;

use Universum\TemplateEngine;

/**
 * @author Samuel Oberger Rockenbach <samuel.rockenbach@universo.univates.br>
 * @since february-2023
 * @version 1.0
 */
class IndexController
{
    public function render()
    {
        $template = new TemplateEngine();
        $template->render('main.php');
    }
}
