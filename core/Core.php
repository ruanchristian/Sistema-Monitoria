<?php

class Core {
  private $url;
  private $controller;
  private $invokeMethod = "onCreate";
  private $params = [];
  private $monitor;
  private $valError;

  public function __construct() {
    $this->monitor = $_SESSION['usr'] ?? null;
    $this->valError = $_SESSION['error_msg'] ?? null;

    if ($this->valError) {
      if ($this->valError['contador'] == 0) {
        $_SESSION['error_msg']['contador']++;
      } else {
        unset($_SESSION['error_msg']);
      }
    }
  }

  public function power($request) {
    if (isset($request['url'])) {
      $this->url = explode("/", $request['url']);

      if($this->url[0] === "monitor") {
        $this->controller = $this->url[0];
        array_shift($this->url);
        $this->invokeMethod = $this->url[0];
        return call_user_func(array(new $this->controller, $this->invokeMethod), $this->params);
      }

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
      $permission = ["HomeController", "FrequenciaController", "SenhaController"];
      if (!isset($this->controller) || !in_array($this->controller, $permission)) {
        session_destroy();
        $this->controller = "LoginController";
        $this->invokeMethod = "onCreate";
      }
    } else {
      $permission = ["LoginController"];
      if (!isset($this->controller) || !in_array($this->controller, $permission)) {
        $this->controller = "LoginController";
        $this->invokeMethod = "onCreate";
      }
    }
    return call_user_func(array(new $this->controller, $this->invokeMethod), $this->params);
  }
}
