<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php23");
    $autoId = 1;
    $msg = '';
    if(isset($_POST['Submit'])){
        $name = $_POST['txt-name'];
        $price = $_POST['txt-price'];
        //check ducplicate name
        $sql = "SELECT * FROM tbl_test WHERE name = '$name'";
        $rs = $cn->query($sql);
        $num = $rs->num_rows; //>0; =0

        if($num == 0){
            $sql = "INSERT INTO tbl_test VALUES (null,'$name', $price)";
            $cn->query($sql); 
        }else{
            $msg = "Duplicate name";
        }   
    }
    //get last id
    $sql = "SELECT id FROM tbl_test ORDER BY id DESC";
    $rs = $cn->query($sql);
    $num = $rs->num_rows;
    if($num > 0){
        $row = $rs->fetch_array();
        $autoId = $row[0]+1;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <h1><?php echo $msg; ?></h1>
    <form action="index.php" method="post">
        <label for="name">ID</label><br>
        <input type="text" name="txt-id" id="" readonly value="<?php echo $autoId; ?>"><br>
        <label for="">Name</label><br>
        <input type="text" name="txt-name" id=""><br>
        <label for="">Price</label><br>
        <input type="text" name="txt-price" id=""><br>
        <input type="submit" value="Post" name="Submit">
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        <tr>
            <?php
            $sql = "SELECT * FROM tbl_test ORDER BY id DESC";
            $rs = $cn->query($sql);
             while($row = $rs->fetch_array()){
            ?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
        </tr>
        <?php
            }
            ?>
        </tr>
    </table>


</body>
<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

</html>