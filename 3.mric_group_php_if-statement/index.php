<?php
date_default_timezone_set('Asia/Phnom_Penh');
$txt = "My PHP";
$box1 = "box1";
$box2 = "box2";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
    echo $txt;
    ?>
  </title>
  <link rel="stylesheet" href="test1.css">
</head>

<body>

  <?php


  // (a) if...else 
  $txt = "PHP";
  if ($txt == "PHP") {
  ?>
    <div class='<?php echo $box1 ?>'>
      <?php
      echo $txt;
      ?>
    </div>
  <?php
  } else {
  ?>
    <div class="<?php echo $box2 ?>">
      <?php
      echo $txt;
      ?>
    </div>
  <?php
  }
  ?>
  <br><br>
  <?php
  // (b) if...else if ...else
  $i = 100;
  if ($i == 0) {
    echo $i;
  } else if ($i == 10) {
    echo $i;
  } else if ($i == 50) {
    echo $i;
  } else if ($i == 70) {
    echo $i;
  } else {
    echo $i;
  }
  ?>
  <br><br><br>
  <?php
  // (c)if...time
  $t = date("H");
  if ($t < 10) {
    echo "Have a good morning";
  } else if ($t < 20) {
    echo "Have a good day ";
  } else {
    echo "Have a good night";
  }
  ?>

  <h1>
    <?php
    // (c)date(d-m-y)
    echo "Today is :" . date("D-M-Y");
    echo "<br>";

    // (d) date(h:i:sa) 
    echo date("h:i:sA");
    ?>
  </h1>


</body>

</html>