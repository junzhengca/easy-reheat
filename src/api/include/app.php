<?php
    /* A class repersenting the API application
     */
    class App {
        // Container for route handlers
        public $routes;

        /* () -> null
         * Initialize App instance, also create a default notfound route.
         */
        function __construct(){
            $this->routes = array();
            // Add default notfound route
            $this->add("notfound",function(){
                echo "404";
            });
        }

        /* (string, function) -> null
         * Add a new API route, if route exists, override the existing one.
         * Handler should not take any arguments.
         */
        function add($name, $func){
            $this->routes[$name] = $func;
        }

        /* (string) -> null
         * Invoke a route event, this will call the handler.
         * If handler does not exist, notfound route will be invoked.
         */
        function route($name){
            // If route exists
            if(!empty($this->routes[$name])){
                $this->routes[$name]();
            // If route cannot be found
            } else {
                $this->routes["notfound"]();
            }
        }
    }
?>
