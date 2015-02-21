<?php

namespace Application\Module\Test\Config;


/**
 * @class Configurator
 * @namespace Application\Configurator
 *
 * @description Handles application configuration 
 * @author notihnio
 */
class Routes {

    public static function routes() {
        return array(
           
            array(
                "type" => "normal",
                "route" => "/test/:test",
                "controller" => "Index",
                "action" => "Index",
                "module" => "Test",
            ),
            
            
        );
    }

}
