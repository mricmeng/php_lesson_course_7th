<?php
    $file = $_FILES["txt-file"];
    $img = $file["tmp_name"];
    $img_name =$file["name"];
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $t =time();
    // echo mt_rand(100000, 999999);
    // echo $t;
    $newName = $t.mt_rand(100000, 999999);
    // echo $img_name;
    move_uploaded_file($img,"img_file/".$newName .".".$ext);
?>