<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Db\Pagination;

//BUSCA
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

//FILTRO STATUS
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';

//CONDIÇÕES SQL
$condicoes = [
	strlen($busca) ? 'titulo LIKE "%'.$busca.'%"' : null,	
	strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
];

//REMOVE POSIÇÕES VAZIAS
$condicoes = array_filter($condicoes);

//CLAUSULA WHERE
$where = implode(' AND ', $condicoes);

//QUANTIDADE TOTAL DE VAGAS
$quantidadeVagas = Vaga::getQuantidadeVagas($where);

//PAGINAÇÃO
$obPagination = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);

//OBTEM AS VAGAS
$vagas = Vaga::getVagas($where,null,$obPagination->getLimit());

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';