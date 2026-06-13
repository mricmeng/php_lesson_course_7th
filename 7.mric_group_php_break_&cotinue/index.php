<?php
date_default_timezone_set('Asia/Phnom_Penh');
$txt = "For Loop";
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
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  //Break for loop
  for ($x = 0; $x < 6; $x++) {
    if ($x == 3) {
      break;
    }
    echo $x . "<br>";
  }
  ?>
  <br><br>
  <?php
  //Continue for loop
  for ($i = 0; $i < 6; $i++) {
    if ($i == 3) {
      continue;
    }
    echo $i . "<br>";
  }
  ?>





</body>

</html>