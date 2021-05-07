@extends('layout.master')
@section('title')
ABP-system | HSE - Hazard Report
@endsection
@section('css')
    <!-- bootstrap-wysiwyg -->
 @include('layout.css')
    <link href="{{asset('/vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
<style>
.ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;height: 100px;

            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            }  

.ck-editor__editable {
    min-height: 90px;
}
.nowrap{
  white-space: nowrap;
}
</style>
@endsection
@section('content')
<body class="nav-md">
<div class="container body">
<div class="main_container">
@include('layout.nav',["getUser"=>$getUser])
@include('layout.top',["getUser"=>$getUser])

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Hazard Report</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">
      <div class="btn-group">
        <form method="get" class="col-xs-11 input-group">
      <span class="input-group-addon">
        Dari
      </span>
      <input type="text" class="form-control" value="{{$_GET['dari'] or date('d F Y')}}" name="dari" id="dari" placeholder="Dari Tanggal" aria-label="Dari Tanggal" aria-describedby="basic-addon1">
     <span class="input-group-addon">
        Sampai
      </span>
      <input type="text" class="form-control" id="sampai" value="{{$_GET['sampai'] or date('d F Y')}}" name="sampai" placeholder="Sampai Tanggal" aria-label="Sampai Tanggal" aria-describedby="basic-addon1">
     <span class="input-group-btn">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{url('/hse/admin/hazard/report')}}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
        @if(count($hazard)>0)
        @if(isset($_GET['dari']))
        <a href="{{url('/hse/admin/hazard/report/export/all?dari='.$_GET['dari'].'&sampai='.$_GET['sampai'])}}" class="btn btn-danger">Export To Excel</a>
        @else
        <a href="{{url('/hse/admin/hazard/report/export/all')}}" class="btn btn-danger">Export To Excel</a>
        @endif
        @endif
      </span>
    </form>
</div>
 </div>
  <div class="row col-lg-12">
    <div class="table-responsive" style="width: 100%!important;">
