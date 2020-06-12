<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Conexaobd {
  public function __construct(){
    $this->CI =& get_instance();
    $this->hostname = "localhost";
    $this->username = "root";
    $this->password = "";
    $this->conexaoDB();
  }

  public function conexaoDB(){
    // Conectando ao bd
    $config['hostname'] = $this->hostname;
    $config['username'] = $this->username;
    $config['password'] = $this->password;
    $config['database'] = "teste";
    $config['dbdriver'] = 'mysqli';
    $config['dbprefix'] = '';
    $config['pconnect'] = FALSE;
    $config['db_debug'] = TRUE;
    $config['cache_on'] = FALSE;
    $config['cachedir'] = '';
    $config['char_set'] = 'utf8';
    $config['dbcollat'] = 'utf8_general_ci';
    $this->CI->blog = $this->CI->load->database($config, TRUE);
  }



}