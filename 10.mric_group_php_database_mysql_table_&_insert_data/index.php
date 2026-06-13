<!-- First step________ -->
<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php26");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Database</title>
</head>

<body>
    <h1>PHP Database</h1>
    <!-- second step___________-->
    <h2>Insert Data</h2>
    <?php
    $sql = "INSERT INTO tbl_test VALUE (null,'HT', 30)";
    $sql = "INSERT INTO tbl_test(price, name) VALUE (10, 'CSS')";
    $cn->query($sql);
    ?>
    <h2>
        <!-- Forth step___________-->
        Update Data
    </h2>
    <?php
        // $sql = "UPDATE tbl_test SET name = 'jQuery',price = 30 WHERE id = 4";
        // $cn->query($sql);
    ?>
    <h1>
        <!-- Fifth step___________-->
        Delete Data
    </h1>
    <?php
        // $sql = "DELETE FROM tbl_test WHERE id = 1";
        // $cn->query($sql);
    ?>
    <h2>Select Data</h2>
    <table width="70%" border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        <?php
        $total = 0;
        // third step_________
        $sql = "SELECT * FROM tbl_test ORDER BY id DESC LIMIT 0,20";
        // $sql = "SELECT id,name, price FROM tbl_test";
        $rs  = $cn->query($sql);
        // $row = $rs->fetch_array();
        $num = $rs->num_rows;//0
        if($num > 0){
            while($row = $rs->fetch_array()){
            $total += $row[2];
        ?>
        <tr>
            <td><?php echo $row[0] ?></td>
            <td><?php echo $row[1] ?></td>
            <td><?php echo $row[2] ?></td>
        </tr>
        <?php
        }
        
        }
        ?>
        <tr>
            <td colspan="2">Total</td>
            <td><?php echo $total ?></td>
        </tr>
    </table>
</body>


</html>