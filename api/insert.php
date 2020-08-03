<?php
require('../config.php');
$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'post'){

    $ident = filter_input(INPUT_POST, 'ident');
    $name = filter_input(INPUT_POST, 'name');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $terminal = filter_input(INPUT_POST, 'terminal');
    $valor = filter_input(INPUT_POST, 'valor');
    $data_oper = filter_input(INPUT_POST, 'data_oper');
    $status_oper = filter_input(INPUT_POST, 'status_oper');

    if($ident && $name && $cpf && $terminal && $valor && $data_oper && $status_oper){
        $sql = $pdo->prepare("INSERT INTO registers (ident, name_pess, cpf, terminal, valor, data_oper, status_oper) VALUES (:ident, :name_pess, :cpf, :terminal, :valor, :data_oper, :status_oper)");
        $sql->bindValue(":ident",$ident);
        $sql->bindValue(":name_pess",$name);
        $sql->bindValue(":cpf",$cpf);
        $sql->bindValue(":terminal",$terminal);
        $sql->bindValue(":valor",$valor);
        $sql->bindValue(":data_oper",$data_oper);
        $sql->bindValue(":status_oper",$status_oper);
        $sql->execute();

        $id = $pdo->lastInsertId();
        $array['result'] = [
            'id'=> $id
        ];
        
    }else{
        $array['error'] = "Campos obrigatorios não preenchidos";
    }

}else{
    $array['error'] = 'Metodo não permitido (apenas POST)';
}

require('../return.php');