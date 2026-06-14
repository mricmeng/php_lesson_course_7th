<?php
    $cn = new mysqli("localhost", "root", "ServBay.dev", "php23");
    $cn->set_charset("utf8");
    $editId = $_POST['txt-edit-id'];
    $id = $_POST['txt-id'];
    $name = trim($_POST['txt-name']);
    $name = $cn->real_escape_string($name);
    $des = trim($_POST['txt-des']);
    $des = $cn->real_escape_string($des);
    $status = $_POST['txt-status'];
    $img = $_POST['txt-photo'];
    $lang = $_POST['txt-lang'];
    //check Duplicate name
    $sql = "SELECT * FROM tbl_category WHERE name = '$name' && id != $id";
    $res = $cn->query($sql);
    $num = $res->num_rows;
    $msg['edit']=false;
    if($num == 0){
        if($editId == '0'){
            $sql = "INSERT INTO tbl_category VALUES(null,'$name','$img','$lang','$des',$status)";
            $cn->query($sql);
            $msg['id'] = $cn->insert_id; 
        }else{
            $sql = "UPDATE tbl_category SET 
            name='$name', 
            photo='$img',
            des='$des', 
            lang='$lang', 
            status='$status' 
            WHERE id = $id";
            $cn->query($sql);
            $msg['edit']=true;
        }
        
        $msg['dpl'] = false;

    }else{
        $msg['dpl'] = true;
    }
    echo json_encode($msg);
?>