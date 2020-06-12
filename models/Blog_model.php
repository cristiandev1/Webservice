<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model{
  public function __construct(){
    parent:: __construct();
  }

  //cadastrar usuario
  public function cadastrar($dados){
    $sql = 'INSERT INTO blog (nome,site_url,descricao,dono_blog) VALUES(?,?,?,?)';
    $sql_values = array(
      $dados['nome'],
      $dados['site_url'],
      $dados['descricao'],
      $dados['id_dono_blog'],
    );
    $this->blog->query($sql, $sql_values);
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //listar blogs
  public function listar(){
    $sql = 'SELECT * FROM blog WHERE dono_blog = ?';
    $sql_values = array(
      $this->usuarioglobal->id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }


  //dados do blog
  public function dados(){
    $sql = "
    SELECT 
      nome,
      site_url, 
      descricao 
    FROM blog WHERE id_blog = ? AND dono_blog = ?";
    $sql_values = array(
      $this->blogglobal->id,
      $this->usuarioglobal->id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }

  //editar
  public function editar($dados){
    $this->blog->set('nome',$dados['nome']);
    $this->blog->set('site_url',$dados['site_url']);
    $this->blog->set('descricao',$dados['descricao']);
    $this->blog->where('id_blog',$this->blogglobal->id);
    $this->blog->where('dono_blog',$this->usuarioglobal->id);
    $this->blog->update('blog');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }
}