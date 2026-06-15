<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php23");
    $lang ='kh';
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    }
    $myLang = array("eng"=>"Home","kh"=>"ទំព័រដើម");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 1</title>
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <!-- link css -->
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 menu">
                <ul>
                    <li>
                        <a href="">
                            <?php
                            echo $myLang[$lang];
                            // if($lang=='eng'){
                            //     echo "Home";
                            // }else{
                            //     echo "ទំព័រដើម";
                            // }
                            ?>
                        </a>
                    </li>
                    <?php
                        $sql = "SELECT * FROM tbl_category WHERE status=1 && lang ='$lang' ORDER BY id";
                        $res = $cn->query($sql);
                        if($res->num_rows > 0){
                            while($row = $res->fetch_array()){
                            ?>
                    <li>
                        <a href=""><?php echo $row[1];?></a>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
                <ul>
                    <li>
                        <a href="index.php?lang=eng">English</a>
                    </li>
                    <li>
                        <a href="index.php?lang=kh">Khmer</a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 head-box">
                <h1>Khmer</h1>
                <p>ddfjakdfjdkfdkfjjkdfadlfjakdjfakjfdaskhfasd</p>
            </div>
            <?php
            $sql = "SELECT * FROM tbl_category WHERE status=1 && lang ='$lang' ORDER BY id";
            $res = $cn->query($sql);
            if($res->num_rows > 0){
                while($row = $res->fetch_array()){
                    ?>
            <div class="col-xl-3 item-box">
                <div class="item">
                    <div class="img-box" style="background-image:url(<?php echo $row[2]; ?>)">
                        1
                    </div>
                    <div class="txt-box">
                        <h1><?php echo $row[1]; ?></h1>
                        <p><?php echo $row[4]; ?></p>
                    </div>
                </div>
            </div>

            <?php
                }
            }

            ?>

        </div>
    </div>

</body>

</html>