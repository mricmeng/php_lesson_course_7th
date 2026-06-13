<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php26_1");
    $id = $_POST['txt-id'];
    $title = trim($_POST['txt-title']);
    $title = $cn->real_escape_string($title);
    $des = trim($_POST['txt-des']);
    $des = str_replace("\n", "<br>", $des);
    $des = $cn->real_escape_string($des);
    $img = $_POST['txt-photo'];
    $status = $_POST['txt-status'];
    $editId = $_POST['txt-edit-id'];
    $lang = $_POST['txt-lang'];
    $msg['edit'] = false;
    //check duplicate name
    $sql = "SELECT * FROM tbl_category WHERE title='$title' && id != $id";
    $rs = $cn->query($sql);
    if($rs->num_rows > 0){
        $msg['dpl']= true;
    }else{
        $msg['dpl']= false;
        if($editId == 0){
            $sql = "INSERT INTO tbl_category VALUES (null, '$title', '$des', '$img',$lang ,$status)";
            $cn->query($sql);
            $msg['id'] = $cn->insert_id;// $last_id = $cn->insert_id;
        }else{
            $sql = "UPDATE tbl_category SET title='$title', des ='$des', img='$img',lang='$lang', status='$status'  WHERE id=$editId ";
            $cn->query($sql);
            $msg['edit'] = true;
        }
    }
    echo json_encode($msg);

?>