<?php
$arrRULE = [];
  if(isset($getUser)){
    $arrRULE = explode(',',$getUser->rule);    
  }else{
    ?>
<script>
  window.location="<?php echo e(url('/logout')); ?>";
</script>
    <?php } ?>
 <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(asset('/abp_100x97.png')); ?>" alt="">
                <?php echo e(isset($getUser->nama_lengkap) ? $getUser->nama_lengkap : $getUser->username); ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo e(url('/form_user/'.bin2hex($_SESSION['username']).'.html')); ?>"> Edit Account</a></li>
                    <li><a href="<?php echo e(url('/form_user/'.bin2hex($_SESSION['username']).'.password')); ?>"> Change Password</a></li>
                    <?php if($_SESSION['section']=="KTT"||$_SESSION['section']=="KABAG" || $_SESSION['section']=="SECTION_HEAD"): ?>
                    <?php if($_SESSION['level']!="PLT"): ?>
                    <li><a href="<?php echo e(url('/form_user/'.bin2hex($_SESSION['username']).'.plt')); ?>"> User PLT</a></li>
                    <?php endif; ?>
                    <?php endif; ?>
<!--
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
-->
                    <li><a href="<?php echo e(asset('/logout')); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!-- pesan -->
                <?php 
                $message = Illuminate\Support\Facades\DB::table('notification')
                            ->leftJoin("user_login","user_login.username","notification.user_send")
                            ->where([
                                      ["user_notif",$_SESSION['username']],
                                      ["flag",0]
                                      ])
                            ->orderBy("timelog","desc")
                            ->limit(5)
                            ->get();
                $bell = Illuminate\Support\Facades\DB::table('status_inv')
                            ->where([
                                      ["user_notif",$_SESSION['username']],
                                      ["flag",0]
                                      ])
                            ->orderBy("timelog","desc")
                            ->limit(5)
                            ->get();
                 ?>

<?php if($_SESSION['section']!="BOD"): ?>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" id="notifOpen" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o "></i>
                    <span class="badge bg-green" id="numberNotif"><?php if(count($message)>0): ?><?php echo e(count($message)); ?><?php endif; ?></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
