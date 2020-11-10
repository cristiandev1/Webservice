<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model{
  public function __construct(){
    parent:: __construct();
  }

  //verifica se categoria existe
  public function verificaCategoria(){
    $sql = 'SELECT * FROM categoria_post WHERE id_categoria = ? AND status = 0';
    $sql_values = array(
      $this->categoriaglobal->id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }

  //cadastrar categoria
  public function cadastrar($categoria){
    $sql = 'INSERT INTO categoria_post (nome) VALUES (?)';
    $sql_values = array(
      $categoria,
    );
    $this->blog->query($sql, $sql_values);
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //listar categorias
  public function listar(){
    $sql = 'SELECT * FROM categoria_post WHERE status = 0 ORDER BY id_categoria DESC';
    $rs = $this->blog->query($sql);
    return issetRegistros($rs);
  }
  //alterar categoria
  public function alterar($descricao){
    $this->blog->set('nome',$descricao);
    $this->blog->where('id_categoria',$this->categoriaglobal->id);
    $this->blog->update('categoria_post');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //alterar categoria
  public function excluir(){
    $this->blog->set('status',1);
    $this->blog->where('id_categoria',$this->categoriaglobal->id);
    $this->blog->update('categoria_post');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }
}