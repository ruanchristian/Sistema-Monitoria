<?php

class Core {
  private $url;
  private $controller = "LoginController";
  private $invokeMethod = "onCreate";
  private $params = [];
  private $monitor;
  private $admin;
  private $permissions_sup = ["HomeController", "AdminController", "SenhaController", "AlunosController", "CadastroController", "OcorrenciaController", "LoginController", "ErrorController"];

  public function __construct() {
    $this->monitor = $_SESSION['access'] ?? NULL;
    $this->admin = $_SESSION['access_admin'] ?? NULL;
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
      if (!in_array($this->controller, $this->permissions_sup)) {
        session_destroy();
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Você não possui permissão para acessar essa página.";
      } else if (!is_callable(array(new $this->controller, $this->invokeMethod))) {
        session_destroy();
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Essa URL não existe no nosso servidor.";
      }
    } else if ($this->admin) {
      array_push($this->permissions_sup, "FrequenciaController");
      if (!in_array($this->controller, $this->permissions_sup) || !is_callable(array(new $this->controller, $this->invokeMethod))) {
        session_destroy();
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Essa URL não existe no nosso servidor...";
      }
    } else {
      $permissions = ["LoginController", "AdminController", "ErrorController"];
      if (!in_array($this->controller, $permissions)) {
        
        $this->controller = "ErrorController";
        $this->invokeMethod = "onCreate";
        $this->params = "Acesso inválido. Faça o login!!";
      }
    }
      return call_user_func(array(new $this->controller, $this->invokeMethod), $this->params);
    }
}
