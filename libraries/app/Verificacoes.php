<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Verificacoes{

  public $ok;
  private $dds_post;


  public function __construct(){
    $this->header();      // Verifica se Header possui os campos necessários
    $this->json();        // Verifica se Json existe e é válido
    $this->tk_json();     // Verifica TK do json
    $this->vs_app();      // Verifica Versão
    $this->ok = true;
  }


  // VERIFICA -> HEADER
  private function header(){
    $values = array('tk','vs_app');
    $headers = getallheaders();
    foreach((array)$values as $l){
      if(!isset($headers[$l]) or isset($headers[$l]) && $headers[$l]==""){
        echoError('header_invalido', 'Dados Inexistentes');
      }
    }
  }


  // VERIFICA -> JSON
  private function json(){
    try{
      $json = json_decode(file_get_contents("php://input"), true);
      $this->dds_post = $_POST = $json;
    }catch(Exception $e){
      echoError('json_inexistente', 'Dados Inexistentes');
    }
  }


  // VERIFICA -> TK JSON
  private function tk_json(){
    $ddsmd5 = md5(json_encode($this->dds_post));
    //pega o body da requisição e transforma em um rash md5 e concatena com  uma key global
    //a aplicação que quiser me enviar vai ter que fazer um processo mais ou menos igual esse descrito abaixo
    /*
     processo de conversao dos dados em json
	var encodeDados = json.encode(dados);
	var md5Dados = md5.convert(utf8.encode(encodeDados));
	md5Final = md5.convert(utf8.encode("$md5Dados${global.KEY_GLOBAL}"));

    Map<String, String> header = {
	  'content-type' : 'application/json',
	  'accept': 'application/json',
	  'tk': '$md5Final',
	  'vs_app': '$vs_app'
	};
     * */
    if(md5($ddsmd5.KEY_GLOBAL) === getallheaders()['tk'] OR DEVELOPER){
      $this->tk = true;
    }else{
      echoError('tk_invalido', 'Comunicação não Autenticada');
    }
  }


  // VERIFICA VS_APP
  private function vs_app(){
    if(getallheaders()['vs_app']>=APP_VERSAO_MIN OR DEVELOPER){
      $this->vs_app = true;
    }else{
      echoError('versao_min', 'Versão da aplicação está desatualizada');
    }
  }
}