<table class="table table-striped table-bordered" style="width: 100%!important;">
  <thead>
    <tr class="bg-primary">
      <th class="text-center nowrap" style="vertical-align: middle;">No</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Bukti Temuan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Tanggal Temuan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Jam Temuan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Kondisi</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Perusahaan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Lokasi</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Detail Lokasi</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Deskripsi Temuan</th>
      <th colspan="2" class="text-center" style="vertical-align: middle;">Penanggung Jawab</th>
      <th class="text-center" style="vertical-align: middle;">Foto</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Hirarki Pengendalian</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Tindakan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Status Perbaikan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Tanggal Selesai</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Jam Selesai</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Bukti Perbaikan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Keterangan Perbaikan</th>
      <th class="text-center nowrap" style="vertical-align: middle;" colspan="2">Nilai Kemungkinan / Nilai Keparahan</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Tingkat Resiko</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Status</th>
      <th class="text-center nowrap" style="vertical-align: middle;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @if(count($hazard)>0)
    @if(isset($_GET['page']))
    @php $z = $_GET['page']*count($hazard); @endphp
    @else
    @php $z = 1; @endphp
    @endif
    @foreach($hazard as $k => $v)
    <tr>
      @if($v->user_valid!=null)
      <td style="vertical-align: middle;text-align: center;background-color:#4CAF50;color:#FFFFFF;">{{$z}}</td>
      @else
      <td style="vertical-align: middle;text-align: center;background-color:#F44336;color:#FFFFFF;">{{$z}}</td>
      @endif
      <td style="vertical-align: middle;">
        <a class="img-responsive img-thumbnail" href="{{asset('/bukti_hazard/'.$v->bukti)}}" target="_blank">
          <img style="object-fit:contain; width:100px; height:100px;" src="{{asset('/bukti_hazard/'.$v->bukti)}}" >
      </a>
      </td>
      <td class="text-center" style="vertical-align: middle;">{{date("d F Y",strtotime($v->tgl_hazard))}}</td>
      <td class="text-center" style="vertical-align: middle;">{{date("H:i:s",strtotime($v->jam_hazard))}}</td>
      <td class="text-center nowrap" style="vertical-align: middle;">{{$v->katBahaya}}</td>
      <td class="text-center" style="vertical-align: middle;">{{strtoupper($v->perusahaan)}}</td>
      <td class="text-center" style="vertical-align: middle;">{{ucwords($v->lokasiHazard)}}</td>
      <td class="text-center" style="vertical-align: middle;">{{ucfirst($v->lokasi_detail)}}</td>
      <td class="text-center" style="vertical-align: middle;">{{ucwords($v->deskripsi)}}</td>
      <td class="text-center" style="vertical-align: middle;">{{ucwords($v->namaPJ)}}</td>
      <td class="text-center" style="vertical-align: middle;">{{ucwords($v->nikPJ)}}</td>
      <td class="text-center" style="vertical-align: middle;" width="100">
        <a class="img-responsive img-thumbnail" href="{{asset('/bukti_hazard/penanggung_jawab/'.$v->fotoPJ)}}" target="_blank">
          <img style="object-fit:contain; object-fit: contain; width: 100px!important;height: 100px!important;" src="{{asset('/bukti_hazard/penanggung_jawab/'.$v->fotoPJ)}}">
        </a>
      </td>
      <td class="text-center" style="vertical-align: middle;">{{ucwords($v->namaPengendalian)}}</td>
      <td class="text-center" style="vertical-align: middle;">{{ucwords($v->tindakan)}}</td>
      @if($v->status_perbaikan=="SELESAI")
      <td class="text-center nowrap" style="vertical-align: middle;background-color:#4CAF50; color: #FFFFFF;">{{$v->status_perbaikan}}</td>
      @elseif($v->status_perbaikan=="BELUM SELESAI")
      <td class="text-center nowrap" style="vertical-align: middle; background-color:#F44336; color: #FFFFFF;">{{$v->status_perbaikan}}</td>
      @elseif($v->status_perbaikan=="BERLANJUT")
      <td class="text-center nowrap" style="vertical-align: middle; background-color:#2196F3; color: #FFFFFF;">{{$v->status_perbaikan}}</td>
      @endif
      
      <td class="text-center" style="vertical-align: middle;">@if($v->tgl_selesai!=null){{date("d F Y",strtotime($v->tgl_selesai))}}@else - @endif</td>
      <td class="text-center" style="vertical-align: middle;">@if($v->jam_selesai!=null){{date("H:i:s",strtotime($v->jam_selesai))}}@else - @endif</td>
      <td style="vertical-align: middle;text-align: center;">
        @if($v->update_bukti!=null)
        <a href="{{asset('/bukti_hazard/update/'.$v->bukti)}}" target="_blank">
          <img class="img-responsive img-thumbnail" style="object-fit:contain; width:100px; height:100px; border: solid 1px #CCC" src="{{asset('/bukti_hazard/update/'.$v->update_bukti)}}" width="100">
        </a>
        @else
        -
        @endif
      </td>
      <td style="vertical-align: middle;text-align: center;">{{$v->keterangan_update or "-"}}</td>
      <?php
          $hasil = $v->nilaiKemungkinan*$v->nilaiKeparahan;
          $hsResiko = Illuminate\Support\Facades\DB::table("hse.metrik_resiko")->where("max",">=",$hasil)->where("min","<=",$hasil)->first();

      ?>
      <td style="vertical-align: middle;text-align: center;">{{$v->kemungkinan}}</td>
      <td style="vertical-align: middle;text-align: center;">{{$v->keparahan}}</td>
      <td class="text-center nowrap" style="vertical-align: middle;background-color:{{$hsResiko->bgColor}}; color: {{$hsResiko->txtColor}};"><b>{{$hsResiko->kodeBahaya}}</b><br><font style="font-style: italic;">{{$hsResiko->kategori}}</font><br>{{$hsResiko->tindakan}}</td>
      @if($v->user_valid!=null)
      <td class="nowrap text-center" style="vertical-align: middle;text-align: center;"><label class="btn btn-xs btn-success text-center">Di Verifikasi</label></td>
      @else
      <td class="nowrap text-center" style="vertical-align: middle;text-align: center;"><label class="btn btn-xs btn-danger text-center">Belum Di Verifikasi</label></td>
      @endif
      <td style="vertical-align: middle;">
      @if($v->user_valid==null)
        <a href="{{url('/hse/admin/hazard/report/verifikasi?uid='.bin2hex($v->uid))}}" class="btn btn-xs btn-primary">Verifikasi <i class="fa fa-check"></i></a>
      @endif
      </td>
    </tr>
    @php
      $z++;
    @endphp
    @endforeach
    <tr class="info">
      <td colspan="40">
       <b>Total Record : {{count($hazard)}}</b>
      </td>
    </tr>
    @else
    <tr>
      <td colspan="40" class="text-center">Not Have Record</td>
    </tr>
    @endif
  </tbody>
</table></div>

<div class="col-lg-12 text-center">
    {{$hazard->links()}}
</div>
</div>
                </div>
              </div>
            </div>
</div>
</div>
@include('layout.footer')
</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
<div id="konten_modal"></div>
  </div>
</div>
@endsection

@section('js')
<!-- Datatables -->
    <!-- FastClick -->
@include('layout.js')
    <script src="{{asset('/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
    <script src="{{asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
    <script src="{{asset('/vendors/google-code-prettify/src/prettify.js')}}"></script>
    <script>
      $("input[name=dari]").datepicker({ dateFormat: 'dd MM yy' });
      $("input[name=sampai]").datepicker({ dateFormat: 'dd MM yy' });
    </script>
@if(session('success'))
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Success',
          text: "{{session('success')}}",
          type: 'success',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
@endif
@if(session('failed'))
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Failed',
          text: "{{session('failed')}}",
          type: 'error',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
@endif
@endsection