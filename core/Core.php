<?php

class Core {
  private $url;
  private $controller;
  private $invokeMethod = "onCreate";
  private $params = [];
  private $monitor;

  public function __construct() {
    $this->monitor = $_SESSION['access'] ?? NULL;
  }

  public function power($request) {
    if (isset($request['url'])) {
      $this->url = explode("/", $request['url']);

      $this->controller = ucfirst($this->url[0]) . "Controller";
      array_shift($this->url);

      if (isset($this->url[0]) && !empty($this->url)) {
        $this->invokeMethod = $this->url[0];
        array_shift($this->url);

        if (isset($this->url[0]) && !empty($this->url)) {
          $this->params = $this->url;
        }
      }
    }

    if ($this->monitor) {
      $permissions = ["HomeController", "AdminController", "FrequenciaController", "SenhaController", "AlunosController", "CadastroController", "OcorrenciaController", "LoginController", "ErrorController"];
      if (!isset($this->controller) || !in_array($this->controller, $permissions)) {
        session_destroy();
        var_dump($this->controller);
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Essa página não existe no nosso servidor.";
      } else if (!is_callable(array(new $this->controller, $this->invokeMethod))) {
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Essa URL não existe no nosso servidor.";
      }
    } else {
      $permissions = ["LoginController", "AdminController", "ErrorController"];
      if (!isset($this->controller)) {
        $this->controller = "LoginController";
        $this->invokeMethod = "onCreate";
      } else if (!in_array($this->controller, $permissions)) {
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Você não tem permissão para acessar essa página.";
      } else if (!is_callable(array(new $this->controller, $this->invokeMethod))) {
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Essa URL não existe no nosso servidor...";
      }
    }
      return call_user_func(array(new $this->controller, $this->invokeMethod), $this->params);
    }
}
