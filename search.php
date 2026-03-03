<?php

echo "====== | Buscar Tarefa | ======\n";

$searchTerm = readline("Digite a descrição ou ID da tarefa que deseja buscar: ");

$file = 'tasks.json';

if (!file_exists($file)) {
    echo "Nenhuma tarefa cadastrada ainda.\n\n";
} else {
    $content = file_get_contents($file);
    $tasks = json_decode($content, true);
    
    $foundTasks = array_filter($tasks, function($task) use ($searchTerm) {
        return strpos(strtolower($task['descrição']), strtolower($searchTerm)) !== false || 
               (is_numeric($searchTerm) && $task['id'] == $searchTerm);
    });
    
    if (empty($foundTasks)) {
        echo "Nenhuma tarefa encontrada com a descrição ou ID fornecida.\n\n";
    } else {
        foreach ($foundTasks as $task) {
            echo "ID: " . $task['id'] . "\n";
            echo "Descrição: " . $task['descrição'] . "\n";
            echo "Prazo: " . $task['prazo'] . "\n";
            echo "Prioridade: " . $task['prioridade'] . "\n";
            echo "Concluída: " . ($task['concluída'] ? 'Sim' : 'Não') . "\n\n";
        }
        echo "\n";
    }
}

echo "====== | Próximo passo | ======\n";
echo "Digite a opção desejada:\n";
echo "1 - Voltar ao menu principal\n";
echo "0 - Sair\n";

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