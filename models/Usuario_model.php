<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{
  public function __construct(){
    parent:: __construct();
  }


  //verificar se email já existe na base
  public function verificaUsuario($dados){
    $sql = 'SELECT * FROM usuario WHERE email = ?';
    $sql_values = array(
      $dados['email'],
    );
    $rs = $this->blog->query($sql, $sql_values);
    return issetRegistro($rs);
  }

  //dados do usuario
  public function dados(){
    $sql = 'SELECT nome, sobrenome, cidade, email, status FROM usuario WHERE id_usuario = ? ';
    $sql_values = array(
      $this->usuarioglobal->id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }

  //verifica se é usuario admin
  public function verificaAdmin(){
    $sql = 'SELECT id_usuario, funcao, status FROM usuario WHERE id_usuario = ? AND funcao = 1 AND status = 0';
    $sql_values = array(
      $this->usuarioglobal->id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }

  //cadastrar usuario
  public function cadastrar($dados){
    $sql = 'INSERT INTO usuario (nome,sobrenome,cidade,email,senha) VALUES(?,?,?,?,?)';
    $sql_values = array(
      $dados['nome'],
      $dados['sobrenome'],
      $dados['cidade'],
      $dados['email'],
      md5($dados['senha']),
    );
    $this->blog->query($sql, $sql_values);
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //alterar dados
  public function alterar($dados){
    $this->blog->set('nome',$dados['nome']);
    $this->blog->set('sobrenome',$dados['sobrenome']);
    $this->blog->set('cidade',$dados['cidade']);
    $this->blog->where('id_usuario',$this->usuarioglobal->id);
    $this->blog->update('usuario');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //inativar usuario
  public function excluir(){
    $this->blog->set('status',1);
    $this->blog->where('id_usuario',$this->usuarioglobal->id);
    $this->blog->update('usuario');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //alterar email
  public function alterarEmail($dados){
    $this->blog->set('email',$dados['email']);
    $this->blog->where('id_usuario',$this->usuarioglobal->id);
    $this->blog->update('usuario');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //verifica se a senha digitada pelo usuário é igual a gravada no banco na hora de redefinir.
  public function verificarSenha(){
    $sql = 'SELECT * FROM usuario WHERE senha = ? AND id_usuario = ?';
    $sql_values = array(
      $this->input->post('usuario')['senha'],
      $this->usuarioglobal->id,
    );
    $rs = $this->blog->query($sql, $sql_values);
    return issetRegistro($rs);
  }

  //alterar senha
  public function alterarSenha(){
    $this->blog->set('senha', md5($this->input->post('usuario')['nova_senha']));
    $this->blog->where('id_usuario', $this->usuarioglobal->id);
    $this->blog->update('usuario');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }
}
