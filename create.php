<?php

echo "====== | Cadastrar Tarefa | ======\n";

$description = readline("Descrição da tarefa: ");
$prazo = readline("Prazo: ");
$priority = readline("Prioridade (1-5): ");
$ready = readline("Tarefa pronta? (s/n): ");

$task = [
    'id' => rand(1, 100),
    'descrição' => $description,
    'prazo' => $prazo,
    'prioridade' => $priority,
    'concluída' => ($ready === 's') ? true : false
];

$file = 'tasks.json';
$tasks = [];
if (file_exists($file)) {
    $content = file_get_contents($file);
    $tasks = json_decode($content, true) ?? [];
}

$tasks[] = $task;
    
file_put_contents($file, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Tarefa cadastrada com sucesso!\n";

echo "====== | Próximo passo | ======\n";

echo "Digite a opção desejada:\n
1 - Voltar ao menu principal\n
0 - Sair\n";
$option = readline("Opção: ");

switch ($option){
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

