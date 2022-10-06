<?php

include_once('./app/router/ProdutoRotas.php');
include_once('./app/router/TipoRotas.php');
include_once('./app/router/VendaRotas.php');

$url = explode('/',$_SERVER['REQUEST_URI']);

switch ($url[1]) {
	case 'produto':
		ProdutoRotas::boot();
	break;
	case 'tipo':
		TipoRotas::boot();
	break;
	case 'venda':
		VendaRotas::boot();
	break;
	default:
		http_response_code(405);
	break;
}