<?php
namespace app\core;
class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Checa se a URL está vazia e define o controlador padrão se estiver.
        if(empty($url)) {
            $url[0] = $this->controller;
        }

        if(file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        } else {
            // Se o arquivo do controlador não existir, use um controlador de erro, por exemplo, ErrorController.php
            $this->controller = 'Error404'; // Certifique-se de criar esse controlador
            $this->method = 'index'; // Um método para mostrar a página 404
        }

        require_once '../app/controllers/' . $this->controller . 'Controller.php';
        $this->controller = new $this->controller;

        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
