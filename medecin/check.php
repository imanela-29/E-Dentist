<?php


if(isset($_POST['id'])){
  include 'php/con_index.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $todos = $connect->prepare("SELECT id, checked FROM events WHERE id = '$id'");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $connect->query("UPDATE events SET checked = '$uChecked' WHERE id = '$uId'");
        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        $connect = null;
        exit();
    }
}else {
    header("Location: salle_attente?mess=error.php");
}