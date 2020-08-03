<?php
require('../config.php');
$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'get'){

    $id = filter_input(INPUT_GET, 'id');
    if($id){
        $sql = $pdo->prepare("SELECT * FROM registers WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $item = $sql->fetch(PDO::FETCH_ASSOC);
            $array['result'] = [
                'id'=>$item['id'],
                'ident'=>$item['ident'],
                'name'=>$item['name'],
                'cpf'=>$item['cpf'],
                'terminal'=>$item['terminal'],
                'valor'=>$item['valor'],
                'data'=>$item['data'],
                'status'=>$item['status']   
            ];
        }else {
            $array['error'] = 'ID inexistente';    
        }
    }else{
        $array['error'] = 'ID não econtrado';
    }    

}else{
    $array['error'] = 'Metodo não permitido (apenas GET)';
}

require('../return.php');