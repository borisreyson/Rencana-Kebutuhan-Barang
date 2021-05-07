
<!DOCTYPE html>
<html>
<head>
  <title></title>
<style>
  tbody tr td{
    text-align: center;
  }
  div{
    margin: 15px;
  }
</style>
</head>
<body>
<div class="table-responsive" >
                      <table id="datatables" border="1" cellpadding="5" cellspacing="0" class="table table-striped  table-bordered ">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Nomor Rkb </th>
                            <th class="column-title">Department - Section </th>
                            <th class="column-title">Tanggal Rkb </th>
                            <th class="column-title">Ka. Bag. </th>
                            <th class="column-title">KTT </th>
                            <th class="column-title">Cancel Remark </th>
                            <th class="column-title">Part Name </th>
                            <th class="column-title">Part Number </th>
                            <th class="column-title">Quantity</th>
                            <th class="column-title">Remarks</th>
                            <th class="column-title">Cancel Remark </th>
                            <th class="column-title">Status</th>
                            <th class="column-title">NPO</th>
                          </tr>
                        </thead>

                        <tbody>

<?php if(count($rkb)>0): ?>
<?php $__currentLoopData = $rkb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="even pointer" >
                            <td class=" "  style="text-align: left!important;"><?php echo e($value->no_rkb); ?>

                              <?php if(!($value->cancel_section=="KABAG" || $value->cancel_section=="KTT" || $value->cancel_section==null)): ?>
                              <label class="label label-danger" style="float: right!important;cursor: pointer;cursor: hand;" data-toggle="tooltip" title="Remarks : <?php echo e($value->remark_cancel); ?>">Cancel By <?php echo e($value->cancel_user); ?> </label>
                              <?php endif; ?>
                            </td>
                            <td class=" "><?php echo e($value->dept); ?> - <?php echo e($value->det_sect); ?></td>
                            <td class=" ">
                              <?php echo e(date("d F Y",strtotime($value->tgl_order))); ?> 
                            </td>
                            <td class=" ">
                              <?php 
  $status = Illuminate\Support\Facades\DB::table('e_rkb_cancel')
            ->where([
            ["no_rkb" , $value->no_rkb],
            ['part_name',$value->part_name]
            ])->first();

 ?>
<?php if($status==null): ?>
                              <?php if($value->disetujui==0): ?>
                              <?php if($_SESSION['section']=="KABAG"): ?>

                              <?php if($value->cancel_user==null): ?>
                              <a href="<?php echo e(asset('/approve/rkb/'.bin2hex($value->no_rkb))); ?>" id="approve_rkb" class="btn btn-success btn-xs" >Approve Rkb</a>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KABAG"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php else: ?>
                              <?php if($value->cancel_user==null): ?>
                              <label class="label label-warning">Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KABAG"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php elseif($value->disetujui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s ,d F Y",strtotime($value->tgl_disetujui))); ?></label>
                              <?php elseif($value->disetujui==2): ?>
                              Cancel
                              <?php endif; ?>
                              <?php endif; ?>
                            </td>
                            <td class=" ">
                               <?php 
  $status = Illuminate\Support\Facades\DB::table('e_rkb_cancel')
            ->where([
            ["no_rkb" , $value->no_rkb],
            ['part_name',$value->part_name]
            ])->first();

 ?>
<?php if($status==null): ?>
                              <?php if($value->diketahui==0): ?>
                              <?php if($_SESSION['section']=="KTT"): ?>
                              <?php if($value->cancel_user==null): ?>
                              <a  no-rkb="<?php echo e(bin2hex($value->no_rkb)); ?>" id="approve_rkb" class="btn btn-success btn-xs" <?php if(!$value->disetujui>0){?> href="#" onclick="return false;" disabled="disabled" <?php }else{?> href="<?php echo e(asset('/approve/rkb/ktt/'.bin2hex($value->no_rkb))); ?>" <?php } ?>  >Approve Rkb</a>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KTT"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php else: ?>
                              <?php if($value->cancel_user==null): ?>
                              <label class="label label-warning"> Waiting</label>
                              <?php else: ?>
                              <?php if($value->cancel_section=="KTT"): ?>
                              <label class="label label-danger" style="cursor: pointer;cursor: hand;" title="Remarks: <?php echo e($value->remark_cancel); ?>" data-toggle="tooltip">Cancel By <?php echo e($value->cancel_user); ?></label>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php elseif($value->diketahui==1): ?>
                              <label class="label label-success"><?php echo e(date("H:i:s ,d F Y",strtotime($value->tgl_diketahui))); ?></label>
                              <?php elseif($value->diketahui==2): ?>
                              Cancel
                              <?php endif; ?>
                              
                              <?php endif; ?>

                            </td>

                            <td><?php echo e($value->part_name); ?></td>
                            <td><?php echo e($value->part_number); ?></td>
                            <td><?php echo e($value->quantity); ?> <?php echo e($value->satuan); ?></td>
                            <td><?php echo e(isset($value->remarks) ? $value->remarks : $value->status); ?></td>
                            <td><?php echo e($value->remark_cancel); ?></td>
                            <td>
<?php 
  $status = Illuminate\Support\Facades\DB::table('e_rkb_cancel')
            ->where([
            ["no_rkb" , $value->no_rkb],
            ['part_name',$value->part_name]
            ])->first();
  if($status!=null){
  echo "Cancel By ".strtoupper($status->cancel_by)." Remarks : ".$status->remarks;
}
 ?>

                            </td>
                            <td>
                              <?php echo e($value->no_po); ?>

                            </td>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php else: ?>
            <tr class="odd pointer">
                            <td class="a-center" align="center"  colspan="11">
                              Not have recored yet!
                            </td>
                         </tr>
<?php endif; ?>
                        </tbody>
                      </table>
                      </div>
                  <script>window.print();
                window.close();</script>
</body>
</html>
                    