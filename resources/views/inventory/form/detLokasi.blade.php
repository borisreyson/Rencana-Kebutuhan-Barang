<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/font_awesome/css/font-awesome.min.css')}}">
<style>
	#tableSaya{
		margin-bottom: 60px;
	}
	#box_btn{
		position: fixed;
		bottom: 0;
		right: 0;
		left: 0;
		height: 40px;
		background-color: #333;
		border:1px solid #333;
		display: flex;
	}
	#kirimkan:hover{
		background-color: #E8FFC7;
	}
	#kirimkan:active{
		background-color: #E8DFB5;
	}
	#kirimkan{
		position: absolute;
		right: 20;
		top :5;
		height: 30px;
		width: 70px;
		background-color: #f8f8f8;
		color: #333;
		border:0;
		font-weight: bold;
	}
	.cari-group{
		width: 100%;
		position: relative;
	}
	.btn-times{
		margin: 0px;
		padding: 0px;
		background-color: transparent;
		position: absolute;
		top: 0;
		right: 0;
		border:0;
		bottom: 0;
		width: 30px;
		z-index: 999;
	}
</style>
	<form method="get" action="">
<div class="col-12">
		<table class="table-bordered" width="100%">
			<tr>
				<td style="text-align: right;padding-right: 10px;">Cari</td>
				<td>
					<div class="cari-group">
				@if(isset($_GET['cari']))
				<input type="text" class="form-control" name="cari" value="{{$_GET['cari']}}">
				@if($_GET['cari']!="")
				<button type="button" name="btnClear"  class="btn-times">x</button>
				@endif
				@else
				<input type="text" class="form-control" name="cari" value="">
				@endif
					</div>
				</td>
				<td><input type="submit" name="kirim" class="btn btn-primary" value="Cari"></td>
			</tr>
		</table>
</div>
	</form>
<table id="tableSaya" class="table-bordered table" width="100%">
	<thead>
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">Kode Lokasi</th>
			<th class="text-center">Keterangan</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($detail as $k => $v){ ?>

		<tr>
			<td><button class="btn btn-xs btn-default" name="dipilih">
				<i class="fa fa-check"></i>
			</button></td>
			<input type="hidden" name="kode_lokasi" value="{{($v->code_loc)}}">
			<td>{{$v->code_loc}}</td>
			<td>{{$v->location}}</td>
		</tr>
<?php } ?>
</tbody>
</table>

<div id="box_btn">
<button id="kirimkan" name="kirimkan" onclick="window.close()">Close</button>

</div>
<script src="{{asset('js/app.js')}}"></script>
<script>
	$("button[name=btnClear]").click(function(){
		$("button[name=btnClear]").remove();
		window.location = document.location.href.split('?')[0];
	});

	$("button[name=dipilih]").click(function() {
		eq = $("button[name=dipilih]").index(this);
		kode_lokasi = $("input[name=kode_lokasi]").eq(eq).val();
		parentData = window.opener.setLokasi(kode_lokasi,"{{$eq}}");
		window.close();
	})
</script>