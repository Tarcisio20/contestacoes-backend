<?php
require('../config.php');
$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'put'){

    parse_str(file_get_contents('php://input'), $input);

    $id = (!empty($input['id'])) ? $input['id'] : null;
    $ident = (!empty($input['ident'])) ? $input['ident'] : null;
    $name = (!empty($input['name'])) ? $input['name'] : null;
    $cpf = (!empty($input['cpf'])) ? $input['cpf'] : null;
    $terminal = (!empty($input['terminal'])) ? $input['terminal'] : null;
    $valor = (!empty($input['valor'])) ? $input['valor'] : null;
    $data_oper = (!empty($input['data_oper'])) ? $input['data_oper'] : null;
    $status_oper = (!empty($input['status_oper'])) ? $input['status_oper'] : null;

    $id = filter_var($id);
    $name = filter_var($name);
    $ident = filter_var($ident);
    $cpf = filter_var($cpf);
    $terminal = filter_var($terminal);
    $valor = filter_var($valor);
    $data_oper = filter_var($data_oper);
    $status_oper = filter_var($status_oper);

    if($id){
        $sql = $pdo->prepare("SELECT * FROM registers WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $pdo->prepare("UPDATE registers SET ident = :ident, name_pess = :name_pess,cpf = :cpf, terminal = :terminal, valor = :valor, data_oper = :data_oper, status_oper = :status_oper WHERE id = :id" );
            $sql->bindValue(":id",$id);
            $sql->bindValue(":ident",$ident);
            $sql->bindValue(":name_pess",$name);
            $sql->bindValue(":cpf",$cpf);
            $sql->bindValue(":terminal",$terminal);
            $sql->bindValue(":valor",$valor);
            $sql->bindValue(":data_oper",$data_oper);
            $sql->bindValue(":status_oper",$status_oper);
            $sql->execute();

            $array['result'] = ["id"=>$id];
        }else{
            $array['error'] = "Contestação não localizada!";    
        }
    }else{
        $array['error'] = "Dados invalidos";
    }


  
}else{
    $array['error'] = 'Metodo não permitido (apenas PUT)';
}

require('../return.php');