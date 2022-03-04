<?php

class Conexao{
    private $host = 'localhost';
    private $db = 'bd_lista_tarefas';
    private $user = 'root';
    private $pass = '';
    

    public function conectar(){
        try{
            $conexao = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->pass);

            return $conexao;

        }catch(PDOException $p){
            echo 'Erro' . $p->getCode(); 
            echo '<br>';
            echo 'Mensagem: ' . $p->getMessage();
        }
    }
    
}