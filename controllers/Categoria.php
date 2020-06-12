<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('categoria_model');
    $this->load->model('usuario_model');
  }

  //cadastrar categoria
  public function cadastrar($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        //verifica se campo é vazio
        if($this->input->post('nome') != ""){
          //verifica se usuario é administrador
          //caso usuario nao seja administrador exibe um erro
          $verificaAdmin = $this->usuario_model->verificaAdmin();
          if($verificaAdmin != "" || $verificaAdmin != null){

            $descricao = preg_replace("/[^a-zA-z0-9]/", "", $this->input->post('nome'));
            $cadastrar = $this->categoria_model->cadastrar($descricao);
            if($cadastrar){
              echoReturn();
            }else{echoError('erro_cadastrar','Erro ao cadastrar');}
          }else{echoError('permissao_negada','Apenas administrador pode realizar esta operação');}
        }else{echoError('campo_vazio','Campo nome não pode ser vazio');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //listar categorias
  public function listar($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){

        //verifica se usuario é administrador
        $verificaAdmin = $this->usuario_model->verificaAdmin();
        if($verificaAdmin != "" || $verificaAdmin != null){
          $listar = $this->categoria_model->listar();
          if($url){
            echoReturn($listar);
          }else{return $listar;}
        }else{echoError('permissao_negada','Apenas administrador pode realizar esta operação');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //editar categoria
  public function alterar($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        //verifica se campo é vazio
        if(isset($_POST['dados_categoria'])){
          //verifica se usuario é administrador
          $verificaAdmin = $this->usuario_model->verificaAdmin();
          if($verificaAdmin != "" || $verificaAdmin != null){

            $verificaCategoria = $this->categoria_model->verificaCategoria();
            if($verificaCategoria){
              $descricao = preg_replace("/[^a-zA-z0-9]/", "", $this->input->post('dados_categoria')['descricao']);
              $alterar = $this->categoria_model->alterar($descricao);
              echoReturn();
            }else{echoError('categoria_inexistente','Categoria não existente');}

          }else{echoError('permissao_negada','Apenas administrador pode realizar esta operação');}
        }else{echoError('campo_vazio','Dados da categoria nao especificados');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }


  //excluir categoria
  public function excluir($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        //verifica se campo é vazio
        if(isset($_POST['dados_categoria'])){
          //verifica se usuario é administrador
          $verificaAdmin = $this->usuario_model->verificaAdmin();
          if($verificaAdmin != "" || $verificaAdmin != null){

            $verificaCategoria = $this->categoria_model->verificaCategoria();
            if($verificaCategoria){
              $excluir = $this->categoria_model->excluir();
              echoReturn();
            }else{echoError('categoria_inexistente','Categoria inexistente');}

          }else{echoError('permissao_negada','Apenas administrador pode realizar esta operação');}
        }else{echoError('campo_vazio','Dados da categoria nao especificados');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }
}