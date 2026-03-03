<?php

echo "====== | Bem vindo ao BNDZTasks! | ======\n";

echo "====== | Menu | ======\n";

echo " Digite a opção desejada:\n
1 - Cadastrar tarefa\n
2 - Listar tarefas\n
3 - Buscar tarefa\n
4 - Editar tarefa\n
5 - Excluir tarefa\n
6 - Tasks Prontas\n
0 - Sair\n";

$option = readline("Opção: ");

switch ($option){
    case 1:
        require('create.php');
        break;
    case 2:
        require('read.php');
        break;
    case 3:
        require('search.php');
        break;
    case 4:
        require('update.php');
        break;
    case 5:
        require('delete.php');
        break;
    case 6:
        require('stats.php');
        break;
    case 0:
        echo "Saindo do programa...\n";
        if (file_exists('tasks.json')) {
            unlink('tasks.json');
        }
        exit();
    default:
        echo "Opção inválida. Por favor, tente novamente.\n";
        unlink('tasks.json');
}







