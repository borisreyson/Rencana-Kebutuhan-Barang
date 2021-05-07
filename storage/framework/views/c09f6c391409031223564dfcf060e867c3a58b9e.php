<!DOCTYPE html>
<html>
<head>
	<title>Surat Keluar Sarana</title>
	<style>
		.pull-right{
			position: absolute;
			top: 20;
			right: 0;
			line-height: line-height: 10px	!important;
			font-size: 12px;
			width: 175px;
		}
		table tbody tr,table tbody tr td{
		line-height: line-height: 3px!important;
		padding: 5px;
		font-size: 12px;
		}
	</style>
</head>
<body>
	<div style="width: 100%!important;text-align: center;padding-top: 0!important;margin-top: 0!important;text-decoration: underline;">
		<h3>Surat Keluar Sarana</h3>
	</div>

	<div class="pull-right" style="font-weight: bolder;">Tanggal , <?php echo e(date("d F Y",strtotime($konten->tgl_out))); ?></div>
<table style="border:none!important;">
	<tr>
		<td>
			<b>No</b>
		</td>
		<td>
			<b>:</b>
		</td>
		<td>
			<?php echo e($konten->nomor); ?>

		</td>
	</tr>
	<tr>
		<td>Keperluan</td>
		<td>:</td>
		<td><?php echo e(ucwords(strtolower($konten->keperluan))); ?></td>
	</tr>
	<tr>
		<td>Pemohon</td>
		<td>:</td>
		<td><?php echo e(ucwords(strtolower($konten->nama_p))); ?></td>
	</tr>
	<tr>
		<?php if($konten->no_lv=="motor" || $konten->no_lv=="mobil"): ?>
		<td>Jenis Kendaraan</td>
		<td>:</td>
		<td><?php echo e(ucwords($konten->no_lv)); ?> <?php if($konten->no_pol!=null): ?> <?php echo e($konten->no_pol); ?> <?php endif; ?></td>
		<?php else: ?>
		<td>No LV</td>
		<td>:</td>
		<td><?php echo e($konten->no_lv); ?></td>
		<?php endif; ?>
	</tr>
	<?php if($konten->no_lv=="motor" || $konten->no_lv=="mobil"): ?>
	<tr>
		<td>Merk Kendaraan</td>
		<td>:</td>
		<td><?php echo e(ucwords(($konten->driver))); ?></td>
	</tr>
	<?php else: ?>
	<tr>
		<td>Driver</td>
		<td>:</td>
		<td><?php echo e(ucwords(strtolower($konten->nama_d))); ?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td width="100px">Tanggal Keluar</td>
		<td>:</td>
		<td><?php echo e(date("d F Y",strtotime($konten->tgl_out))); ?></td>
	</tr>
	<tr>
		<td>Jam Keluar</td>
		<td>:</td>
		<td><?php echo e(date("H:i:s",strtotime($konten->jam_out))); ?></td>
	</tr>
	<tr>
		<td>Tanggal Kembali</td>
		<td>:</td>
		<td><?php if(isset($konten->tgl_in)): ?><?php echo e(date("d F Y",strtotime($konten->tgl_in))); ?><?php else: ?> - <?php endif; ?></td>
	</tr>
	<tr>
		<td>Jam Kembali</td>
		<td>:</td>
		<td><?php if(isset($konten->jam_in)): ?><?php echo e(date("H:i:s",strtotime($konten->jam_in))); ?><?php else: ?> - <?php endif; ?></td>
	</tr>
	<tr>
		<td>Penumpang</td>
		<td>:</td>
		<td>
			<?php 
			$penum = explode(",",$konten->penumpang_out);
			 ?>
			<?php $__currentLoopData = $penum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $vv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php 
			$n_penum = Illuminate\Support\Facades\DB::table("db_karyawan.data_karyawan")->where("nik",$vv)->first();
			 ?>
			<?php echo e(ucwords(strtolower($n_penum->nama))); ?>,
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</td>
	</tr>
</table>
</body>
</html>