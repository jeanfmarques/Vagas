<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{

  /**
   * Identificador �nico da vaga
   * @var integer
   */
  public $id;

  /**
   * T�tulo da vaga
   * @var string
   */
  public $titulo;

  /**
   * Descri��o da vaga (pode conter html)
   * @var string
   */
  public $descricao;

  /**
   * Define se a vaga ativa
   * @var string(s/n)
   */
  public $ativo;

  /**
   * Data de publica��o da vaga
   * @var string
   */
  public $data;

  /**
   * M�todo respons�vel por cadastrar uma nova vaga no banco
   * @return boolean
   */
  public function cadastrar(){
    //DEFINIR A DATA
    $this->data = date('Y-m-d H:i:s');

    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('vagas');
    $this->id = $obDatabase->insert([
                                      'titulo'    => $this->titulo,
                                      'descricao' => $this->descricao,
                                      'ativo'     => $this->ativo,
                                      'data'      => $this->data
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * M�todo respons�vel por atualizar a vaga no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('vagas'))->update('id = '.$this->id,[
                                                                'titulo'    => $this->titulo,
                                                                'descricao' => $this->descricao,
                                                                'ativo'     => $this->ativo,
                                                                'data'      => $this->data
                                                              ]);
  }

  /**
   * M�todo respons�vel por excluir a vaga do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('vagas'))->delete('id = '.$this->id);
  }

  /**
   * M�todo respons�vel por obter as vagas do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getVagas($where = null, $order = null, $limit = null){
    return (new Database('vagas'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * M�todo respons�vel por buscar uma vaga com base em seu ID
   * @param  integer $id
   * @return Vaga
   */
  public static function getVaga($id){
    return (new Database('vagas'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

}