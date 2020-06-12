<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('blog_model');
    $this->load->model('usuario_model');
    $this->load->model('admin_model');
  }

  //cadastrar blog
  public function cadastrar(){
    if(issetPost()){

      if(isset($_POST['usuario'])){

        if(
          isset($_POST['nome']) && $_POST['nome'] != "" &&
          isset($_POST['site_url']) && $_POST['site_url'] != "" &&
          isset($_POST['descricao']) && $_POST['descricao'] != "" &&
          isset($_POST['id_dono_blog']) && $_POST['id_dono_blog'] != ""
        ){

          //DADOS RECEBIDOS DA REQUEST
          $dados = array(
            "nome"=> preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['nome']),
            "site_url"=> $_POST['site_url'],
            "descricao"=> preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['descricao']),
            "id_dono_blog"=> $_POST['id_dono_blog'],
          );

          //verifica se usuario é administrador
          $verificaAdmin = $this->usuario_model->verificaAdmin();
          if($verificaAdmin){
            //cadastrar blog
            $verificaDono = $this->admin_model->verificaUsuario($_POST['id_dono_blog']);
            if($verificaDono){
              $cadastrar = $this->blog_model->cadastrar($dados);
              echoReturn();
            }else{echoError('dono_nao_encontrado','Usuário informado para dono não encontrado');}
          }else{echoError('permissao_negada','Apenas administrador pode realizar esta operação');}
        }else{echoError('campos_vazios','Campos necessários não enviados ou valores vazios');}
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //listar blogs (dono do blog)
  public function listar($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        $usuario = $this->usuario_model->dados();
        if($usuario){
          $listar = $this->blog_model->listar();
          echoReturn($listar);
        }else{echoError('usuario_inexistente','Usuário não encontrado');}
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //editar blog
  public function editar($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        if(isset($this->blogglobal->id)){
          $dados = $this->blog_model->dados();
          if($dados != "" || $dados != null){

            //DADOS RECEBIDOS DA REQUEST
            $dados = array(
              "nome"=> $_POST['dados_blog']['nome'] == "" ? $dados->nome : preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['dados_blog']['nome']),
              "site_url"=> $_POST['dados_blog']['site_url'] == "" ? $dados->site_url : $_POST['dados_blog']['site_url'],
              "descricao"=> $_POST['dados_blog']['descricao'] == "" ? $dados->descricao : $_POST['dados_blog']['descricao'],
            );

            $editar = $this->blog_model->editar($dados);
            if($editar){
              echoReturn();
            }else{echoError('erro_editar','Erro ao editar');}

          }else{echoError('blog_inexistente','Não há retorno para os dados informados');}
        }else{echoError('blog_nao_informado','Blog não informado');}
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }


}