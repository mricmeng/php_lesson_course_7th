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
  //(a)foreach_with array_index
  $color = array(
    "red",
    "green",
    "blue",
    "gray"
  );
  foreach ($color as $val) {
  ?>
    <div class="box2" style="background-color:<?php echo $val ?>">
      <?php echo "<center>$val</center>" ?>
    </div>
  <?php
  }
  ?>
  <?php
  //foreach with associate_array
  $year = array(
    "PHP" => "1995",
    "APS.Net" => "2002",
    "JSP" => "1999",
  );
  foreach ($year as $key => $val) {
  ?>
    <div class="box2">
      <?php echo "$key " . "<br>" . " $val" ?>
    </div>
  <?php
  }
  ?>
  <br><br>
  <?php
  //d. miltidimension_array_style 01
  $students = array(
    array("Heng", "M", "18"),
    array("lin", "F", "18"),
    array("linda", "F", "20"),
    array("Meng", "M", "21",),
  );
  foreach ($students as $val) {
  ?>
    <div class="box2">
      <?php echo $val[0] . "<br>" . $val[1] . "<br>" . $val[2]; ?>
    </div>
  <?php
  }
  ?>
  <br><br>
  <?php
  //d. miltidimension_array_style 02
  $students = array(
    array(
      "name" => "Heng",
      "sex" => "M",
      "age" => "18"
    ),
    array(
      "name" => "lin",
      "sex" => "F",
      "age" => "18"
    ),
    array(
      "name" => "linda",
      "sex" => "F",
      "age" => "20"
    ),
    array(
      "name" => "Meng",
      "sex" => "M",
      "age" => "21",
    ),
  );
  foreach ($students as $val) {
  ?>
    <div class="box2" style="background-color: lightgreen" ;>
      <?php echo $val['name'] . "<br>" . $val['sex'] . "<br>" . $val['age']; ?>
    </div>
  <?php
  }
  ?>
</body>

</html>