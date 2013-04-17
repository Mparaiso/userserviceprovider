<?php

namespace Mparaiso\User\Utils;

class TwigTemplating implements ITemplating {

    /**
     *
     * @var \Twig_Environment  
     */
    private $twig;

    function __construct(\Twig_Environment $twig) {
        $this->twig = $twig;
    }

    public function renderResponse($template, array $data) {
        return $this->twig->render($template, $data);
    }

}