<?php
  session_start();
  date_default_timezone_set('America/Fortaleza');
  require_once("core/Core.php");
  require_once("assets/database/Connection.php");
  require_once("controller/LoginController.php");
  require_once("controller/AdminController.php");
  require_once("controller/HomeController.php");
  require_once("controller/FrequenciaController.php");
  require_once("controller/SenhaController.php");
  require_once("controller/CadastroController.php");
  require_once("controller/OcorrenciaController.php");
  require_once("controller/ErrorController.php");
  require_once("model/Manager.php");
  require_once("model/Admin.php");
  require_once("vendor/autoload.php");

  $coreRef = new Core();
  echo $coreRef->power($_GET);