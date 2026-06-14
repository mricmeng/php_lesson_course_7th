<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php26_1");
    $lang = 1;
    $home = array("1"=>"Home","2"=>"ទំព័រដើម");
    if (isset($_GET['lang'])){
        $lang = $_GET['lang'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <?php
        if($lang ==2){
            ?>
    <link rel="stylesheet" href="style/kh.css">
    <?php
        }
    ?>



</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 menu-bar">
                <div class="menu">
                    <ul>
                        <li>
                            <a href=""><?php echo $home[$lang] ?></a>
                        </li>
                        <?php
                            $sql = "SELECT id, title FROM tbl_category WHERE status =1 && lang = $lang";
                            $rs = $cn->query($sql);
                            if($rs->num_rows>0){
                                while($row = $rs->fetch_array()){
                                ?>
                        <li>
                            <a href=""><?php echo $row[1]; ?></a>
                        </li>
                        <?php
                                }
                            }
                        ?>
                        <li>
                            <a href="index.php?lang=1">EN</a>
                        </li>
                        <li>
                            <a href="index.php?lang=2">KH</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 header">
                <h1>Khmer Empire</h1>
                <p>Descrition</p>
            </div>
        </div>
        <div class="row">
            <?php
                
             ?>
            <div class="col-xl-3 col-lg-3 item-box">
                <div class="box">
                    <div class="img-box">
                        <img src="img/1.jpg" alt="">
                    </div>
                    <div class="txt-box">
                        <h1>Phnom Penh</h1>
                        <p>Description</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 item-box">
                <div class="box">
                    <div class="img-box">
                        <img src="img/1.jpg" alt="">
                    </div>
                    <div class="txt-box">
                        <h1>Phnom Penh</h1>
                        <p>Description</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 item-box">
                <div class="box">
                    <div class="img-box">
                        <img src="img/1.jpg" alt="">
                    </div>
                    <div class="txt-box">
                        <h1>Phnom Penh</h1>
                        <p>Description</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 item-box">
                <div class="box">
                    <div class="img-box">
                        <img src="img/1.jpg" alt="">
                    </div>
                    <div class="txt-box">
                        <h1>Phnom Penh</h1>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>