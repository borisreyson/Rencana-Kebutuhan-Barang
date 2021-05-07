<li><a>OB<span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
      <li class="sub_menu"><a href="<?php echo e(url('/ob/daily')); ?>">DAILY</a>
      </li>
      <li><a href="<?php echo e(url('/ob/monthly')); ?>">MONTHLY</a>
      </li>
      <li><a href="<?php echo e(url('/ob/ach')); ?>">ACH</a>
      </li>
      <li class="sub_menu"><a href="<?php echo e(url('/ob/delay')); ?>">DELAY</a>
      </li>
    </ul>
</li>
<li><a>Hauling <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
      <li class="sub_menu"><a href="<?php echo e(url('/hauling/daily')); ?>">DAILY</a>
      </li>
      <li><a href="<?php echo e(url('/hauling/monthly')); ?>">MONTHLY</a>
      </li>
      <li><a href="<?php echo e(url('/hauling/ach')); ?>">ACH</a>
      </li>
      <li class="sub_menu"><a href="<?php echo e(url('/hauling/delay')); ?>">DELAY</a>
      </li>
    </ul>
</li>
<li><a>Crushing <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
      <li class="sub_menu"><a href="<?php echo e(url('/crushing/daily')); ?>">DAILY</a>
      </li>
      <li><a href="<?php echo e(url('/crushing/monthly')); ?>">MONTHLY</a>
      </li>
      <li><a href="<?php echo e(url('/crushing/ach')); ?>">ACH</a>
      </li>
      <li class="sub_menu"><a href="<?php echo e(url('/crushing/delay')); ?>">DELAY</a>
      </li>
    </ul>
</li>
<li><a>Barging <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
      <li class="sub_menu"><a href="<?php echo e(url('/barging/daily')); ?>">DAILY</a>
      </li>
      <li><a href="<?php echo e(url('/barging/monthly')); ?>">MONTHLY</a>
      </li>
      <li><a href="<?php echo e(url('/barging/ach')); ?>">ACH</a>
      </li>
      <li class="sub_menu"><a href="<?php echo e(url('/barging/delay')); ?>">DELAY</a></li>
    </ul>
</li>
<li><a href="<?php echo e(url('/boat')); ?>">Tug Boat</a></li>
<li><a href="<?php echo e(url('/stockProduct')); ?>">Stock</a></li>
<li><a href="<?php echo e(url('/monitoring/sr/daily')); ?>">SR (Stripping Ratio)</a></li>
<?php if(isset($_SESSION['admin'])): ?>
<li>
  <a>SR<span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
      <li class="sub_menu"><a href="<?php echo e(url('/monitoring/sr/daily')); ?>">DAILY</a>
      </li>
      <li><a href="<?php echo e(url('/monitoring/sr/monthly')); ?>">MONTHLY</a>
      </li>
    </ul>
    <?php endif; ?>