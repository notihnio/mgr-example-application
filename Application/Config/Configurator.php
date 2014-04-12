<?php

namespace Application\Config;

/**
 * @class Configurator
 * @namespace Application\Configurator
 *
 * @description Handles application configuration 
 * @author notihnio
 */
class Configurator {

    public static function config() {
        $configs = array(
            "staging" => array(
                "siteUrl" => "somestageurl.com",
                "publicFolder" => ROOT . "/public",
                "cache" => "0", // 0|memcache|APC|filesystem
                "root" => ROOT,
                "defaults" => array(
                    "module" => "admin",
                    "controller" => "index",
                    "view" => "index"
                )
            ),
            "production" => array(
                "siteUrl" => "someproductionurl.com",
                "publicFolder" => ROOT . "/public",
                "root" => ROOT,
            ),
        );

        return $configs[APPLICATION_ENV];
    }

}
