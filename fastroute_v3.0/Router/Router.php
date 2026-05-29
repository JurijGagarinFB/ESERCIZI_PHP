<?php
namespace Router;

class Router {
    private array $routes = [];

    public function __construct() {
        $this->addRoute('GET', '', 'HomeController', 'index');
        $this->addRoute('GET', 'home', 'HomeController', 'index');
        $this->addRoute('GET', 'contatti', 'HomeController', 'contatti');

        $this->addRoute('GET', 'login', 'AuthController', 'login');
        $this->addRoute('POST', 'login', 'AuthController', 'login');
        $this->addRoute('GET', 'logout', 'AuthController', 'logout');
        $this->addRoute('GET', 'cambia_password', 'AuthController', 'cambiaPassword');
        $this->addRoute('POST', 'cambia_password', 'AuthController', 'cambiaPassword');

        $this->addRoute('GET', 'dashboard', 'DashboardController', 'index');
        $this->addRoute('GET', 'clienti_inserisci', 'ClienteController', 'inserisci');
        $this->addRoute('POST', 'clienti_inserisci', 'ClienteController', 'inserisci');

        $this->addRoute('GET', 'plico_accettazione', 'PlicoController', 'accettazione');
        $this->addRoute('POST', 'plico_accettazione', 'PlicoController', 'accettazione');
        $this->addRoute('GET', 'plico_spedizione', 'PlicoController', 'spedizione');
        $this->addRoute('POST', 'plico_spedizione', 'PlicoController', 'spedizione');
        $this->addRoute('GET', 'plico_ritiro', 'PlicoController', 'ritiro');
        $this->addRoute('POST', 'plico_ritiro', 'PlicoController', 'ritiro');
        $this->addRoute('GET', 'stato_plico', 'PlicoController', 'stato');
        $this->addRoute('POST', 'stato_plico', 'PlicoController', 'stato');

        $this->addRoute('GET', 'statistiche', 'StatisticheController', 'index');
        $this->addRoute('GET', 'preferenze', 'PreferenzeController', 'index');
        $this->addRoute('POST', 'preferenze', 'PreferenzeController', 'index');
    }

    public function addRoute($method, $url, $controller, $action): void {
        $this->routes[$method][$url] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function match($url, $method): array {
        $values = [];
        if (isset($this->routes[$method]) && array_key_exists($url, $this->routes[$method])) {
            $values['controller'] = $this->routes[$method][$url]['controller'];
            $values['action'] = $this->routes[$method][$url]['action'];
        }
        return $values;
    }

    public function dispatch() {
        $page = $_GET['page'] ?? 'home';
        $method = $_SERVER['REQUEST_METHOD'];

        $route = $this->match($page, $method);

        if (empty($route)) {
            $route = $this->match('home', 'GET');
        }

        $controllerName = $route['controller'];
        $action = $route['action'];

        $controllerFile = __DIR__ . '/../App/Controller/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();
            $controller->$action();
        } else {
            die("Controller non trovato: " . $controllerName);
        }
    }
}