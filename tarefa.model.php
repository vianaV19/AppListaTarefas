<?php
class Tarefa {
    private $id;
    private $id_status;
    private $tarefa;
    private $status;
    private $data_cadastro;
    
    function __set($atr, $val){
        $this->$atr = $val;
        return $this;
    }
    
    function __get($atr){
        return $this->$atr;
    }
}