<?php
class SenhaController {
  private $valError;
  private $isReset;

  public function __construct() {
    $this->valError = $_SESSION['error_msg'] ?? null;
    $this->isReset = $_SESSION['success'] ?? null;

    if($this->isReset && $this->isReset['contador'] == 1) unset($_SESSION['success']);    
    if ($this->valError && $this->valError['contador'] == 1) unset($_SESSION['error_msg']);
  }

  public function onCreate() {
    $loader = new \Twig\Loader\FilesystemLoader('view');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('changes.html', [
      'cache' => '/path/to/compilation_cache',
      'auto_reload' => true
    ]);

    return $template->render([
      'admin' => $_SESSION['access']['accept'] ?? NULL,
      'nome' => $_SESSION['access']['username'] ?? "Unknown Source",
      'error' => $this->valError,
      'isReseted' => $this->isReset
    ]);
  }

  public function reset() {
    try {
      $managerReference = new Manager();
      $password1 = trim($_POST['newPass1']);
      $password2 = trim($_POST['newPass2']);
      $senhaAtual = md5(trim($_POST['atualPass']));

      $managerReference->changePassword($password1, $password2, $senhaAtual);

      $_SESSION['success'] = ['msg' => "Senha alterada com sucesso", 'contador' => 1];
      header('Location: /Sistema Monitoria/senha');
    } catch (\Exception $e) {
      $_SESSION['error_msg'] = ['msg' => $e->getMessage(), 'contador' => 1];
      header("Location: /Sistema Monitoria/senha");
    }
  }
}
