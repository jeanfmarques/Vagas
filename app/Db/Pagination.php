<?php

namespace App\Db;

class Pagination
{

	/**
	 *Numero Máximo de Registros por pagina
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
	 *Página Atual
	 * @var integer
	 */
	private $currentPage;

	/**
	 *Construtor da Classe
	 * @param integer
	 * @param integer
	 * @param integer
	 */
	public function __construct($results, $currentPage = 1, $limit = 10)
	{
		$this->results = $results;
		$this->limit = $limit;
		$this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
		$this->calculate();
	}

	/**
	 *Método responsável por calcular a páginação
	 */
	private function calculate()
	{
		//CALCULA O TOTAL DE PÁGINAS
		$this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

		//VERIFICA SE A PAGINA ATUAL NÃO EXCEDE O NÚMERO DE PÁGINAS
		$this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
	}

	/**
	 *Método responsável por retornar a clausula limit do SQL
	 * @return string
	 */
	public function getLimit()
	{
		$offset = ($this->limit * ($this->currentPage - 1));
		return $offset . ',' . $this->limit;
	}

	/**
	 *Método responsável por retornar as opções de páginas disponíveis
	 * @return string
	 */
	public function getPages()
	{
		//NÃO RETORNA PÁGINAS
		if ($this->pages == 1) return [];

		//PÁGINAS

		$paginas = [];
		for ($i = 1; $i <= $this->pages; $i++) {
			$paginas[] = [
				'pagina' => $i,
				'atual' => $i == $this->currentPage
			];
		}

		return $paginas;
	}
}
