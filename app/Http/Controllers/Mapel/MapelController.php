<?php

namespace App\Http\Controllers\Mapel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

use Validator;
use App\Http\Controllers\Controller;
use App\Mapel as Mapel;
use App\Kelas as Kelas;
use App\Kurikulum as Kurikulum;

class MapelController extends Controller
{
  
	public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $dataMapel = Mapel::select(DB::raw("mapelKode, mapelNama, mapelKurId, mapelKelasId, guruNama"))
        ->leftjoin('guru_sd', 'guruKelasKode', '=', 'mapelKelasId')    
        ->orderBy(DB::raw("mapelKode"))      
        ->get();
        
    $data = array('mapel' => $dataMapel);   
    return view('admin.dashboard.mapel.mapel',$data);
  }

  public function detail($mapelKode)
  {
    $dataMapel = Mapel::select(DB::raw("mapelKode, mapelNama, guruNama, mapelKurId, kurTahun, mapelKelasId, guruNama"))
        ->leftjoin('guru_sd', 'guruKelasKode', '=', 'mapelKelasId')    
        ->join('kurikulum_sd', 'kurId', '=', 'mapelKurId')
        ->where('mapelKode','=',$mapelKode)
        ->orderBy(DB::raw("mapelKode"))        
        ->get();
        
    $data = array('mapel' => $dataMapel);   
    return view('admin.dashboard.mapel.detailmapel',$data);
  }


  //Tambah Mapel
  public function tambah()
  {
    $kelas = Kelas::select(DB::raw('kelasKode', 'guruId'))
        ->join('guru_sd', 'guruKelasKode', '=', 'kelasKode')
        ->get(); 
    
    $kurikulum = Kurikulum::select(DB::raw('kurId'))
        ->get();

    return view('admin.dashboard.mapel.tambahmapel')
        ->with(['kelas' => $kelas, 'kurikulum' => $kurikulum]);
  }

  public function tambahmapel(Request $request)
  {
        $input =$request->all();
        $pesan = array(
            'mapelKode.required'      => 'Kode Mapel dibutuhkan.',            
            'mapelKode.unique'        => 'Kode Mapel sudah digunakan.',
            'mapelNama.required'      => 'Nama Mapel dibutuhkan.',
            'mapelKelasId.required'   => 'Kelas Mapel dibutuhkan.',
            'mapelKurId.required'     => 'Kurikulum Mapel dibutuhkan.',
        );

        $aturan = array(
            'mapelKode'   => 'required|unique:matapelajaran_sd',
            'mapelNama'   => 'required',
            'mapelKelasId'=> 'required',
            'mapelKurId'  => 'required',
        );
        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();

          # Bila validasi sukses
        }

        $mapel = new Mapel;
        $mapel->mapelKode     = $request['mapelKode'];
        $mapel->mapelNama     = $input['mapelNama'];
        $mapel->mapelKurId    = $input['mapelKurId'];
        $mapel->mapelKelasId  = $input['mapelKelasId'];
        
        if (! $mapel->save())
          App::abort(500);

        return Redirect::action('Mapel\MapelController@index')
                          ->with('successMessage','Data mapel telah berhasil ditambah.'); 
      
    //return view('admin.dashboard.mapel.mapel');
  }


  public function hapus($id)
  {
    $mapelKode = Mapel::where('mapelKode','=',$id)->first();

    if($mapelKode==null)
      App::abort(404);
    $mapelKode->delete();
    
    return Redirect::route('mapel');

  }

}

