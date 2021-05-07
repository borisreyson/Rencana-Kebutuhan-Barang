<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/')); ?>">Main Page</a></li>
                      
                      <?php if($_SESSION['section']=="KABAG" || $_SESSION['section']=="SECTION_HEAD"): ?>
                      <?php if(isset($id_pesan)): ?>
                      <li><a href="<?php echo e(url('/kabag/inbox/'.$id_pesan.'.message')); ?>">INBOX</a></li>
                      <?php else: ?>
                      <li><a href="<?php echo e(url('/kabag/inbox')); ?>">INBOX</a></li>
                      <?php endif; ?>
                      <?php elseif($_SESSION['section']=="KTT"): ?>
                      <?php if(isset($id_pesan)): ?>
                      <li><a href="<?php echo e(url('/ktt/inbox/'.$id_pesan.'.message')); ?>">INBOX</a></li>
                      <?php else: ?>
                      <li><a href="<?php echo e(url('/ktt/inbox')); ?>">INBOX</a></li>
                      <?php endif; ?>
                      <?php elseif($_SESSION['section']=="PURCHASING"): ?>
                      <?php if(isset($id_pesan)): ?>
                      <li><a href="<?php echo e(url('/logistic/inbox/'.$id_pesan.'.message')); ?>">INBOX</a></li>
                      <?php else: ?>
                      <li><a href="<?php echo e(url('/logistic/inbox')); ?>">INBOX</a></li>
                      <?php endif; ?>
                      <?php elseif($_SESSION['level']=="administrator"): ?>
                      <?php if(isset($id_pesan)): ?>
                      <li><a href="<?php echo e(url('/admin/inbox/'.$id_pesan.'.message')); ?>">INBOX</a></li>
                      <?php else: ?>
                      <li><a href="<?php echo e(url('/admin/inbox')); ?>">INBOX</a></li>
                      <li><a href="<?php echo e(url('/admin/all/inbox')); ?>">ALL INBOX</a></li>
                      <?php endif; ?>
                      <?php else: ?>
                      <?php if(isset($id_pesan)): ?>
                      <li><a href="<?php echo e(url('/inbox/'.$id_pesan.'.message')); ?>">INBOX</a></li>
                      <li><a href="<?php echo e(url('/sent/'.$id_pesan.'.message')); ?>">SENT</a></li>
                      <?php else: ?>
                      <li><a href="<?php echo e(url('/inbox')); ?>">INBOX</a></li>
                      <li><a href="<?php echo e(url('/sent')); ?>">SENT</a></li>
                      <?php endif; ?>
                      <?php endif; ?>
                    </ul>
                  </li>