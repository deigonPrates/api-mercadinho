<?php

include_once('cors.php');
require 'vendor/autoload.php';

$url = explode('/',$_SERVER['REQUEST_URI']);

switch ($url[1]) {
	case 'produto':
        \app\router\ProdutoRotas::boot();
	break;
	case 'tipo':
        \app\router\TipoRotas::boot();
	break;
	case 'venda':
        \app\router\VendaRotas::boot();
	break;
	case 'historico':
        \app\router\HistoricoComprasRotas::boot();
	break;
	default:
		http_response_code(405);
	break;
}