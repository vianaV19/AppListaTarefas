<?php

class TarefaService
{

    private $conexao;
    private $tarefa;

    public function  __construct(Conexao $conexao, Tarefa $tarefa)
    {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir()
    {
        $query = 'insert into tb_tarefas(tarefa) values (:tarefa)';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));

        $stmt->execute();
    }

    public function recuperar()
    {
        $query = 'select t.id, s.status, t.tarefa 
        from 
        tb_tarefas as t
        left join 
        tb_status as s on (t.id_status = s.id)';

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        $listaTarefas = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $listaTarefas;
    }
    public function recuperaPendentes()
    {
        $query = 'select t.id, s.status, t.tarefa 
        from 
        tb_tarefas as t
        left join 
        tb_status as s on (t.id_status = s.id) where id_status = 1';

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        $listaTarefas = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $listaTarefas;
    }

    public function atualizar()
    {
        $query = 'update tb_tarefas set tarefa= ?  where id= ?';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));

        $stmt->execute();
    }

    public function marcaRealizada()
    {
        $query = 'update tb_tarefas set id_status= ?  where id= ?';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id_status'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));

        $stmt->execute();
    }

    public function remover()
    {
        $query = "delete from tb_tarefas where id=?";
        
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id'));

        $stmt->execute();
    }
}
