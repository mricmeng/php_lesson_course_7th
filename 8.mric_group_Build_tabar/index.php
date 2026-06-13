<?php
include("header.php");
?>

<body>
  <?php
  include("left-menu.php");
  $imgList = "1.jpg,2.jpeg,3.jpg";
  $img = explode(",", $imgList)

  ?>
  <div class="container">
    <?php
    foreach ($img as $myimg) {
    ?>
      <img src="image/<?php echo $myimg; ?>" alt="">
    <?php
    }
    ?>

  </div>
</body>

</html>