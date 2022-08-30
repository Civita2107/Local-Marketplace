<?php

class CFrontController
{

    public function run ($path) {
        $method = $_SERVER['REQUEST_METHOD'];
        // loro ci hanno aggiunto qualocsa
        $resource = explode("/", $path);

        array_shift($resource);
        array_shift($resource);

        if ($resource[0] != "api") {
            $controller = "C" . $resource[0];
            $dir = "Controller";
            $eledir = scandir($dir);

            if (in_array($controller . ".php", $eledir)) {
                if (isset($resource[1])) {
                    $function = $resource[1];
                    if (method_exists($controller, $function)) {

                        $param = array();
                    }
                    for ($i =2; $i < count($resource); $i++) {
                        $param[] = $resource[$i];
                        $a = $i - 2; //non so a cosa serva
                    }
                    $num = count($param);

                    if ($num == 0) {
                        $controller::$function();
                    }
                    elseif ($num == 1) {
                        $controller::$function($param[0]);
                    }
                    elseif ($num == 2) {
                        $controller::$function($param[0], $param[1]);
                    }
                }
                else {
                    if (CUtente::isLogged()) {
                        //dobbiamo vedere come implementare
                    }
                }
            }
        }
    }
}