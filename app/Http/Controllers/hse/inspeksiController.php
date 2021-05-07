<?php

namespace App\Http\Controllers\hse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Response;

class inspeksiController extends Controller
{
	public function createInspeksi(Request $request)
	{
		$id = uniqid();
		$header = DB::table("hse.form_inspeksi_header")
					->insert([
						"idInspeksi"=>$id,
						"idForm"=>$request->idForm,
						"tgl_inspeksi"=>date("Y-m-d",strtotime($request->tglInspeksi)),
						"userInput"=>$request->user,
						"perusahaan"=>$request->perusahaan,
						"lokasiInspeksi"=>$request->lokasi,
						"tglInput"=>date("Y-m-d"),	
						"saran"=>$request->saran,
						"status"=>"Sedang Dikerjakan"
					]);
		if($header){
		$item = DB::table("hse.form_inspeksi_temp")
				->where("idTemp",$request->idTemp)
				->get();
				foreach ($item as $k => $value) {
					$itemIn = DB::table("hse.form_inspeksi_detail")
					->insert([
											"idInspeksi"=>$id,
											"inspeksi"=>$value->idItem,
											"answer"=>$value->answer
										]);
				}
				if($item){
		$team = DB::table("hse.team_inspeksi_temp")
				->where("idTemp",$request->idTemp)
				->get();
				foreach ($team as $k => $value) {
					$teamIn = DB::table("hse.team_inspeksi")->insert([
											"idInspeksi"=>$id,
											"nikTeam"=>$value->nikTeam
										]);
				}
				if($team){
		$pica = DB::table("hse.pica_temp")
				->where("idTemp",$request->idTemp)
				->get();
				foreach ($pica as $k => $value) {
					$picaIn = DB::table("hse.form_inspeksi_pika")->insert([
											"idInspeksi"=>$id,
											"picaTemuan"=>$value->temuan,
											"picaSebelum"=>$value->buktiTemuan,
											"picaNikPJ"=>$value->nikPJ,
											"picaNamaPJ"=>$value->namaPJ,
											"picaTenggat"=>date("Y-m-d",strtotime($value->tglTenggat)),
											"status"=>$value->status
										]);
				}
				if($pica){
					$validasi = DB::table('hse.form_inspeksi_validasi')
									->insert([
										"idInspeksi"=>$id
									]);
					if($validasi){
						return ["success"=>true];
					}else{
						return ["success"=>false];
					}
				}else{
					return ["success"=>false];
				}
				}else{
					return ["success"=>false];
				}
			}else{
				return ["success"=>false];
			}
		}else{
			return ["success"=>false];
		}
	}
	public function getInspeksiUser(Request $request)
	{
		$header = DB::table("hse.form_inspeksi_header as a")
				->leftJoin("hse.form_inspeksi as b","b.idForm","a.idForm")
				->leftJoin("db_karyawan.perusahaan as c","c.id_perusahaan","a.perusahaan")
				->where([
					["a.userInput",$request->userInput],
					["a.idForm",$request->idForm]
				])
				->orderBy("INC","desc")
				->paginate(10);
		return ["inspeksi"=>$header];
	}
	public function androidInspeksiPica(Request $request)
	{
		$pica = DB::table("hse.form_inspeksi_pika")
        ->where("idInspeksi",$request->idInspeksi)
        ->get();
        return ["inspeksiPicaDetail"=>$pica];
	}
	

    public function teamInspeksi(Request $request){
        $check = DB::table("hse.team_inspeksi as a")
        ->join("user_login as b","b.nik","a.nikTeam")
        ->join("section as c","c.id_sect","b.section")
        ->join("department as d","d.id_dept","b.department")
        ->where("a.idInspeksi",$request->idInspeksi)
        ->groupBy("b.nik")
        ->get();
        return ["teamInspeksi"=>$check];
    }

    public function inspeksiDetail(Request $request)
    {
        $androidSubInspeksi = DB::table("hse.form_inspeksi_sub as a")->where("idForm",$request->idForm)->get();
        
        if(count($androidSubInspeksi)>0){
            foreach ($androidSubInspeksi as $key => $value) {
             $itemInspeksi[] = ["nameSub"=>$value->nameSub,"numSub"=>$value->numSub,"items"=>DB::table("hse.form_inspeksi_list as b")->leftJoin("hse.form_inspeksi_detail as c","c.inspeksi","b.idList")->where([["idSub",$value->idSub],["c.idInspeksi",$request->idInspeksi]])->get()];
            }
        }else{
            $itemInspeksi[] = ["nameSub"=>null,"numSub"=>null,"items"=>DB::table("hse.form_inspeksi_list as b")->leftJoin("hse.form_inspeksi_detail as c","c.inspeksi","b.idList")->where([["idForm",$request->idForm],["c.idInspeksi",$request->idInspeksi]])->get()];
        }
        return ["itemDetailInspeksi"=>$itemInspeksi];
    }
}