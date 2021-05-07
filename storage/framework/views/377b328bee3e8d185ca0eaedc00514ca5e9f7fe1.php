<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Surat Keluar | Sarana Prasarana</title>
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
    border: none;
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
Dengan Hormat, <br><br>
&nbsp;&nbsp;&nbsp;
Surat Keluar Sarana
<br>
<br>
<table>
	<thead>
		<tr>
			<th colspan="4" class="no_rkb">
			No Keluar : <?php echo e($sarpras->nomor); ?>

		</th>
		</tr>
		<tr>
			<th width="110">Keperluan  </th>
			<th width="5"> : </th>
			<th colspan=""><?php echo e($sarpras->keperluan); ?>  </th>
		</tr>
		<tr>
			<th colspan="">Pemohon  </th>
			<th colspan="">: </th>
			<th colspan=""> <?php echo e(ucwords($sarpras->nama_p)); ?> </th>
		</tr>
		<tr>
			<?php if($sarpras->no_lv=="motor" || $sarpras->no_lv=="mobil"): ?>
			<th colspan="">Jenis Kendaraan</th>
			<th colspan=""> : </th>
			<th colspan=""> <?php echo e(ucwords($sarpras->no_lv)); ?> <?php if($sarpras->no_pol): ?> (<?php echo e(ucwords($sarpras->no_pol)); ?>) <?php endif; ?></th>
			<?php else: ?>
			<th colspan="">No LV</th>
			<th colspan=""> : </th>
			<th colspan=""> <?php echo e($sarpras->no_lv); ?></th>
			<?php endif; ?>
			
		</tr>
		<tr class="">
			<?php if($sarpras->no_lv=="motor" || $sarpras->no_lv=="mobil"): ?>
			<th>Merk Kendaraan</th>
			<th colspan=""> : </th>
			<th colspan=""><?php echo e(ucwords($sarpras->driver)); ?></th>
			<?php else: ?>
			<th>Driver</th>
			<th colspan=""> : </th>
			<th colspan=""><?php echo e(ucwords($sarpras->nama_d)); ?></th>
			<?php endif; ?>
		</tr>
		<tr class="">
			<th>Tanggal Keluar</th>
			<th colspan=""> : </th>
			<th colspan=""><?php echo e(date("d F Y",strtotime($sarpras->tgl_out))); ?></th>
		</tr>
		<tr class="">
			<th>Jam Keluar</th>
			<th colspan=""> : </th>
			<th colspan=""><?php echo e(date("H:i:s",strtotime($sarpras->jam_out))); ?></th>
		</tr>
		<tr class="">
			<th>Tanggal Kembali</th>
			<th colspan=""> : </th>
			<th colspan=""><?php if(isset($sarpras->tgl_in)): ?><?php echo e(date("d F Y",strtotime($sarpras->tgl_in))); ?><?php else: ?> - <?php endif; ?></th>
		</tr>
		<tr class="">
			<th>Jam Kembali</th>
			<th colspan=""> : </th>
			<th colspan=""><?php if(isset($sarpras->jam_in)): ?><?php echo e(date("H:i:s",strtotime($sarpras->jam_in))); ?><?php else: ?> - <?php endif; ?></th>
		</tr>
		<tr class="">
			<th>Penumpang</th>
			<th colspan=""> : </th>
			<th colspan="">
				<?php 
				$penum = explode(",",$sarpras->penumpang_out);
				foreach($penum as $k => $v){
				$r = Illuminate\Support\Facades\DB::table("db_karyawan.data_karyawan")->where("nik",$v)->first();
				 ?>
				<?php if(count($penum)>1): ?>
				<?php echo e(ucwords($r->nama)." , "); ?>

				<?php else: ?>
				<?php echo e(ucwords($r->nama)); ?>

				<?php endif; ?>
				<?php  }  ?>
			</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<br><br>
Silahkan <a href="<?php echo e($urlPDF); ?>">Klik Disini</a> atau <a href="<?php echo e($urlPDF); ?>"><?php echo e($urlPDF); ?></a> untuk melihat dokumen yang sudah di approve
<br>
<br>
--<br>
<font color="blue"><b>Automatic send by sistem.</b></font>
<br>
By System Abp~System<br>
<a href="<?php echo e(url('/')); ?>" style="text-decoration: none;color: #000;font-weight: bolder;">Abpjobsite.com</a><br>
</body>
</html>