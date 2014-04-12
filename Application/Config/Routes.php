<?php

namespace Application\Config;

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
                "route" => "/article/:test/*",
                "controller" => "Articles",
                "action" =>"Index",
                "module" =>"Index",  
            )
        );
    }

}
