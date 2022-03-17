<?php

namespace App\Db;

class Pagination {
	
	/**
	*Numero Maximo de Registros por pagina
	* @var integer
	*/
	private $limit;

	/**
	*Quantidade total de resultados do banco
	* @var integer
	*/
	private $results;

	/**
	*Quantidade de paginas
	* @var integer
	*/
	private $pages;

	/**
	*P�gina Atual
	* @var integer
	*/
	private $currentPage;

	/**
	*Construtor da Classe
	* @param integer
	* @param integer
	* @param integer
	*/
	public function __construct($results,$currentPage = 1,$limit = 10){
		$this->results = $results;
		$this->limit = $limit;
		$this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
		$this->calculate();
	}

	/**
	*M�todo respons�vel por calcular a p�gina��o
	*/
	private function calculate(){
		//CALCULA O TOTAL DE P�GINAS
		$this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

		//VERIFICA SE A PAGINA ATUAL N�O EXCEDE O N�MERO DE P�GINAS
		$this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
	}

	/**
	*M�todo respons�vel por retornar a clausula limit do SQL
	* @return string
	*/
	public function getLimit(){
		$offset = ($this->limit * ($this->currentPage - 1));
		return $offset.','.$this->limit; 
	}

	/**
	*M�todo respons�vel por retornar as op��es de p�ginas dispon�veis
	* @return string
	*/
	public function getPages(){
		//N�O RETORNA P�GINAS
		if ($this->pages == 1) return [];

		//P�GINAS

		$paginas = [];
		for($i = 1; $i <= $this->pages; $i++){
			$paginas[] = [
				'pagina' => $i,
				'atual' => $i == $this->currentPage
			];
		}

		return $paginas;
	}

}
