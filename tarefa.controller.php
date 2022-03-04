<?php

require '../../app_lista_tarefas/tarefa.model.php';
require '../../app_lista_tarefas/tarefa.service.php';
require '../../app_lista_tarefas/conexao.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$tarefas = null;

if ($acao == 'inserir') {
    if (!empty($_POST['tarefa'])) {
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $service = new TarefaService($conexao, $tarefa);

        $service->inserir();
        header('Location: nova_tarefa.php?inclusao=1');
    } else {
        header('Location: nova_tarefa.php?inclusao=2');
    }
} else if ($acao == 'recuperar') {

    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $service = new TarefaService($conexao, $tarefa);

    $tarefas = $service->recuperar();

} else if($acao == 'atualizar'){
    $tarefa = new  Tarefa();
    $tarefa->__set('id', $_POST['id'])->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();
    
    $service = new TarefaService($conexao, $tarefa);
    $service->atualizar();
    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }
   
}else if($acao == 'remover') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);

    $conexao = new Conexao();

    $service = new TarefaService($conexao, $tarefa);
    $service->remover();

    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }

}else if($acao == 'marcaRealizada'){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id'])->__set('id_status', 2);
    
    $conexao = new Conexao();
    $service = new TarefaService($conexao, $tarefa);
    $service->marcaRealizada();

    header('Location: todas_tarefas.php');
    
}else if($acao == 'recuperarTarefasPendentes'){
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $service = new TarefaService($conexao, $tarefa);

    $tarefas = $service->recuperaPendentes();

    
}
