<?php
$acao = 'recuperarTarefasPendentes';
require '../../app_lista_tarefas/tarefa.controller.php';
?>

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<script>
		function marcaRealizada(id) {
			location.href = 'todas_tarefas.php?acao=marcaRealizada&id=' + id
		}

		function remover(id) {
			location.href = 'todas_tarefas.php?pag=index&acao=remover&id=' + id
		}

		function editar(id, t_desc) {

			let form = document.createElement('form');
			form.action = 'tarefa.controller.php?pag=index&acao=atualizar'
			form.method = 'post'

			let input = document.createElement('input')
			input.type = 'text'
			input.name = 'tarefa'
			input.className = 'col-9 form-control'
			input.value = t_desc

			let inputId = document.createElement('input')
			inputId.type = 'hidden'
			inputId.name = 'id'
			inputId.value = id


			let btn = document.createElement('button')
			btn.className = 'col-3 btn btn-info'
			btn.type = 'submit'
			btn.innerHTML = 'Atualizar'


			form.appendChild(input)

			form.appendChild(inputId)

			form.appendChild(btn)

			let tarefa = document.getElementById('tarefa_' + id)

			tarefa.innerHTML = ''

			tarefa.insertBefore(form, tarefa[0])


		}
	</script>
</head>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
				App Lista Tarefas
			</a>
		</div>
	</nav>

	<div class="container app">
		<div class="row">
			<div class="col-md-3 menu">
				<ul class="list-group">
					<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
					<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
					<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
				</ul>
			</div>

			<div class="col-md-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Tarefas pendentes</h4>
							<hr />
							<? foreach ($tarefas as $t) {
							?>

								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?= $t->id ?>"><?= $t->tarefa ?></div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $t->id ?>)"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $t->id ?>, '<?= $t->tarefa ?>')"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcaRealizada(<?= $t->id ?>)"></i>
									</div>
								</div>
							<? }
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>