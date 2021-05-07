<?php

namespace App\Http\Controllers\hse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \App\Events\onlineUserEvent;
use Response;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class hseController extends Controller
{
    private $user;
    public function __construct()
    {
        session_start();
        if(!isset($_SESSION['username'])) return redirect('/');
        $this->user = DB::table('user_login')->where('username',$_SESSION['username'])->first();
    }
    // HAZARD
    public function hazardReport(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');

        $sql = DB::table("hse.hazard_report_header as s")
->leftJoin("hse.hazard_report_detail as a","a.uid","s.uid")
->leftJoin("hse.lokasi as b","b.idLok","s.lokasi")
->leftJoin("hse.hazard_report_validation as c","c.uid","s.uid")
->leftjoin("hse.metrik_resiko_kemungkinan as d","d.idKemungkinan","s.idKemungkinan")   
->leftjoin("hse.metrik_resiko_keparahan as e","e.idKeparahan","s.idKeparahan")
->leftjoin("hse.hirarki_pengendalian as f","f.idHirarki","a.idPengendalian")
->leftjoin("hse.metrik_resiko_kemungkinan as g","g.idKemungkinan","a.idKemungkinanSesudah")   
->leftjoin("hse.metrik_resiko_keparahan as h","h.idKeparahan","a.idKeparahanSesudah")
->select("s.*","a.*","c.*","b.lokasi as lokasiHazard","d.*","d.nilai as nilaiKemungkinan","e.*","e.nilai as nilaiKeparahan","f.*","g.nilai as nilaiKemungkinanSesudah","e.*","h.nilai as nilaiKeparahanSesudah")
->orderBy("s.idHazard","DESC");
        if(isset($request->dari)){
            $filter = $sql->whereBetween("s.tgl_hazard",
                            [date("Y-m-d",strtotime($request->dari))
                            ,date("Y-m-d",strtotime($request->sampai))]);
        }else{
            $filter = $sql;
        }
		$hazard = $filter->paginate(10);
        return view('hse.hazard',["hazard"=>$hazard,"getUser"=>$this->user]);
    }
    public function hazardReportVerifikasi(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
    	$uid= hex2bin($request->uid);
    	$validator = DB::table("hse.hazard_report_validation")
    				->where("uid",$uid)
    				->update([
    					"user_valid"=>$_SESSION['username'],
    					"tgl_valid"=>date("Y-m-d"),
    					"jam_valid"=>date("H:i:s")
    				]);
    	if($validator>=0){
    		return redirect()->back()->with("success","Berhasil Verifikasi");
    	}else{
    		return redirect()->back()->with("failed","Verifikasi Tidak Berhasil");

    	}
    }
    public function exportHazardReport(Request $request)
    {
        $files = glob('export/*');
        foreach($files as $file){
            if(is_file($file)){
                unlink($file);
            }
                }
        $path = $_SERVER['DOCUMENT_ROOT']."/bukti_hazard/";
        $path1 = $_SERVER['DOCUMENT_ROOT']."/bukti_hazard/penanggung_jawab/";
        $path2 = $_SERVER['DOCUMENT_ROOT']."/bukti_hazard/update/";
        $abc=range("A","Z");
        
        // die();
        $sql = DB::table("hse.hazard_report_header as s")
        ->leftJoin("hse.hazard_report_detail as a","a.uid","s.uid")
        ->leftJoin("hse.lokasi as b","b.idLok","s.lokasi")
        ->leftJoin("hse.hazard_report_validation as c","c.uid","s.uid")
        ->leftjoin("hse.metrik_resiko_kemungkinan as d","d.idKemungkinan","s.idKemungkinan")   
        ->leftjoin("hse.metrik_resiko_keparahan as e","e.idKeparahan","s.idKeparahan")
        ->leftjoin("hse.hirarki_pengendalian as f","f.idHirarki","a.idPengendalian")
        ->select("s.*","a.*","c.*","b.lokasi as lokasiHazard","d.*","d.nilai as nilaiKemungkinan","e.*","e.nilai as nilaiKeparahan","f.*")
        ->orderBy("s.idHazard","DESC");
        if(isset($request->dari)){
            $filter = $sql->whereBetween("s.tgl_hazard",
                            [date("Y-m-d",strtotime($request->dari))
                            ,date("Y-m-d",strtotime($request->sampai))]);
        $filename = "export/Hazard Report ".$request->dari."-".$request->sampai.".xlsx";
        }else{
            $filter = $sql;
            $filename = "export/All Hazard Report.xlsx";
        }
        $hazard = $filter->get();
        $z=2;
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing1 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator("IT ABP ENERGY");
        $spreadsheet->getProperties()->setLastModifiedBy("SYSTEM ABP ENERGY");
        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(65);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A:Z')
                ->getAlignment()
                ->setHorizontal('center')
                ->setVertical('center');
        $sheet
        ->getStyle('A1:W1')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('071A40');
        $sheet->getStyle('A1:W1')->getFont()->getColor()->setARGB("FFFFFF");
        $sheet->getStyle('A1:W1')
                ->getAlignment()
                ->setWrapText(true);
        $sheet->setTitle("jam Kerja");
        foreach ($abc as $key => $value) {
            $sheet->getColumnDimension($value)->setAutoSize(true);
        }
        $sheet->setCellValue('A1', strtoupper('No'));
        $sheet->setCellValue('B1', strtoupper('Bukti Temuan'));
        $sheet->setCellValue('C1', strtoupper('Tanggal Temuan'));
        $sheet->setCellValue('D1', strtoupper('Jam Temuan'));
        $sheet->setCellValue('E1', strtoupper('Kondisi'));
        $sheet->setCellValue('F1', strtoupper('Perusahaan'));
        $sheet->setCellValue('G1', strtoupper('Lokasi'));
        $sheet->setCellValue('H1', strtoupper('Detail Lokasi'));
        $sheet->setCellValue('I1', strtoupper('Deskripsi Temuan'));
        $sheet->setCellValue('J1', strtoupper('Nama Penanggung Jawab'));
        $sheet->setCellValue('K1', strtoupper('Nik Penanggung Jawab'));
        $sheet->setCellValue('L1', strtoupper('Foto Penanggung Jawab'));
        $sheet->setCellValue('M1', strtoupper('Hiaraki Pengendalian'));
        $sheet->setCellValue('N1', strtoupper('Tindakan'));
        $sheet->setCellValue('O1', strtoupper('Status Perbaikan'));
        $sheet->setCellValue('P1', strtoupper('Tanggal Selesai'));
        $sheet->setCellValue('Q1', strtoupper('Jam Selesai'));
        $sheet->setCellValue('R1', strtoupper('Bukti Perbaikan'));
        $sheet->setCellValue('S1', strtoupper('Keterangan Perbaikan'));
        $sheet->setCellValue('T1', strtoupper('Nilai Kemungkinan'));
        $sheet->setCellValue('U1', strtoupper('Nilai Keparahan'));
        $sheet->setCellValue('V1', strtoupper('Tingkat Resiko'));
        $sheet->setCellValue('W1', strtoupper('Status'));
        foreach($hazard as $k => $v){
        $sheet->setCellValue('A'.$z, ($z-1));
        $drawing->setPath($path.$v->bukti);
        $drawing->setCoordinates('B'.$z);
        $drawing->setHeight(70);
        $drawing->getShadow()->setVisible(true);
        $drawing->getShadow()->setDirection(50);
        $drawing->setOffsetX(35);
        $drawing->setOffsetY(6);
        // $sheet->setCellValue('B'.$z, $v->bukti);
        $sheet->setCellValue('C'.$z, date("d F Y",strtotime($v->tgl_hazard)));
        $sheet->setCellValue('D'.$z, date("H:i:s",strtotime($v->jam_hazard)));
        $sheet->setCellValue('E'.$z, $v->katBahaya);
        $sheet->setCellValue('F'.$z, $v->perusahaan);
        $sheet->setCellValue('G'.$z, $v->lokasiHazard);
        $sheet->setCellValue('H'.$z, $v->lokasi_detail);
        $sheet->setCellValue('I'.$z, $v->deskripsi);
        $sheet->setCellValue('J'.$z, $v->namaPJ);
        $sheet->setCellValue('K'.$z, $v->nikPJ);
        // $sheet->setCellValue('L'.$z, $v->fotoPJ);
        if($v->fotoPJ!=null){
        $drawing1->setPath($path1.$v->fotoPJ);
            $drawing1->setCoordinates('L'.$z);
            $drawing1->setHeight(70);
            $drawing1->getShadow()->setVisible(true);
            $drawing1->getShadow()->setDirection(50);
            $drawing1->setOffsetX(75);
            $drawing1->setOffsetY(6);    
        }else{
        $sheet->setCellValue('L'.$z, "-");

        }
        
        $sheet->setCellValue('M'.$z, $v->namaPengendalian);
        $sheet->setCellValue('N'.$z, $v->tindakan);
        $sheet->getStyle("O".$z)->getFont()->getColor()->setARGB("FFFFFF");
        if($v->status_perbaikan=="SELESAI"){
            $sheet
                ->getStyle("O".$z)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('009C5E');
            $sheet->setCellValue('O'.$z, $v->status_perbaikan);
        }else if($v->status_perbaikan=="BELUM SELESAI"){
            $sheet
                ->getStyle("O".$z)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('BF0A0A');
            $sheet->setCellValue('O'.$z, $v->status_perbaikan);
        }else if($v->status_perbaikan=="BERLANJUT"){
            $sheet
                ->getStyle("O".$z)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('0D518C');
            $sheet->setCellValue('O'.$z, $v->status_perbaikan);
        }else if($v->status_perbaikan=="Dalam Pengerjaan"){
            $sheet
                ->getStyle("O".$z)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('8D7E3E');
            $sheet->setCellValue('O'.$z, $v->status_perbaikan);
        }

        if($v->tgl_selesai!=null){
            $sheet->setCellValue('P'.$z, date("d F Y",strtotime($v->tgl_selesai)));
        }else{
            $sheet->setCellValue('P'.$z, "-");
        }
        if($v->jam_selesai!=null){
            $sheet->setCellValue('Q'.$z, date("H:i:s",strtotime($v->jam_selesai)));
        }else{
            $sheet->setCellValue('Q'.$z, "-");
        }
        if($v->update_bukti!=null){
            // $sheet->setCellValue('R'.$z, $v->update_bukti);
            $drawing2->setPath($path2.$v->update_bukti);
            $drawing2->setCoordinates('R'.$z);
            $drawing2->setHeight(70);
            $drawing2->getShadow()->setVisible(true);
            $drawing2->getShadow()->setDirection(50);
            $drawing2->setOffsetX(75);
            $drawing2->setOffsetY(6);
            $drawing2->setWorksheet($spreadsheet->getActiveSheet());

        }else{
            $sheet->setCellValue('R'.$z, "-");
        }
        if($v->keterangan_update!=null){
        $sheet->setCellValue('S'.$z, $v->keterangan_update);
        }else{
        $sheet->setCellValue('S'.$z, "-");
        }
        $sheet->setCellValue('T'.$z, $v->kemungkinan." \n | ".$v->nilaiKemungkinan);
        $sheet->getStyle('T'.$z)
                ->getAlignment()
                ->setWrapText(true);

        $sheet->setCellValue('U'.$z, $v->keparahan." \n | ".$v->nilaiKeparahan);
        $sheet->getStyle('V'.$z)
                ->getAlignment()
                ->setWrapText(true);

        $hasil = $v->nilaiKemungkinan*$v->nilaiKeparahan;
        $hsResiko = DB::table("hse.metrik_resiko")->where("max",">=",$hasil)->where("min","<=",$hasil)->first();

        $txtColor = explode("#",$hsResiko->txtColor);
        $bg = explode("#",$hsResiko->bgColor);
        $sheet->getStyle("V".$z)->getFont()->getColor()->setARGB($txtColor[1]);
        $sheet->getStyle("V".$z)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB($bg[1]);
        $sheet->setCellValue('V'.$z,$hsResiko->kodeBahaya." \n ".$hsResiko->kategori." \n ".$hsResiko->tindakan);
        $sheet->getStyle('V'.$z)
                ->getAlignment()
                ->setWrapText(true);
        if($v->user_valid!=null){
            $sheet->getStyle("W".$z)->getFont()->getColor()->setARGB("009C5E");
            $sheet->setCellValue('W'.$z, "Di Verifikasi");
        }else{
            $sheet->getStyle("W".$z)->getFont()->getColor()->setARGB("BF0A0A");
            $sheet->setCellValue('W'.$z, "Belum Di Verifikasi");
        }
        $z++;
        }
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        $drawing1->setWorksheet($spreadsheet->getActiveSheet());
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
        $logExport = DB::table('export_log')
                    ->insert([
                        "user_export"=>$_SESSION['username'],
                        "desc"      =>"All Hazard Report",
                        "date"      => date("Y-m-d H:i:s")
                    ]);
        if($logExport){

            return redirect($filename);
        }
    }
    // INSPEKSI
    public function inspeksiReport(Request $request)
    {
    	# code...
    }
    public function inspeksiReportVerifikasi(Request $request)
    {
    	# code...
    }
    public function inspeksiForm(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $formInspeksi = DB::table("hse.form_inspeksi")->paginate(10);
        $editFormInspeksi = DB::table("hse.form_inspeksi")->where("idForm",hex2bin($request->uid))
                ->first();
        return view('hse.inspeksi_form',["formInspeksi"=>$formInspeksi,"editFormInspeksi"=>$editFormInspeksi,"getUser"=>$this->user]);
    }

    public function inspeksiFormPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $FormInspeksi = DB::table("hse.form_inspeksi")
                ->insert([
                    "kodeForm"=>$request->kodeForm,
                    "namaForm"=>$request->namaForm,
                    "userEntry"=>$_SESSION['username'],
                    "tglEntry"=>date("Y-m-d")
                ]);
        if($FormInspeksi){
        return redirect()->back()->with("success","Form Inspeksi Berhasil Ditambahkan!");
        }else{
        return redirect()->back()->with("failed","Form Inspeksi Gagal Ditambah!");
        }
    }

    public function inspeksiFormPUT(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $FormInspeksi = DB::table("hse.form_inspeksi")->where("idForm",hex2bin($request->uid))
                ->update([
                    "kodeForm"=>$request->kodeForm,
                    "namaForm"=>$request->namaForm
                ]);
        if($FormInspeksi>=0){
        return redirect()->back()->with("success","Form Inspeksi Berhasil Diperbaharui!");
        }else{
        return redirect()->back()->with("failed","Form Inspeksi Gagal Diperbaharui!");
        }
    }
    public function inspeksiFormFlag(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $FormInspeksi = DB::table("hse.form_inspeksi")->where("idForm",hex2bin($request->uid));

        if($request->action=="enable"){
            $update = $FormInspeksi->update([
                    "flag"=>0
                ]);
            $result = "Diaktifkan";
        }elseif($request->action=="disable"){
                $update = $FormInspeksi->update([
                    "flag"=>1,
                ]);
            $result = "Tidak Aktif";

        }                
        if($update>=0){
        return redirect()->back()->with("success","Form Inspeksi Berhasil ".$result."!");
        }else{
        return redirect()->back()->with("failed","Form Inspeksi Gagal ".$result."!");
        }
    }
    public function inspeksiFormCreate(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $createForm = DB::table("hse.form_inspeksi")->where("idForm",hex2bin($request->uid))
                ->first();
        $subData = DB::table("hse.form_inspeksi_sub")->where("idForm",hex2bin($request->uid))->get();
        $db = DB::table("hse.form_inspeksi_sub")->where("idForm",hex2bin($request->uid))->get();

        $inspeksiListEdit = DB::table("hse.form_inspeksi_list")->where("idList",hex2bin($request->idList))->first();
        return view('hse.form.inspeksi_form_new',["createForm"=>$createForm,"dataSub"=>$db,"subData"=>$subData,"inspeksiListEdit"=>$inspeksiListEdit, "getUser"=>$this->user]);
    }
    public function inspeksiFormCreatePost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $insert = DB::table("hse.form_isnpeksi_field")
                    ->insert([
                        "idForm"=>hex2bin($request->uid),
                        "nameField"=>$request->nameField,
                        "tipeField"=>$request->tipeField,
                        "tagField"=>$request->tagField,
                        "descField"=>$request->descField,
                        "valueField"=>$request->valueField,
                        "sizeField"=>$request->sizeField,
                        "sizeLabel"=>$request->sizeLabel,
                        "textLabel"=>$request->textLabel
                    ]);
        if($insert){
        return redirect()->back()->with("success","Field Berhasil Ditambahkan!");
        }else{
        return redirect()->back()->with("failed","Field Gagal Ditambah!");
        }
    }
    public function inspeksiFormCreateSub(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $createForm = DB::table("hse.form_inspeksi")->where("idForm",hex2bin($request->uid))
                ->first();
        $db = DB::table("hse.form_inspeksi_sub")->where("idForm",hex2bin($request->uid))->get();
        $inspeksiFieldEdit = DB::table("hse.form_inspeksi_sub")->where("idSub",hex2bin($request->idSub))->first();
        return view('hse.form.inspeksi_new_sub',["createForm"=>$createForm,"dataSub"=>$db,"inspeksiFieldEdit"=>$inspeksiFieldEdit, "getUser"=>$this->user]);
    }
    public function inspeksiFormCreateSubPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        // dd($request);
        $in = DB::table("hse.form_inspeksi_sub")
                ->insert([
                    "idForm"=>$request->idForm,
                    "numSub"=>$request->numSub,
                    "nameSub"=>$request->nameSub,
                    "user_input"=>$_SESSION['username'],
                    "tgl_input"=>date("Y-m-d"),
                ]);
        if($in){
            return redirect()->back()->with("success","Berhasil Membuat Sub!");
        }else{
            return redirect()->back()->with("failed","Gagal Membuat Sub!");
        }

    }
    public function inspeksiFormNewPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $in = DB::table("hse.form_inspeksi_list")
                ->insert([
                    "idForm"=>hex2bin($request->uid),
                    "idSub"=>$request->idSub,
                    "listInspeksi"=>$request->listInspeksi,
                    "user_input"=>$_SESSION['username'],
                    "tgl_input"=>date("Y-m-d")
                ]);
        if($in){
            return redirect()->back()->with("success","Berhasil Membuat List Inspeksi!");
        }else{
            return redirect()->back()->with("failed","Gagal Membuat List Inspeksi!");
        }
    }
    public function inspeksiFormNewPUT(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $in = DB::table("hse.form_inspeksi_list")
                ->where("idList",hex2bin($request->idListPut))
                ->update([
                    "idSub"=>$request->idSub,
                    "listInspeksi"=>$request->listInspeksi,
                    "user_input"=>$_SESSION['username'],
                    "tgl_input"=>date("Y-m-d")
                ]);
        if($in>=0){
            return redirect('/hse/admin/inspeksi/form/create?uid='.$request->uid)->with("success","Berhasil Mengupdate List Inspeksi!");
        }else{
            return redirect()->back()->with("failed","Gagal Mengupdate List Inspeksi!");
        }
    }

    public function inspeksiFormCreateSubPUT(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $in = DB::table("hse.form_inspeksi_sub")
                ->where("idSub",hex2bin($request->idSub_Form))
                ->update([
                    "idForm"=>hex2bin($request->uid),
                    "numSub"=>$request->numSub,
                    "nameSub"=>$request->nameSub
                ]);
        if($in){
            return redirect()->back()->with("success","Berhasil Mengupdate Sub!");
        }else{
            return redirect()->back()->with("failed","Gagal Mengupdate Sub!");
        }

    }
    public function androidInspeksiForm(Request $request)
    {
        $androidInspeksiForm = DB::table("hse.form_inspeksi")->paginate(10);
        return $androidInspeksiForm;
    }
    public function androidInspeksiList(Request $request)
    {
        $androidInspeksi = DB::table("hse.form_inspeksi_header as a")
                            ->leftJoin("hse.form_inspeksi_validasi as b","b.idInspeksi","a.idInspeksi")
                            ->leftJoin("hse.form_inspeksi_pika as c","c.idInspeksi","a.idInspeksi")
                            ->paginate(10);
        return $androidInspeksi;
    }
    public function androidInspeksiNew(Request $request)
    {
        $androidSubInspeksi = DB::table("hse.form_inspeksi_sub as a")->where("idForm",$request->idForm)->get();
        
        if(count($androidSubInspeksi)>0){
            foreach ($androidSubInspeksi as $key => $value) {
             $itemInspeksi[] = ["nameSub"=>$value->nameSub,"numSub"=>$value->numSub,"items"=>DB::table("hse.form_inspeksi_list")->where("idSub",$value->idSub)->get()];
            }
        }else{
            $itemInspeksi[] = ["nameSub"=>null,"numSub"=>null,"items"=>DB::table("hse.form_inspeksi_list")->where("idForm",$request->idForm)->get()];
        }
        return ["itemInspeksi"=>$itemInspeksi];
    }
    public function androidInspeksiItemTemp(Request $request)
    {
        $check = DB::table("hse.form_inspeksi_temp")->where([
                        ["idTemp",$request->idTemp],
                        ["idItem",$request->idItem]
                    ])->count();
        if($check>0){
        $temp = DB::table("hse.form_inspeksi_temp")
                ->where([
                        ["idTemp",$request->idTemp],
                        ["idItem",$request->idItem]
                    ])
                ->update([
                    "answer"=>$request->answer
                ]);
        }else{
        $temp = DB::table("hse.form_inspeksi_temp")
                ->insert([
                    "idTemp"=>$request->idTemp,
                    "tglTemp"=>date("Y-m-d"),
                    "idForm"=>$request->idForm,
                    "idItem"=>$request->idItem,
                    "answer"=>$request->answer,
                    "user_create"=>$request->user_create
                ]);
        }

        if($temp>=0){
            return array("success"=>true);
        }else{
            return array("success"=>false);
        }
    }
    public function androidInspeksiListTeamTemp(Request $request){
        $check = DB::table("hse.team_inspeksi_temp as a")
        ->join("user_login as b","b.nik","a.nikTeam")
        ->join("section as c","c.id_sect","b.section")
        ->join("department as d","d.id_dept","b.department")
        ->where("a.idTemp",$request->idTemp)
        ->groupBy("b.nik")
        ->get();
        return ["teamInspeksiTemp"=>$check];
    }

    public function androidInspeksiPicaTemp(Request $request){
        $pica = DB::table("hse.pica_temp")
        ->where("idTemp",$request->idTemp)
        ->get();
        return ["inspeksiPica"=>$pica];
    }
    public function androidInspeksiAddPicaTemp(Request $request)
    {
        $buktiTemuan = $request->file("buktiTemuan");
        $dir = "bukti_inspeksi/sebelum/";
        $fileName = $buktiTemuan->getClientOriginalName();
        if($buktiTemuan->move($dir,$fileName)){
        $temp = DB::table("hse.pica_temp")
        ->insert([
            "idTemp"=>$request->idTemp,
            "idForm"=>$request->idForm,
            "temuan"=>$request->temuan,
            "buktiTemuan"=>$fileName,
            "nikPJ"=>$request->nikPJ,
            "namaPJ"=>$request->namaPJ,
            "status"=>$request->status,
            "tglTenggat"=>date("Y-m-d",strtotime($request->tglTenggat))
        ]);    
        if($temp>0){
            return array("success"=>true);
        }else{
            return array("success"=>false);
        }   
        }else{
            return array("success"=>false);
        }
    }
    public function androidInspeksiAddTeamTemp(Request $request)
    {
        $check = DB::table("hse.team_inspeksi_temp")->where([
                        ["idTemp",$request->idTemp],
                        ["nikTeam",$request->nikTeam]
                    ])->count();
        if($check>0){
        $temp = DB::table("hse.team_inspeksi_temp")
                ->where([
                        ["idTemp",$request->idTemp],
                        ["nikTeam",$request->nikTeam]
                    ])
                ->update([
                    "nikTeam"=>$request->nikTeam
                ]);
        }else{
        $temp = DB::table("hse.team_inspeksi_temp")
                ->insert([
                    "idTemp"=>$request->idTemp,
                    "idForm"=>$request->idForm,
                    "nikTeam"=>$request->nikTeam
                ]);
        }

        if($temp){
            return array("success"=>true);
        }else{
            return array("success"=>false);
        }
    }
    public function androidInspeksiDeleteTemp(Request $request)
    {
        $items = DB::table("hse.form_inspeksi_temp")
                ->where("idTemp",$request->idTemp)->delete();
        $team = DB::table("hse.team_inspeksi_temp")
                ->where("idTemp",$request->idTemp)->delete();
        $pica = DB::table("hse.pica_temp")
                ->where("idTemp",$request->idTemp)->delete();
                
        if($items || $team || $pica){
            return array("success"=>true);
        }else{
            return array("success"=>false);
        }
    }
    public function androidInspeksiItems(Request $request)
        {
            $androidItemsInspeksi = DB::table("hse.form_inspeksi_list as a")->where("idSub",$request->idSub)->get();
            return array("dataItems"=>$androidItemsInspeksi);
        }
    // LOKASI
    public function hseMasterLokasi(Request $request)
    {

        if(!isset($_SESSION['username'])) return redirect('/');
        $lokasi = DB::table("hse.lokasi")
                    ->paginate(10);
        return view('hse.lokasi',["lokasi"=>$lokasi,"getUser"=>$this->user]);
    }

    public function hseMasterLokasiNew(Request $request)
    {

        if(!isset($_SESSION['username'])) return redirect('/');
          $lokasi = DB::table("hse.lokasi")
                    ->where("idLok",hex2bin($request->uid))
                    ->first();
        return view('hse.form.lokasi',["editLokasi"=>$lokasi,"getUser"=>$this->user]);
    }
    public function hseMasterLokasiPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $lokasi = DB::table("hse.lokasi")
                    ->insert([
                        "lokasi"=>$request->lokasi,
                        "des_lokasi"=>$request->des_lokasi,
                        "user_input"=>$_SESSION['username'],
                        "tgl_input"=>date("Y-m-d")]);
        if($lokasi){
            return redirect()->back()->with("success","Lokasi Berhasil Ditambahkan!");
        }else{
            return redirect()->back()->with("failed","Lokasi Gagal Ditambah!");
        }
    }
    public function hseMasterLokasiPUT(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $lokasi = DB::table("hse.lokasi")
                    ->where("idLok",$request->uidMaster)
                    ->update([
                        "lokasi"=>$request->lokasi,
                        "des_lokasi"=>$request->des_lokasi,
                        "user_input"=>$_SESSION['username'],
                        "tgl_input"=>date("Y-m-d")]);
        if($lokasi>=0){
            return redirect()->back()->with("success","Lokasi Berhasil Diperbaharui!");
        }else{
            return redirect()->back()->with("failed","Lokasi Gagal Diperbaharui!");
        }
    }
    // RISK
    public function hseMasterRisk(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $risk = DB::table("hse.risk_category")
                    ->paginate(10);
          $editRisk = DB::table("hse.risk_category")
                    ->where("idRisk",hex2bin($request->uid))
                    ->first();
        return view('hse.risk',["editRisk"=>$editRisk,"risk"=>$risk,"getUser"=>$this->user]);
    }

    public function hseMasterRiskUbah(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $risk = DB::table("hse.risk_category")
                    ->where("idRisk",hex2bin($request->uid))
                    ->update([
                        "desc_risk"=>$request->desc_risk,
                        "bgColor"=>$request->bgColor,
                        "txtColor"=>$request->txtColor,
                        "user_input"=>$_SESSION['username'],
                        "tgl_input"=>date("Y-m-d")
                    ]);
        if($risk>=0){
            return redirect()->back()->with("success","Risk Berhasil Diperbaharui!");
        }else{
            return redirect()->back()->with("failed","Risk Gagal Diperbaharui!");
        }
    }

    public function hseMasterRiskPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $risk = DB::table("hse.risk_category")
                    ->insert([
                        "risk"=>$request->risk,
                        "desc_risk"=>$request->desc_risk,
                        "bgColor"=>$request->bgColor,
                        "txtColor"=>$request->txtColor,
                        "user_input"=>$_SESSION['username'],
                        "tgl_input"=>date("Y-m-d")
                    ]);
        if($risk>=0){
            return redirect()->back()->with("success","Risk Berhasil Ditambah!");
        }else{
            return redirect()->back()->with("failed","Risk Gagal Ditambah!");
        }
    }
    // SUMBER BAHAYA
    public function hseMasterSumberBahaya(Request $request)
    {

        if(!isset($_SESSION['username'])) return redirect('/');
          $sumber_bahaya = DB::table("hse.sumber_bahaya")
                    ->paginate(10);
          $editBahaya = DB::table("hse.sumber_bahaya")
                    ->where("idBahaya",hex2bin($request->uid))
                    ->first();
        return view('hse.sumber_bahaya',["editBahaya"=>$editBahaya,"sumber_bahaya"=>$sumber_bahaya,"getUser"=>$this->user]);
    }
    public function hseMasterSumberBahayaPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $risk = DB::table("hse.sumber_bahaya")
                    ->insert([
                        "bahaya"=>$request->bahaya,
                        "user_input"=>$_SESSION['username'],
                        "time_input"=>date("Y-m-d H:i:s")
                    ]);
        if($risk){
            return redirect()->back()->with("success","Risk Berhasil Ditambah!");
        }else{
            return redirect()->back()->with("failed","Risk Gagal Ditambah!");
        }
    }
    public function hseMasterSumberBahayaPUT(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $risk = DB::table("hse.sumber_bahaya")
                    ->where("idBahaya",hex2bin($request->uid))
                    ->update([
                        "bahaya"=>$request->bahaya,
                        "user_input"=>$_SESSION['username'],
                        "time_input"=>date("Y-m-d H:i:s")
                    ]);
        if($risk>=0){
            return redirect()->back()->with("success","Risk Berhasil Diperbaharui!");
        }else{
            return redirect()->back()->with("failed","Risk Gagal Diperbaharui!");
        }
    }
    // hasilMatrikResiko
    public function hasilMatrikResiko(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $ketResiko = DB::table("hse.metrik_resiko")
                    ->paginate(10);
          $editKetResiko = DB::table("hse.metrik_resiko")
                    ->where("idResiko",hex2bin($request->uid))
                    ->first();
        return view('hse.hasilResiko',["editKetResiko"=>$editKetResiko,"ketResiko"=>$ketResiko,"getUser"=>$this->user]);
    }
    public function hasilMatrikResikoPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $risk = DB::table("hse.metrik_resiko")
                    ->insert([
                        "kodeBahaya"=>$request->kodeBahaya,
                        "min"=>$request->min,
                        "max"=>$request->max,
                        "kategori"=>$request->kategori,
                        "tindakan"=>$request->tindakan,
                        "bgColor"=>$request->bgColor,
                        "txtColor"=>$request->txtColor
                    ]);
        if($risk){
            return redirect()->back()->with("success","Matrik Resiko Berhasil Ditambah!");
        }else{
            return redirect()->back()->with("failed","Matrik Resiko Gagal Ditambah!");
        }
    }
    public function hasilMatrikResikoPut(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $risk = DB::table("hse.metrik_resiko")
                    ->where("idResiko",hex2bin($request->uid))
                    ->update([
                        "kodeBahaya"=>$request->kodeBahaya,
                        "min"=>$request->min,
                        "max"=>$request->max,
                        "kategori"=>$request->kategori,
                        "tindakan"=>$request->tindakan,
                        "bgColor"=>$request->bgColor,
                        "txtColor"=>$request->txtColor
                    ]);
        if($risk>=0){
            return redirect()->back()->with("success","Matrik Resiko Berhasil Diperbaharui!");
        }else{
            return redirect()->back()->with("failed","Matrik Resiko Gagal Diperbaharui!");
        }
    }
    public function kemungkinanMatrikResiko(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $kmResiko = DB::table("hse.metrik_resiko_kemungkinan")
                    ->paginate(10);
          $editKmResiko = DB::table("hse.metrik_resiko_kemungkinan")
                    ->where("idKemungkinan",hex2bin($request->uid))
                    ->first();
        return view('hse.kemungkinanResiko',["editKmResiko"=>$editKmResiko,"kmResiko"=>$kmResiko,"getUser"=>$this->user]);
    }
    public function kemungkinanMatrikResikoPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $kmResiko = DB::table("hse.metrik_resiko_kemungkinan")
                    ->insert([
                        "kemungkinan"=>$request->kemungkinan,
                        "nilai"=>$request->nilai
                    ]);
        if($kmResiko){
            return redirect()->back()->with("success","Matrik Resiko Berhasil Ditambah!");
        }else{
            return redirect()->back()->with("failed","Matrik Resiko Gagal Ditambah!");
        }
    }
    public function kemungkinanMatrikResikoPut(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $kmResiko = DB::table("hse.metrik_resiko_kemungkinan")
                    ->where("idKemungkinan",hex2bin($request->uid))
                    ->update([
                        "kemungkinan"=>$request->kemungkinan,
                        "nilai"=>$request->nilai
                    ]);
        if($kmResiko>=0){
            return redirect('/hse/admin/matrik/kemungkinan')->with("success","Matrik Resiko Berhasil Diperbaharui!");
        }else{
            return redirect()->back()->with("failed","Matrik Resiko Gagal Diperbaharui!");
        }
    }

    public function keparahanMatrikResiko(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $kpResiko = DB::table("hse.metrik_resiko_keparahan")
                    ->paginate(10);
          $editKpResiko = DB::table("hse.metrik_resiko_keparahan")
                    ->where("idKeparahan",hex2bin($request->uid))
                    ->first();
        return view('hse.keparahanResiko',["editKpResiko"=>$editKpResiko,"kpResiko"=>$kpResiko,"getUser"=>$this->user]);
    }
    public function keparahanMatrikResikoPost(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $keparahan = htmlspecialchars($request->keparahan,ENT_QUOTES);
          $kpResiko = DB::table("hse.metrik_resiko_keparahan")
                    ->insert([
                        "keparahan"=>$request->keparahan,
                        "nilai"=>$request->nilai
                    ]);
        if($kpResiko){
            return redirect()->back()->with("success","Matrik Resiko Berhasil Ditambah!");
        }else{
            return redirect()->back()->with("failed","Matrik Resiko Gagal Ditambah!");
        }
    }
    public function keparahanMatrikResikoPut(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
        $keparahan = htmlspecialchars($request->keparahan,ENT_QUOTES);
          $kpResiko = DB::table("hse.metrik_resiko_keparahan")
                    ->where("idKeparahan",hex2bin($request->uid))
                    ->update([
                        "keparahan"=>$keparahan,
                        "nilai"=>$request->nilai
                    ]);
        if($kpResiko>=0){
            return redirect('/hse/admin/matrik/keparahan')->with("success","Matrik Resiko Berhasil Diperbaharui!");
        }else{
            return redirect()->back()->with("failed","Matrik Resiko Gagal Diperbaharui!");
        }
    }

    public function tbMatrikResiko(Request $request)
    {
        if(!isset($_SESSION['username'])) return redirect('/');
          $hsResiko = DB::table("hse.metrik_resiko");
          $kmResiko = DB::table("hse.metrik_resiko_kemungkinan")
                    ->get();
          $kpResiko = DB::table("hse.metrik_resiko_keparahan")
                    ->get();
        return view('hse.tableMatrikResiko',["hsResiko"=>$hsResiko,"kmResiko"=>$kmResiko,"kpResiko"=>$kpResiko,"getUser"=>$this->user]);
    }
    public function tbMatrikResikoWebView(Request $request)
    {
          $hsResiko = DB::table("hse.metrik_resiko");
          $kmResiko = DB::table("hse.metrik_resiko_kemungkinan")
                    ->get();
          $kpResiko = DB::table("hse.metrik_resiko_keparahan")
                    ->get();
        return view('hse.tableMatrikResikoView',["hsResiko"=>$hsResiko,"kmResiko"=>$kmResiko,"kpResiko"=>$kpResiko]);
    }

    // hasilMatrikResiko
    // resikoKemungkinan
    public function resikoKemungkinan(Request $request)
    {
       $kemungkinan = DB::table("hse.metrik_resiko_kemungkinan")->orderBy("nilai","asc")->get();
       return ["kemungkinan"=>$kemungkinan];
    }
    // resikoKemungkinan
    // resikoKeparahan
    public function resikoKeparahan(Request $request)
    {
       $keparahan = DB::table("hse.metrik_resiko_keparahan")->orderBy("nilai","asc")->get();
       return ["keparahan"=>$keparahan];
    }
    // resikoKeparahan
    // hirarkiPengendalian
    public function hirarkiPengendalian(Request $request)
    {
       $hirarki = DB::table("hse.hirarki_pengendalian")->get();
       return ["hirarki"=>$hirarki];
    }
    // hirarkiPengendalian
}
