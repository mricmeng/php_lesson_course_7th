<div class="left-menu">
  <ul>
    <?php
    foreach ($leftMenu as $val) {
    ?>
      <li>
        <a href="">
          <i class="<?php echo $val['icon'] ?>"></i><br>
          <?php echo $val['title'] ?>
        </a>
      </li>
    <?php
    }
    ?>
  </ul>
</div>