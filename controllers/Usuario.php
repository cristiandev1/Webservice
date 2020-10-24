<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('usuario_model');
    $this->load->model('categoria_model');
  }

  public function splash($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        $usuario = $this->usuario_model->dados();
        $posts = $this->usuario_model->posts();
        $categorias = $this->categoria_model->listar();


        if($usuario != null){
          $dados = array(
            "id_usuario"=>$usuario->id_usuario,
            "nome"=>$usuario->nome,
            "sobrenome"=>$usuario->sobrenome,
            "cidade"=>$usuario->cidade,
            "cidade"=>$usuario->cidade,
            "email"=>$usuario->email,
            "status"=>$usuario->status,
            "funcao"=>$usuario->funcao,
            "categorias" => $categorias,
            "postagens" => $posts == null ? [] : $posts,
          );
          echoReturn($dados);
        }else{
          return null;
        }


      }
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //DADOS DO USUARIO
  public function dados($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        $dados = $this->usuario_model->dados();

        //SE TIVER SENDO CHAMADA DIRETO PELA URL
        if($url){
          echoReturn($dados);
        }else{return $dados;}

      }else{echoError('usuario_nao_informado','Usuário não informado');}

    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //função para o login
  public function login($url = true){
    if(issetPost()){
      if(isset($_POST['email']) || isset($_POST['senha'])){

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $dados = array(
          "email" => $email,
          "senha" => $senha,
        );

        $issetUser = $this->usuario_model->verificaUsuario($dados);
        if($issetUser){
          $login = $this->usuario_model->login($email, $senha);

          if($login){
            echoReturn($login);
          }else{echoError('senha_invalida','Senha informada incorreta');}

        }else{echoError('email_inexistente','Email informado não existe.');}

      }else{echoError('dados_nao_encontrados','Por favor preencha os campos para realizar esta ação.');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //CADASTRAR USUARIO
  public function cadastrar($url = true){
    if(issetPost()){
      //VERIFICA SE EXISTE NÓ "USUARIO" SENDO ENVIADO PARA API
      if(isset($_POST['usuario'])){

        //VERIFICA SE CAMPOS ESTÃO VAZIOS
        if(
          isset($_POST['usuario']['nome']) && $_POST['usuario']['nome'] != "" &&
          isset($_POST['usuario']['sobrenome']) && $_POST['usuario']['sobrenome'] != "" &&
          isset($_POST['usuario']['cidade']) && $_POST['usuario']['cidade'] != "" &&
          isset($_POST['usuario']['email']) && $_POST['usuario']['email'] != "" &&
          isset($_POST['usuario']['senha']) && $_POST['usuario']['senha'] != ""
        ){

          //DADOS RECEBIDOS DA REQUEST
          $dados = array(
            "nome"=> preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['usuario']['nome']),
            "sobrenome"=> preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['usuario']['sobrenome']),
            "cidade"=> preg_replace("/[^a-zA-z0-9 ]/", "", $_POST['usuario']['cidade']),
            "email"=> $_POST['usuario']['email'],
            "senha"=> $_POST['usuario']['senha'],
          );

          //VERIFICA SE EMAIL JA EXISTE
          $verifica_usuario = $this->usuario_model->verificaUsuario($dados);
          if(!$verifica_usuario){
            //cadastrar usuario
            $cadastrar = $this->usuario_model->cadastrar($dados);

            if($cadastrar){
              echoReturn();
            }else{echoError('erro_cadastrar','Ocorreu erro ao cadastrar usuário');}

          }else{echoError('usuario_existente','Email já cadastrado na base de dados');}

        }else{echoError('campos_vazios','Campos necessários não enviados ou valores vazios');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //ALTERAR DADOS BASICOS
  public function alterar($url = true){
      if(isset($_POST['usuario'])){

        //verifica se campos estão vazios
        if(
          isset($_POST['usuario']['nome']) &&
          isset($_POST['usuario']['sobrenome']) &&
          isset($_POST['usuario']['cidade'])
        ){
          //DADOS DO USUARIO CADASTRADO NA BASE DE DADOS
          $dados_usuario = $this->usuario_model->dados();

          if($dados_usuario){

            $dados = array(
              "nome"=> $_POST['usuario']['nome'] != "" ? $_POST['usuario']['nome'] : $dados_usuario->nome,
              "sobrenome"=> $_POST['usuario']['sobrenome'] != "" ? $_POST['usuario']['sobrenome'] : $dados_usuario->sobrenome,
              "cidade"=> $_POST['usuario']['cidade'] != "" ? $_POST['usuario']['cidade'] : $dados_usuario->cidade,
            );

            $alterar = $this->usuario_model->alterar($dados);
            if($alterar){
              echoReturn();
            }else{echoError('erro_alterar','Erro ao alterar usuário');}

          }else{echoError('usuario_nao_encontrado','Usuário inexistente');}

        }else{echoError('campos_vazios','Campos necessários não enviados ou valores vazios');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
  }

  //INATIVAR USUARIO
  public function excluir($url = true){
    if(issetPost()){
      if(isset($_POST['usuario'])){
        //DADOS DO USUARIO CADASTRADO NA BASE DE DADOS
        $dados_usuario = $this->usuario_model->dados();

        if($dados_usuario){
          if($dados_usuario->status == 0){

            $excluir = $this->usuario_model->excluir();
            if($excluir){
              echoReturn();
            }else{echoError('erro_excluir','Erro ao excluir');}

          }else{echoError('usuario_inativo','Usuário inativo');}
        }else{echoError('usuario_nao_encontrado','Usuário inexistente');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }

  //ALTERAR EMAIL
  public function alterarEmail($url = true){
    if(issetPost()){
      //VERIFICA SE EXISTE NÓ USUARIO SENDO ENVIADO NA REQUEST
      if(isset($_POST['usuario'])){
        //DADOS DO USUARIO CADASTRADO NA BASE DE DADOS
        $dados_usuario = $this->usuario_model->dados();
        //verifica se existe usuario com id informado
        if($dados_usuario){

          $email = array(
            "email"=> $_POST['usuario']['email'] != "" ? $_POST['usuario']['email'] : $dados_usuario->email,
          );

          //verifica se email digitado é igual já cadastrado na base
          if($email['email'] != $dados_usuario->email){

            //VERIFICA SE EMAIL JA EXISTE NA BASE
            $verifica_usuario = $this->usuario_model->verificaUsuario($email);
            if(!$verifica_usuario){
              $alterar = $this->usuario_model->alterarEmail($email);
              echoReturn();
            }else{echoError('email_existente','Email existente tente outro');}

          }else{echoError('email_igual','Novo email deve ser diferente do email cadastrado');}

        }else{echoError('usuario_nao_encontrado','Usuário inexistente');}

      }else{echoError('usuario_nao_informado','Usuário não informado');}

    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }


  //alterar senha
  public function alterarSenha($url = true){
    if(issetPost()){
      //verifica se usuario foi informado
      if(isset($_POST['usuario'])){
        //DADOS DO USUARIO CADASTRADO NA BASE DE DADOS
        $dados_usuario = $this->usuario_model->dados();

        if($dados_usuario){
          $jogador = $this->usuario_model->verificarSenha();
          if($jogador){
            if($this->input->post('usuario')['nova_senha'] == $this->input->post('usuario')['repetir_nova_senha']){
              $this->usuario_model->alterarSenha();
              echoReturn();
            }else{echoError('senha_distinta', 'Campos de nova senha estão distintos');}
          }else{echoError('senha_original_distinta', 'Senha digitada nao confere com a original');}
        }else{echoError('usuario_inexistente','Usuário inexistente');}
      }else{echoError('usuario_nao_informado','Usuário não informado');}
    }else{echoError('dados_vazios','Não foram encontrados dados');}
  }
}