<?php
    $cn = new mysqli("localhost", "root", "ServBay.dev", "php23");
    $cn->set_charset("utf8");
    $id = $_POST['txt-id'];
    $name = trim($_POST['txt-name']);
    $name = $cn->real_escape_string($name);
    $status = $_POST['txt-status'];
    $img = $_POST['txt-photo'];
    $lang = $_POST['txt-lang'];
    //check Duplicate name
    $sql = "SELECT * FROM tbl_category WHERE name = '$name'";
    $res = $cn->query($sql);
    $num = $res->num_rows;
    if($num == 0){
        $sql = "INSERT INTO tbl_category VALUES(null,'$name','$img','$lang',$status)";
        $cn->query($sql);
        $msg['id'] = $cn->insert_id;
        $msg['dpl'] = false;
    }else{
        $msg['dpl'] = true;
    }
    echo json_encode($msg);
?>