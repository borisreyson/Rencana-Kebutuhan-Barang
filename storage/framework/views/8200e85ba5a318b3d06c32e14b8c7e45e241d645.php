<!-- default background #2A3F54-->
<style>
  @font-face {
    font-family: colonna_mt;
    src: url("<?php echo e(asset('fonts/colonna_mt.ttf')); ?>");
}

body {
    background: rgba(0,0,0,0.9)!important;
  }
.e_rkb{
 font-family: colonna_mt;
 font-size: 35px;
}
.e_font{
 font-family: colonna_mt;
 font-size: 50px;  
}
.left_col {
  background: rgba(0,0,0,0)!important;

}
.nav_title {
  background-color: rgba(0,0,0,0)!important;
}

.nav.side-menu>li.active>a {
    background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), rgba(0,0,0,0.1)!important;
    color: #EBA40E!important;
}
.nav-sm ul.nav.child_menu {
    background: rgba(0,0,0,1)!important;
  }
.sidebar-footer{
    background: rgba(0,0,0,1)!important;
}
.sidebar-footer a{
  color: rgba(255,255,255,0.9)!important;
    background: rgba(0,0,0,0.5)!important;
}
.sidebar-footer a:hover{
  background: rgba(78,94,92,0.5)!important;

  color: rgba(255,255,255,1)!important;
}
.menu_section {
  z-index: 1!important;
}
</style>

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
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo e(url('https://bit.ly/2VWCDfb')); ?>" class="site_title">
               <span class="e_font">ABP</span><span class="e_rkb"> System</span></a>
               
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo e(asset('/abp_100x97.png')); ?>" alt="..." class="img-circle profile_img" >

              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2><?php echo e(isset($getUser->nama_lengkap) ? $getUser->nama_lengkap : $getUser->username); ?> </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
