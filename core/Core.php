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
      $permissions = ["HomeController", "FrequenciaController", "SenhaController", "AlunosController"];
      if (!isset($this->controller) || !in_array($this->controller, $permissions)) {
        session_destroy();
        $this->controller = "LoginController";
        $this->invokeMethod = "onCreate";
      }
    } else {
      $permissions = ["LoginController"];
      if (!isset($this->controller) || !in_array($this->controller, $permissions)) {
        $this->controller = "LoginController";
        $this->invokeMethod = "onCreate";
      }
    }
     return call_user_func(array(new $this->controller, $this->invokeMethod), $this->params);
  }
}
