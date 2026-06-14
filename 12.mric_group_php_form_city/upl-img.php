<?php
    $file = $_FILES['txt-file'];
    $imgName =$file['name'];
    $ext = pathinfo($imgName, PATHINFO_EXTENSION);
    $newName =time();
    $tmp =$file['tmp_name'];
    move_uploaded_file($tmp,'img/'.$newName .'.'.$ext);
    $msg['imgName'] = $newName .'.'.$ext;
    echo json_encode($msg);
?>