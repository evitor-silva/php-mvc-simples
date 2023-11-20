<?php
namespace Html\Mvc\Core;

class Core
{
    private $url, $controller;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function __call($method, $controller)
    {
        $route = preg_replace('/[\/]/', '\\/', $controller[0]);
        $route = '/^' . $route . '$/i';

        if (!method_exists($controller[1], $method)) {
            throw new \Exception('Erro no controller ' . $method);
        }

        $this->controller[$route] = [$controller[1], $method];
    }

    public function dispararRotas($erro, $controller)
    {
        foreach ($this->controller as $key => $value) {
            if (preg_match($key, $this->url, $routes)) {
                echo call_user_func(array(new $value[0], $value[1]));
                return;
            }
        }
        return call_user_func(array(new $controller, $erro));
    }


}

/*

    CRIADO POR VITOR GABRIEL E SILVA EM 14/02/2023
    GITHUB: https://github.com/vitor-e-silva
    LINKEDIN: https://www.linkedin.com/in/vitor-silva-8a4ab8226/

    Config nginx:
    
      location / {
        root   html;
        try_files $uri $uri/ /index.php?route=$uri$is_args$args;
        index  index.php;
      }

*/