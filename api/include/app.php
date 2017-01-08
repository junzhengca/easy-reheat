<?php
    class App {
        public $routes;

        function __construct(){
            $this->routes = array();
            // Add default notfound route
            $this->add("notfound",function(){
                echo "404";
            });
        }

        function add($name, $func){
            $this->routes[$name] = $func;
        }

        function route($name){
            if(!empty($this->routes[$name])){
                $this->routes[$name]();
            } else {
                $this->routes["notfound"]();
            }
        }
    }
?>
