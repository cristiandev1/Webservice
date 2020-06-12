<?php
$config = array(
	// Validação de Login
	'app/comprar' => array(
		array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
		array('field' => 'purchase_id', 'label' => 'PurchaseId', 'rules' => 'trim|required'),
    array('field' => 'os', 'label' => 'Os', 'rules' => 'trim|required')
	),
  'usuario/cadastrar'=> array(
    array('field' => 'nome', 'label' => 'Nome', 'rules' => 'trim|required'),
    array('field' => 'sobrenome', 'label' => 'Sobrenome', 'rules' => 'trim|required'),
    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
  ),
	'localizacao/estados'=> array(
    array('field' => 'id_pais', 'label' => 'Pais', 'rules' => 'trim|required'),
	),
  'localizacao/cidades'=> array(
    array('field' => 'id_estado', 'label' => 'Estado', 'rules' => 'trim|required'),
  ),
);

