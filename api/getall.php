<?php
require('../config.php');
$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'get'){

    $sql = $pdo->query("SELECT * FROM registers");
    if($sql->rowCount() > 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $item){
            $array['result'][] = [
                'id'=>$item['id'],
                'ident'=>$item['ident'],
                'name'=>$item['name'],
                'cpf'=>$item['cpf'],
                'terminal'=>$item['terminal'],
                'valor'=>$item['valor'],
                'data'=>$item['data'],
                'status'=>$item['status']
            ];
        }
    }

}else{
    $array['error'] = 'Metodo não permitido (apenas GET)';
}

require('../return.php');