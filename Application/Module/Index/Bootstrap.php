<?php

/**
  @author Panagiotis Mastrandrikos <pmstrandrikos@gmail.com>  https://github.com/notihnio

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

 */

namespace Application\Module\Index;

/**
 * @name Bootrsrap 
 * @description Bootstraping application
 * 
 */
class Bootstrap {
    
    public static function go() {
        
        \Mgr\Event\Event::bind('init', function($args = array()){
            
         });
         
         \Mgr\Event\Event::bind('predispach', function($args = array()){
             
             
         });
         
         \Mgr\Event\Event::bind('postdispach', function($args = array()){
           

         });
         
         \Mgr\Event\Event::bind('router.preDispach', function($args = array()){
               
         });
         
         \Mgr\Event\Event::bind('router.postDispach', function($args = array()){
              
             
         });
        
    }
   
}
