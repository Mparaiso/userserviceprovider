<?php

namespace Mparaiso\User\Utils;

/**
 * Description of ITemplating
 *
 * @author Mparaiso <mparaiso@online.fr>
 */
interface ITemplating {

    function renderResponse($template, array $data);
}

