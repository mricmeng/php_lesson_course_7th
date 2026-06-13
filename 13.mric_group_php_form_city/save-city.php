<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php26");
    $id = $_POST['txt-id'];
    $name = trim($_POST['txt-name']);
    $name = $cn->real_escape_string($name);
    $des = trim($_POST['txt-des']);
    $des = str_replace("\n", "<br>", $des);
    $des = $cn->real_escape_string($des);
    $img = $_POST['txt-img-name'];
    $status = $_POST['txt-status'];
    $editId = $_POST['txt-edit-id'];
    $msg['edit'] = false;
    //check duplicate name
    $sql = "SELECT * FROM tbl_city WHERE name_city = '$name' && id != $id";
    $rs = $cn->query($sql);
    if($rs->num_rows > 0){
        $msg['dpl']= true;
    }else{
        $msg['dpl']= false;
        if($editId == 0){
            $sql = "INSERT INTO tbl_city VALUES (null, '$name', '$des', '$img', $status)";
            $cn->query($sql);
            $msg['id'] = $cn->insert_id;// $last_id = $cn->insert_id;
        }else{
            $sql = "UPDATE tbl_city SET name_city='$name', des_city='$des', img='$img', status='$status' WHERE id= $editId ";
            $cn->query($sql);
            $msg['edit'] = true;
        }
    }

    echo json_encode($msg);

?>