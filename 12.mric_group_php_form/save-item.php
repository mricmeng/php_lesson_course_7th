<?php
    $cn = new mysqli("localhost", "root", "ServBay.dev", "php23");
    $cn->set_charset("utf8");
    $editId = $_POST['txt-edit-id'];
    $id = $_POST['txt-id'];
    $category = $_POST['txt-category'];
    $name = trim($_POST['txt-title']);
    $name = $cn->real_escape_string($name);
    $des = trim($_POST['txt-des']);
    $des = $cn->real_escape_string($des);
    $img = $_POST['txt-photo'];
    $status = $_POST['txt-status'];
    //check Duplicate name
    $sql = "SELECT * FROM tbl_cate_item WHERE title = '$name' && id != $id";
    $res = $cn->query($sql);
    $num = $res->num_rows;
    $msg['edit']=false;
    if($num == 0){
        if($editId == '0'){
            $sql = "INSERT INTO tbl_cate_item VALUES(null,$category,'$name','$des','$img',$status)";
            $cn->query($sql);
            $msg['id'] = $cn->insert_id; 
        }else{
            $sql = "UPDATE tbl_cate_item SET cate_id=$category, title='$name', photo='$img',  des='$des', status='$status' WHERE id = $id";
            $cn->query($sql);
            $msg['edit']=true;
        }
        
        $msg['dpl'] = false;

    }else{
        $msg['dpl'] = true;
    }
    echo json_encode($msg);
?>