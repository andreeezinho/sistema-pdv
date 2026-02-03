<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}  

//var_dunmp
function dd($data){
    var_dump($data);
    die;
}

//verificar permissao de usuario
function userPermission($permissao_nome){
    $permissoes = $_SESSION['permissoes'];

    foreach($permissoes as $permissao){
        if($permissao->nome == $permissao_nome){
            return true;
        }
    }

    return false;
}

function userPermissionChecked($permissao_id, $user_permissoes){
    foreach($user_permissoes as $permissao){
        if($permissao->permissoes_id === $permissao_id){
            return true;
        }
    }

    return false;
}

//enviar imagem para o servidor
function createImage($arquivo, $dir){
    if(empty($arquivo['name']) || empty($arquivo['tmp_name'])){
        return null;
    }

    // if(
    //     $arquivo['type'] != 'image/jpeg' &&
    //     $arquivo['type'] != 'image/png' &&
    //     $arquivo['type'] != 'image/svg*xml' &&
    //     $arquivo['type'] != 'image/webp' 
    // ){
    //     return null;
    // }

    $root_dir = rtrim($_SERVER['DOCUMENT_ROOT'] . '/public/img' . $dir, "/") . '/';

    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

    $nome_original = pathinfo($arquivo['name'], PATHINFO_FILENAME);
    

    $arquivo_nome = uniqid() . "_" . time() . "." . $extensao;
    
    if(!is_dir($root_dir)){
        if(!mkdir($root_dir, 0755, true)){
            return null;
        }
    }

    $destino = $root_dir . $arquivo_nome;

    if(move_uploaded_file($arquivo['tmp_name'], $destino)){
        return [
            'nome_original' => $nome_original,
            'arquivo_nome' =>$arquivo_nome,
            'diretorio' => $destino,
        ];
    }

    return null;
}

function priceWithDiscount(array $products, float $discount = 0){
    $total = 0;

    foreach($products as $product){
        if(isset($product->quantidade)){
            $total += $product->preco * $product->quantidade;
        }


        if(!isset($product->quantidade)){
            $total = $total + $product->preco;
        }
    }

    if($discount > 0){
        $total -= $discount;
        $total *= -1;
    }

    return $total;
}