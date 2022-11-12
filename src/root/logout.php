<?php
require_once('../power-session.php');
session_destroy();
header('Location: ../../index');