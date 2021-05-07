<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>RKB SYSTEM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
.top_header{
	text-align: center;
	padding-left: 120px;
	height: 90px;
}
.top_header img{
	position: absolute;
	top: 10;
	left: 25px;
}
	table, td, th {    
    border: 2px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}
.no_rkb{
	background-color: #333;
	color: #f8f8f8;
}
.header th{
	background-color: rgba(0,0,0,0.1);
	color: #333;
}
th, td {
    padding: 10px;
}
</style>

</head>
<body>
Dear KTT, <br><br>
&nbsp;&nbsp;&nbsp;
Berikut detail data RKB System Tanggal <?php echo e(date("d F Y", strtotime($rkb[0]->timelog))); ?>

<br>
<br>
<?php if(count($rkb)>0): ?>
<table>
	<thead>
		<tr>
			<th colspan="4" class="no_rkb">
			<?php echo e($no_rkb); ?>

		</th>
		</tr>
		<tr>
			<th colspan="4">User Created : <?php echo e(ucfirst($rkb[0]->nama_lengkap)); ?></th>
		</tr>
		<tr>
			<th colspan="4">Section : <?php echo e(ucfirst($rkb[0]->section)); ?></th>
		</tr>
		<tr>
			<th colspan="4">Department : <?php echo e(ucfirst($rkb[0]->department)); ?></th>
		</tr>
		<tr class="header">
			<th>Part Name</th>
			<th>Part Number</th>
			<th>Quantity</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $rkb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($v->part_name); ?></td>
			<td><?php echo e($v->part_number); ?></td>
			<td><?php echo e($v->quantity); ?> <?php echo e($v->satuan); ?></td>
			<td><?php echo e($v->remarks); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>

<?php endif; ?>
<br><br>
Silahkan untuk meriview dan kemudian melakukan approve
<br>
<br>
--<br>
<font color="blue"><b>Automatic send by sistem.</b></font>
<br>
By System e-RKB<br>
<a href="<?php echo e(url('/')); ?>" style="text-decoration: none;color: #000;font-weight: bolder;">abpjobsite.com</a><br>
</body>
</html>