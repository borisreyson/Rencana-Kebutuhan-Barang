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
  <li><a><i class="fa fa-bus"></i>Sarpras <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">

<?php if(in_array('ktt sarpras',$arrRULE)): ?>
                  <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/ktt')); ?>">REPORT KELUAR MASUK SARANA</a></li>
<?php endif; ?>
<?php if(in_array('kabag sarpras',$arrRULE)): ?>
                  <?php if(in_array('hse sarpras',$arrRULE)): ?>

                  <li><a>HCGA DEPT <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                  <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk-appr')); ?>">KELUAR - MASUK SARANA APPROVE</a></li>
                  <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/kabag')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                    </li>
                  </ul>
                    <li><a>HSE DEPT <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                            <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk-appr/hse')); ?>">KELUAR - MASUK SARANA APPROVE</a></li>
                            <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/kabag/hse')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                        </ul>
                      </li>
                    <li><a>ENP DEPT <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                            <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/kabag/enp')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                        </ul>
                      </li>

                      <?php else: ?>
                  <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk-appr')); ?>">KELUAR - MASUK SARANA APPROVE</a></li>
                  <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/kabag')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                  <?php endif; ?>
<?php endif; ?>

<?php if(in_array('section sarpras',$arrRULE)): ?>
                  <li><a>Form <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk')); ?>">KELUAR - MASUK SARANA</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                    </ul>
                  </li>  
                  <li><a>Approve <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk-appr/section')); ?>">KELUAR - MASUK SARANA APPROVE</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/section')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                    </ul>
                  </li>
<?php endif; ?>

<?php if(in_array('hr sarpras',$arrRULE)): ?>   
                  <li><a>Form <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk')); ?>">KELUAR - MASUK SARANA</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                    </ul>
                  </li>               
                  <li><a>Approve <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk-appr/hr')); ?>">KELUAR - MASUK SARANA APPROVE</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/hr')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                    </ul>
                  </li>
<?php endif; ?>

<?php if(in_array('kordinator sarpras',$arrRULE)): ?>    
                  <?php if(in_array('admin sarpras',$arrRULE)): ?>    
                  <li><a>SARPRAS ADMIN <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                                        <li><a href="<?php echo e(url('/sarpras/data/karyawan')); ?>">DATA KARYAWAN</a></li>
                                        <li><a href="<?php echo e(url('/sarpras/data/driver')); ?>">DATA DRIVER</a></li>
                                        <li><a href="<?php echo e(url('/sarpras/data/sarana')); ?>">DATA UNIT SARANA</a></li>
                                        <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/all')); ?>">REPORT KELUAR MASUK SARANA SEMUA</a></li>
                  </ul>
                  </li> 
                  <li><a>Form <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk')); ?>">KELUAR - MASUK SARANA</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                    </ul>
                  </li>              
                  <li><a>Approve <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk-appr/kordinator')); ?>">KELUAR - MASUK SARANA APPROVE</a></li>
                    </ul>
                  </li>    
                  <?php endif; ?>
                  <?php if(in_array('security',$arrRULE)): ?>    
<li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/all')); ?>">REPORT KELUAR MASUK SARANA SEMUA</a></li>
                  <?php endif; ?>        
<?php endif; ?>
<?php if(in_array('pengguna sarpras',$arrRULE)): ?>
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk')); ?>">KELUAR - MASUK SARANA</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk')); ?>">REPORT KELUAR MASUK SARANA</a></li>
<?php endif; ?>
<?php if(in_array('admin abp',$arrRULE)): ?>
                  <li><a>Form <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk')); ?>">KELUAR - MASUK SARANA</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk')); ?>">REPORT KELUAR MASUK SARANA</a></li>
                    </ul>
                  </li>  
                  <li><a>Approve <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk-appr')); ?>">KELUAR - MASUK SARANA APPROVE</a></li>
                    </ul>
                  </li>
                  <li><a>ADMIN <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/sarana/keluar-masuk/admin')); ?>">KELUAR - MASUK SARANA ADMIN</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/admin')); ?>">REPORT KELUAR MASUK SARANA ADMIN</a></li>
                    </ul>
                  <li><a>Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('/sarpras/data/karyawan')); ?>">DATA KARYAWAN</a></li>
                      <li><a href="<?php echo e(url('/sarpras/data/driver')); ?>">DATA DRIVER</a></li>
                      <li><a href="<?php echo e(url('/sarpras/data/sarana')); ?>">DATA UNIT SARANA</a></li>
                      <li><a href="<?php echo e(url('/sarpras/report/keluar-masuk/all')); ?>">REPORT KELUAR MASUK SARANA SEMUA</a></li>
                    </ul>
                  </li> 
<?php endif; ?>
                  </li>
                    </ul>
                  </li>