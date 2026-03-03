<?php

echo "====== | Excluir Tarefa | ======\n";

$file = 'tasks.json';

if (!file_exists($file)) {
    echo "Nenhuma tarefa cadastrada ainda.\n\n";
} else {
    $content = file_get_contents($file);
    $tasks = json_decode($content, true);
    
    if (empty($tasks)) {
        echo "Nenhuma tarefa cadastrada ainda.\n\n";
    } else {  
        $idToDelete = readline("Digite o ID da tarefa que deseja excluir: ");
        $tasks = array_filter($tasks, function($task) use ($idToDelete) {
            return $task['id'] != $idToDelete;
        });
        
        file_put_contents($file, json_encode(array_values($tasks), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        echo "Tarefa excluída com sucesso!\n\n";
        
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