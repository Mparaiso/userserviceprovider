<?php

namespace Mparaiso\User\Utils;

use Symfony\Component\Templating\TemplateNameParserInterface;

class SilexTemplateNameParser implements TemplateNameParserInterface {

    public function parse($name) {
        return $name;
    }

}