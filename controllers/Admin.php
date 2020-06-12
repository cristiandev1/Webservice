<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('admin_model');
    $this->load->model('usuario_model');
  }

  /*
   * ACOES DO ADMIN
   * */

  //listar usuarios
  public function listarUsuarios($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        //verifica se usuario é administrador
        $verificaAdmin = $this->usuario_model->verificaAdmin();
        if($verificaAdmin){
          $usuarios = $this->admin_model->listarUsuarios();

          if($url){echoReturn($usuarios);}else{return $usuarios;}

        }else{echoError('permissao_negada','Apenas administrador pode realizar esta operaçãoo');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //inativar usuario
  public function inativarUsuario(){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        //verifica se usuario é administrador
        $verificaAdmin = $this->usuario_model->verificaAdmin();
        if($verificaAdmin){
          //usuario a inativar
          $id = preg_replace("/[^0-9]/", "", $_POST['id_inativar']);
          $dados = $this->admin_model->dados($id);
          if($dados){
            if($dados->status == 0){
              $inativar = $this->admin_model->inativarUsuario($id);
              if($inativar){
                echoReturn();
              }else{echoReturn('erro_inativar','Erro ao inativar usuário');}
            }else{echoError('usuario_inativo','Usuário ja é inativo');}
          }else{echoError('usuario_inexistente','Usuário inexistente');}
        }else{echoError('permissao_negada','Apenas administrador pode realizar esta operação');}
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }


}