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
  <link rel="stylesheet" href="test3.css">
</head>

<body>
  <?php
  for ($i = 1; $i < 100; $i += 10) {
  ?>
    <div class="box1">
      <?php echo $i ?>
    </div>
  <?php
  }
  ?>


</body>

</html>