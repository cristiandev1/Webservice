<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SERVIDOR
define('SERVER', $_SERVER['HTTP_HOST']=="localhost" OR $_SERVER['HTTP_HOST']=="192.168.1.10" ? "localhost" : "aws");
define('DEVELOPER', SERVER=="localhost");

// TK (PRIVATE)
define('KEY_GLOBAL', 'fe47ab70da8f411513f046c989ca24db');

// VERSÃO MINIMA DA APLICAÇÃO REQUERIDA
define('APP_VERSAO_MIN', 1);

