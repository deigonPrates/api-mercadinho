<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
    // whitelist of safe domains
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	exit();
}

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