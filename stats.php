<?php

echo "====== | Tasks Prontas | ======\n";

$file = 'tasks.json';

if (!file_exists($file)) {
    echo "Nenhuma tarefa cadastrada ainda.\n\n";
} else {
    $content = file_get_contents($file);
    $tasks = json_decode($content, true);
}

if (empty($tasks)) {
    echo "Nenhuma tarefa cadastrada ainda.\n\n";
} else {
    $readyTasks = array_filter($tasks, function($task) {
        return $task['concluída'] === true;
    });
    
    if (empty($readyTasks)) {
        echo "Nenhuma tarefa pronta ainda.\n\n";
    } else {
        foreach ($readyTasks as $task) {
            echo "ID: " . $task['id'] . "\n";
            echo "Descrição: " . $task['descrição'] . "\n";
            echo "Prazo: " . $task['prazo'] . "\n";
            echo "Prioridade: " . $task['prioridade'] . "\n\n";
        }
        echo "\n";
    }
}

echo "====== | Próximo passo | ======\n";
echo "Digite a opção desejada:\n
1 - Voltar ao menu principal\n
0 - Sair\n";
$option = readline("Opção: ");
switch ($option) {
    case 1:
        require('index.php');
        break;
    case 0:
        echo "Saindo do programa...\n";
        unlink($file);
        exit();
    default:
        echo "Opção inválida. Por favor, tente novamente.\n";
        unlink($file);
}