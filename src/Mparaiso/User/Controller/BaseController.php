<?php

namespace Mparaiso\User\Controller;

use Silex\Application;

class BaseController {

    protected $app;
    
    /**
     * SET $app
     * @param \Silex\Application $app
     */
    function setApp(Application $app) {
        $this->app = $app;
    }

}