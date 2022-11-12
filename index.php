<?php
  session_start();
  require_once("core/Core.php");
  require_once("assets/database/Connection.php");
  require_once("controller/LoginController.php");
  require_once("controller/HomeController.php");
  require_once("controller/FrequenciaController.php");
  require_once("model/Monitor.php");
  require_once("vendor/autoload.php");

  $coreRef = new Core();
  echo $coreRef->power($_GET);