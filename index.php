<?php
header('Content-Type: json/application');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require 'connect.php';
require 'functions.php';



$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$key = $params[1];
$id = $params[2];
$api = $params[2];
$apiId = $params[3];
if ($method === 'GET'){
    if($type === 'posts'){
        if($key === 'allUser'){
            if (isset($id)){
                getUserPost($connect, $id);
            }else{
                getUserPosts($connect);
            }
        } elseif($key === 'allQues'){
            if (isset($id)){
                getQuesPost($connect, $id);
            }else{
                getQuesPosts($connect);
            }
        } 
    } elseif($type === 'api'){
        if($key === 'messages'){
            if (($api ==='get')&&(isset($apiId))){
                getUserMessengerPost($connect, $apiId);
            }else{
                getUserMessengerPosts($connect);
            }
        }
    }
} elseif($method === 'POST'){
     if($type === 'posts'){
        if($key === 'addUser'){
           addUser($connect, $_POST);
        } elseif($key === 'addQues'){
           addQues($connect, $_POST);
        }
       
        
    }elseif($type === 'api'){
        if($key === 'messages'){
            if ($api ==='add'){
                addUserMessenger($connect, $_POST);
            }
        }
    }
}elseif($method === 'PATCH'){
     if($type === 'posts'){
        if($key === 'pathUser'){
           if (isset($id)){
               $data = file_get_contents('php://input');
               $data = json_decode($data, true);
                updateUser($connect,$id, $data);
            }
        }
       
    }
}



?>