<?php if($_SESSION['section']!="BOD"): ?>
<!--bukan BOD-->

                  <?php echo $__env->make('layout.home',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                  <?php if(!($_SESSION['section']=="KABAG" || $_SESSION['section']=="SECTION_HEAD" || $_SESSION['section']=="KTT")): ?>
<?php if(in_array('form',$arrRULE)): ?>
                  <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    
<?php if(in_array('rkb',$arrRULE)): ?>    
                      <li><a href="<?php echo e(url('/v1/form_rkb')); ?>">RKB</a></li>
<?php endif; ?>
                     
<?php if(in_array('master request',$arrRULE)): ?>    
                      <li><a href="<?php echo e(url('/masteritem/request')); ?>">Master Item Request</a></li>
<?php endif; ?>
                 

<?php if(in_array('monitoring',$arrRULE)): ?>
<li><a>Monitoring<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
<?php if(in_array('admin abp',$arrRULE)): ?>

    <li><a>Produksi PT. ABP<span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
      <?php echo $__env->make('layout.abp',["getUser"=>$getUser,"arrRULE"=>$arrRULE], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </ul>
    </li>
<?php endif; ?>
<?php if(in_array('admin mhu',$arrRULE)): ?>
    <li><a>Produksi PT. MHU<span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
      <?php echo $__env->make('layout.mhu',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </ul>
    </li>
<?php endif; ?>


<?php if(in_array('unit rental',$arrRULE)): ?>
    <li><a>Unit Rental<span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
      <?php echo $__env->make('layout.rental',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </ul>
    </li>
<?php endif; ?>


  </ul>
</li>
                      <?php endif; ?>
                    </ul>
                  </li>
<?php endif; ?>
                  <?php endif; ?>
                  <li><a><i class="fa fa-clone"></i>RKB <span class="fa fa-chevron-down"></span></a>
                    
                    <ul class="nav child_menu">
                      <?php if($_SESSION['section']=="KABAG" || $_SESSION['section']=="SECTION_HEAD"): ?>
                      <li><a href="<?php echo e(url('/kabag/rkb')); ?>">Rkb</a></li>
                      <?php if($_SESSION['department']=="hrga"): ?>
                      <li><a href="<?php echo e(url('/kabag/alldept/rkb')); ?>">Rkb All Dept</a></li>
                      <?php elseif($_SESSION['department']=="enp" && $_SESSION['section']=="KABAG"): ?>
                      <!-- <li><a href="<?php echo e(url('/kabag/mtk/rkb')); ?>">Rkb MTK</a></li> -->
                      <?php endif; ?>
                      <li><a href="<?php echo e(url('/kabag/rkbPrint')); ?>">Print Rkb</a></li>
                      <?php elseif($_SESSION['section']=="KTT"): ?>
                      <li><a href="<?php echo e(url('/ktt/rkb')); ?>">Rkb</a></li>
                      <li><a href="<?php echo e(url('/ktt/rkbPrint')); ?>">Print Rkb</a></li>
                      <?php elseif($_SESSION['section']=="PURCHASING"): ?>
                        <?php if($_SESSION['perusahaan']=='0'): ?>
                        <li><a href="<?php echo e(url('/logistic/rkb')); ?>">Rkb</a></li>
                        <li><a href="<?php echo e(url('/logistic/rkbPrint')); ?>">Print Rkb</a></li>
                        <?php else: ?>
                        <li><a href="<?php echo e(url('/mtk/rkb')); ?>">Rkb</a></li>
                        <li><a href="<?php echo e(url('/mtk/rkbPrint')); ?>">Print Rkb</a></li>
                        <?php endif; ?>
                      <?php elseif($_SESSION['level']=="administrator"): ?>
                      <li><a href="<?php echo e(url('/admin/rkb')); ?>">Rkb</a></li>
                      <?php if($_SESSION['department']=="hrga"): ?>
                      <li><a href="<?php echo e(url('/kabag/alldept/rkb')); ?>">Rkb All Dept</a></li>
                      <?php endif; ?>
                       <?php if($_SESSION['level']=="administrator"): ?>
                      <li><a href="<?php echo e(url('/admin/printRkb')); ?>">Print Rkb</a></li>
                      <?php else: ?>
                      <li><a href="<?php echo e(url('/printRkb')); ?>">Print Rkb</a></li>
                      <?php endif; ?>
                      <?php else: ?>

                      <?php if(in_array('gudang logistic',$arrRULE)): ?>
                      <li><a href="<?php echo e(url('/kabag/alldept/rkb')); ?>">Rkb All Dept</a></li>
                      <?php endif; ?>
                      <li><a href="<?php echo e(url('/v3/rkb')); ?>">Rkb</a></li>
                      <li><a href="<?php echo e(url('/printRkb')); ?>">Print Rkb</a></li>
                      <?php endif; ?>
                    </ul>
                  </li>
                  <?php if($_SESSION['section']=="IT" || $_SESSION['section']=="PURCHASING"): ?>
                  <li><a><i class="fa fa-desktop"></i>Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if($_SESSION['section']=="IT"): ?>
                      <li><a href="<?php echo e(url('/tulis/pesan')); ?>">Tulis Pesan</a></li>
                      <li><a href="<?php echo e(url('/dept')); ?>">Department</a></li>
                      <li><a href="<?php echo e(url('/sect')); ?>">Section</a></li>
                      <li><a href="<?php echo e(url('/user')); ?>">User</a></li>
                      <li><a href="<?php echo e(url('/manage/users')); ?>">Users</a></li>
                      <li><a href="<?php echo e(url('/level/user')); ?>">Level User</a></li>
                      <li><a href="<?php echo e(url('/rule/user')); ?>">Rule User</a></li>
                      <li><a href="<?php echo e(url('/data/karyawan/admin')); ?>">Data Karyawan</a></li>
                      <li><a href="<?php echo e(url('/import/abp/data/karyawan')); ?>">Form Data Karyawan</a></li>
                      <?php endif; ?>
                      <li><a href="<?php echo e(url('/satuan')); ?>">Satuan</a></li>
                    </ul>
                  </li>
                      <?php endif; ?>

<?php if(in_array('menu sarpras',$arrRULE)): ?>
<?php echo $__env->make('layout.sarana',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(in_array('menu inventory',$arrRULE)): ?>
                  <li><a><i class="fa fa-database"></i>Inventory <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
<?php if(in_array('mtk_master_item',$arrRULE)): ?>
                      <li><a href="<?php echo e(url('/inventory/master')); ?>">Master Item</a></li>
<?php endif; ?>
<?php if(in_array('admin inventory',$arrRULE)): ?>
                      <li><a href="<?php echo e(url('/admin/inventory/category')); ?>">Category</a></li>
                      <li><a href="<?php echo e(url('/admin/inventory/condition')); ?>">Condition</a></li>
                      <li><a href="<?php echo e(url('/admin/inventory/location')); ?>">Location</a></li>
                      <li><a href="<?php echo e(url('/admin/inventory/method')); ?>">Method</a></li>
                      <li><a href="<?php echo e(url('/inventory/suplier')); ?>">Vendor</a></li>
                      <li><a href="<?php echo e(url('/inventory/master')); ?>">Master Item</a></li>
                      <li><a href="<?php echo e(url('/inventory/stock')); ?>">Stock</a></li>
                      <li><a href="<?php echo e(url('/check/stock/out')); ?>">Stock Out</a></li>
                      <li><a href="<?php echo e(url('/satuan')); ?>">Satuan</a></li>
                      <li><a href="<?php echo e(url('/masteritem/request/detail/log')); ?>">Request Master Item</a></li>
<?php if(in_array('filter inventory',$arrRULE)): ?>
                      <li><a href="<?php echo e(url('/logistic/stock/adjust')); ?>">Adjust Stock</a></li> 
                      <?php endif; ?>
<?php endif; ?>
                   
<?php if(in_array('user inventory',$arrRULE)): ?>
                      <li><a href="<?php echo e(url('/inventory/user/stock')); ?>">Stock</a></li>
                      
<?php endif; ?>    
<?php if(in_array('req table inventory',$arrRULE)): ?>       
<li><a href="<?php echo e(url('/masteritem/request/detail')); ?>">Request Master Item</a></li>
<?php endif; ?>         
<?php if(in_array('dept inventory',$arrRULE)): ?>
                      <li><a href="<?php echo e(url('/inventory/user/stock')); ?>">Stock</a></li>        
<?php endif; ?>              
                    </ul>
                  </li>
                  <?php endif; ?> 
<?php else: ?>
  
                  <li>
                    <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a><ul class="nav child_menu">
                      <li><a href="<?php echo e(url('https://bit.ly/2VWCDfb')); ?>">Main Page</a></li>
                    </ul>
                  </li>
<?php endif; ?>
<!--bukan BOD-->                  
<?php if($_SESSION['department']!="mtk"): ?>
<li><a><i class="fa fa-table"></i>Monitoring <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
                  <li><a><i class="fa fa-table"></i>Produksi PT. ABP<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php echo $__env->make('layout.monitoring',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-table"></i>Produksi PT. MHU<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php echo $__env->make('layout.mrMHU',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i>Unit Rental<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php echo $__env->make('layout.mrRental',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </ul>
                  </li>
</ul>
</li>
<?php endif; ?>
<?php if(in_array('menu absen',$arrRULE)): ?>
<?php echo $__env->make('layout.absen',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(in_array('pesan informasi',$arrRULE)): ?>
<li><a href="<?php echo e(url('/tulis/pesan')); ?>"><i class="fa fa-paper-plane"></i>Kirim Informasi</a></li>
<?php endif; ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" class="pull-right" data-placement="top" title="Logout" href="<?php echo e(asset('/logout')); ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>