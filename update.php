<?php

echo "====== | Editar Tarefa | ======\n";

$file = 'tasks.json';

if (!file_exists($file)) {
    echo "Nenhuma tarefa cadastrada ainda.\n\n";
} else {
    $content = file_get_contents($file);
    $tasks = json_decode($content, true);
    
    if (empty($tasks)) {
        echo "Nenhuma tarefa cadastrada ainda.\n\n";
    }else{
        $idToEdit = readline("Digite o ID ou descrição da tarefa que deseja editar: ");
        $taskIndex = array_search($idToEdit, array_column($tasks, 'id'));
        if ($taskIndex === false) {
            $taskIndex = array_search($idToEdit, array_column($tasks, 'descrição'));
        }
        if ($taskIndex === false) {
            echo "Tarefa não encontrada.\n\n";
        } else {
            $task = $tasks[$taskIndex];
            echo "Tarefa encontrada:\n";
            echo "ID: " . $task['id'] . "\n";
            echo "Descrição: " . $task['descrição'] . "\n";
            echo "Prazo: " . $task['prazo'] . "\n";
            echo "Prioridade: " . $task['prioridade'] . "\n";
            echo "Concluída: " . ($task['concluída'] ? 'Sim' : 'Não') . "\n\n";

            $newDescription = readline("Digite a nova descrição (deixe em branco para manter a atual): ");
            $newDeadline = readline("Digite o novo prazo (deixe em branco para manter o atual): ");
            $newPriority = readline("Digite a nova prioridade (1-5, deixe em branco para manter a atual): ");
            $newCompleted = readline("A tarefa está concluída? (s/n, deixe em branco para manter o atual): ");

            if (!empty($newDescription)) {
                $tasks[$taskIndex]['descrição'] = $newDescription;
            }
            if (!empty($newDeadline)) {
                $tasks[$taskIndex]['prazo'] = $newDeadline;
            }
            if (!empty($newPriority) && is_numeric($newPriority) && $newPriority >= 1 && $newPriority <= 5) {
                $tasks[$taskIndex]['prioridade'] = (int)$newPriority;
            }
            if (!empty($newCompleted)) {
                if (strtolower($newCompleted) === 's') {
                    $tasks[$taskIndex]['concluída'] = true;
                } elseif (strtolower($newCompleted) === 'n') {
                    $tasks[$taskIndex]['concluída'] = false;
                }
            }

            file_put_contents($file, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            
            echo "Tarefa editada com sucesso!\n\n";
        }

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