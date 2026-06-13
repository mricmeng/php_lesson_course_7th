<?php
date_default_timezone_set('Asia/Phnom_Penh');
$txt = "While Loop";
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
  <link rel="stylesheet" href="test2.css">
</head>

<body>
  <?php
  $x = 1;
  while ($x < 40) {
  ?>
    <div class="box2">
      <?php echo $x ?>
    </div>
  <?php
    $x++;
  }
  ?>


</body>

</html>