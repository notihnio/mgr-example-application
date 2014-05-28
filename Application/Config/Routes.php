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
                "route" => "/articlee/theedit/:id",
                "controller" => "Articles",
                "action" => "Edit",
                "module" => "Index",
            ),
            array(
                "type" => "normal",
                "route" => "/articlee/:test",
                "controller" => "Articles",
                "action" => "Index",
                "module" => "Index",
            ),
            
            
        );
    }

}