<?php if(count($message)>0): ?>
                <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($_SESSION['section']=="KTT"): ?>
                    <li id="notifList">
                      <a href="<?php echo e(url('/ktt/inbox/'.bin2hex($v->idNotif))); ?>.message">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo e($v->nama_lengkap); ?></span>
                          <span class="time"><?php echo e(date("h:i A, M d",strtotime($v->timelog))); ?></span>
                        </span>
                        <span class="message">
                          <input type="hidden" id="idNotif" name="idNotif[]" value="<?php echo e($v->idNotif); ?>">
                            <?php if(strlen($v->notif)>100){ ?>
                              <?php echo strip_tags(substr($v->notif,0,100),'<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo $v->notif; ?>

                            <?php } ?>
                        </span>
                      </a>
                    </li>
<?php elseif($_SESSION['section']=="KABAG" || $_SESSION['section']=="SECTION_HEAD"): ?>
                    <li id="notifList">
                      <a href="<?php echo e(url('/kabag/inbox/'.bin2hex($v->idNotif))); ?>.message">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo e($v->nama_lengkap); ?></span>
                          <span class="time"><?php echo e(date("h:i A, M d",strtotime($v->timelog))); ?></span>
                        </span>
                        <span class="message">
                          <input type="hidden" id="idNotif" name="idNotif[]" value="<?php echo e($v->idNotif); ?>">
                            <?php if(strlen($v->notif)>100){ ?>
                              <?php echo strip_tags(substr($v->notif,0,100),'<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo $v->notif; ?>

                            <?php } ?>
                        </span>
                      </a>
                    </li>
<?php elseif($_SESSION['level']=="administrator"): ?>
                    <li id="notifList">
                      <a href="<?php echo e(url('/admin/inbox/'.bin2hex($v->idNotif))); ?>.message">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo e($v->nama_lengkap); ?></span>
                          <span class="time"><?php echo e(date("h:i A, M d",strtotime($v->timelog))); ?></span>
                        </span>
                        <span class="message">
                          <input type="hidden" id="idNotif" name="idNotif[]" value="<?php echo e($v->idNotif); ?>">
                            <?php if(strlen($v->notif)>100){ ?>
                              <?php echo strip_tags(substr($v->notif,0,100),'<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo $v->notif; ?>

                            <?php } ?>
                        </span>
                      </a>
                    </li>
<?php elseif($_SESSION['section']=="PURCHASING"): ?>
                    <li id="notifList">
                      <a href="<?php echo e(url('/logistic/inbox/'.bin2hex($v->idNotif))); ?>.message">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo e($v->nama_lengkap); ?></span>
                          <span class="time"><?php echo e(date("h:i A, M d",strtotime($v->timelog))); ?></span>
                        </span>
                        <span class="message">
                          <input type="hidden" id="idNotif" name="idNotif[]" value="<?php echo e($v->idNotif); ?>">
                            <?php if(strlen($v->notif)>100){ ?>
                              <?php echo strip_tags(substr($v->notif,0,100),'<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo $v->notif; ?>

                            <?php } ?>
                        </span>
                      </a>
                    </li>
<?php else: ?>
                    <li id="notifList">
                      <a href="<?php echo e(url('/inbox/'.bin2hex($v->idNotif))); ?>.message">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo e($v->nama_lengkap); ?></span>
                          <span class="time"><?php echo e(date("h:i A, M d",strtotime($v->timelog))); ?></span>
                        </span>
                        <span class="message">
                          <input type="hidden" id="idNotif" name="idNotif[]" value="<?php echo e($v->idNotif); ?>">
                            <?php if(strlen($v->notif)>100){ ?>
                              <?php echo strip_tags(substr($v->notif,0,100),'<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo $v->notif; ?>

                            <?php } ?>
                        </span>
                      </a>
                    </li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
                    <li id="nothing">
                        <span class="message ">
                          <center>
                          Nothing!
                          </center>
                        </span>
                    </li>
<?php endif; ?>
                    <li>
                      <div class="text-center">

                        <?php if($_SESSION['section']=="KTT"): ?>
                        <a href="<?php echo e(url('/ktt/inbox')); ?>">
                          <strong>See All Inbox</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                        <?php elseif($_SESSION['section']=="KABAG" || $_SESSION['section']=="SECTION_HEAD"): ?>
                        <a href="<?php echo e(url('/kabag/inbox')); ?>">
                          <strong>See All Inbox</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                        <?php elseif($_SESSION['section']=="PURCHASING"): ?>
                        <a href="<?php echo e(url('/logistic/inbox')); ?>">
                          <strong>See All Inbox</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                        <?php elseif($_SESSION['level']=="administrator"): ?>
                        <a href="<?php echo e(url('/admin/inbox')); ?>">
                          <strong>See All Inbox</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                        <?php else: ?>

                        <a href="<?php echo e(url('/inbox')); ?>">
                          <strong>See All Inbox</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                        <?php endif; ?>
                      </div>
                    </li>
                  </ul>
                </li>
                <?php endif; ?>
                <!-- pesan -->
                <?php if(in_array('notif inventory',$arrRULE)): ?>   
    <li role="presentation" class="dropdown">
        <a href="javascript:;" id="" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o "></i>
                    <span class="badge bg-green" id="numberNotif"><?php if(count($bell)>0): ?><?php echo e(count($bell)); ?><?php endif; ?></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <?php if(count($bell)>0): ?>
                <?php $__currentLoopData = $bell; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li id="notifList">
                      <?php if($v->item!=""): ?>
                      <a href="<?php echo e(url('/inventory/stock?cari='.($v->item).'&notif=open')); ?>">
                      <?php else: ?>
                      <a href="<?php echo e(url('/masteritem/request/detail/log')); ?>?token=<?php echo e($v->idStatus); ?>">
                      <?php endif; ?>
                        <span>
                          <span><?php echo e($v->user_send); ?></span>
                          <span class="time"><?php echo e(date("h:i A, M d",strtotime($v->timelog))); ?></span>
                        </span>
                        <span class="message">
                          <input type="hidden" id="idNotif" name="idNotif[]" value="<?php echo e($v->idStatus); ?>">
                            <?php if(strlen($v->notif)>100){ ?>
                              <?php echo strip_tags(substr($v->notif,0,100),'<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo $v->notif; ?>

                            <?php } ?>
            </span>
         </a>
      </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
                    <li id="nothing">
                        <span class="message ">
                          <center>
                          Nothing!
                          </center>
                        </span>
                    </li>
<li> 
<div class="text-center">
  <a href="<?php echo e(url('/inbox')); ?>">
    <strong>See All Notification</strong>
    <i class="fa fa-angle-right"></i>
  </a>
</div>
</li>
                    </ul>
                  </li>
     <?php endif; ?>
<?php endif; ?>
              </ul>
            </nav>
          </div>
        </div>
