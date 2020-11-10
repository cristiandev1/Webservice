<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('admin_model');
    $this->load->model('usuario_model');
    $this->load->model('post_model');
    $this->load->model('blog_model');
    $this->load->model('categoria_model');
  }


  //cadastrar postagem
  public function cadastrar(){
    if(issetPost()){
      if(isset($_POST['usuario'])){

        $dadosBlog = $this->admin_model->dadosBlog();
        if($dadosBlog){
          $verificaAdmin = $this->usuario_model->verificaAdmin();
          if($verificaAdmin || $dadosBlog->dono_blog == $this->usuarioglobal->id){
            $verificaCategoria = $this->categoria_model->verificaCategoria();
            if($verificaCategoria){
              if(isset($_POST['titulo']) && $_POST['titulo'] != "" && isset($_POST['assunto']) && $_POST['assunto'] != ""){

                $dados = array(
                  "titulo"=> preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['titulo']),
                  "assunto"=> preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['assunto']),
                );

                $cadastrar = $this->post_model->cadastrar($dados);
                if($cadastrar){
                  echoReturn();
                }else{echoError('erro_cadastrar','Erro ao cadastrar');}
              }else{echoError('dados_insuficientes','Titulo ou assunto inexistente');}
            }else{echoError('categoria_inexistente','Categoria inexistente');}
          }else{echoError('acesso_negado','Acesso negado');}
        }else{echoError('blog_inexistente','Blog inexistente');}
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //listar postagens
  public function listar($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        $dadosBlog = $this->admin_model->dadosBlog();
        if($dadosBlog){
          $verificaAdmin = $this->usuario_model->verificaAdmin();
          if($verificaAdmin || $dadosBlog->dono_blog == $this->usuarioglobal->id){
            $listar = $this->post_model->listar();
            echoReturn($listar);
          }else{echoError('acesso_negado','Acesso negado');}
        }else{echoError('blog_inexistente','Blog inexistente');}
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  public function getPosts($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        $post = $this->post_model->getPosts();
        echoReturn($post);
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }
}