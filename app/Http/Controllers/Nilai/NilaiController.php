<?php

namespace App\Http\Controllers\Nilai;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Auth;

use Validator;
use App\Http\Controllers\Controller;
use App\Nilai as Nilai;
use App\Siswa as Siswa;

class NilaiController extends Controller
{
  
	public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $dataSiswa = Siswa::select(DB::raw("sisNisn, sisNama, sisKelasKode, guruId, guruNama, kelasKode, kelasNama"))
        ->join('kelas_sd','kelasKode','=','sisKelasKode')
        ->join('guru_sd','guruKelasKode','=','kelasKode')
        ->get();
        
    $data = array('nilai' => $dataSiswa);   
    return view('admin.dashboard.nilai.nilai',$data);
  }

  public function detail($guruId,$sisNisn,$mapelKode)
  {
    $dataNilai = Nilai::select(DB::raw("nilaiId, nilaiGuruId, nilaiSisNisn, nilaiMapelKode, nilaiTugas, nilaiUh, nilaiUts, nilaiUas, nilaiPerilaku, nilaiKeterangan, guruId, guruNama, sisNisn, sisNama, mapelKode, mapelNama, mapelKelasId"))
        ->join('guru_sd','guruId','=','nilaiGuruId')
        ->join('siswa_sd','sisKelasKode','=','guruKelasKode')
        ->join('matapelajaran_sd','mapelKelasId','=','guruKelasKode')
        ->where('guruId','=',$guruId)
        ->where('sisNisn','=',$sisNisn)
        ->get();
        
    $data1 = array('nilai' => $dataNilai);   

    $nilaiKosong = Siswa::select(DB::raw("nilaiId, nilaiGuruId, nilaiSisNisn, nilaiMapelKode, nilaiTugas, nilaiUh, nilaiUts, nilaiUas, nilaiPerilaku, nilaiKeterangan, guruId, guruNama, sisNisn, sisNama, mapelKode, mapelNama, mapelKelasId"))
        ->join('nilai_sd','nilaiSisNisn','=','sisNisn')
        ->join('guru_sd','guruKelasKode','=','sisKelasKode')
        ->join('matapelajaran_sd','mapelKelasId','=','guruKelasKode')
        ->where('nilaiSisNisn','!=','sisNisn')
        ->get();
        
    $data2 = array('nilaisd' => $nilaiKosong);   
    return view('admin.dashboard.nilai.detailnilai',$data1,$data2);
  }

  public function dataNilai($data)
  {
    $dataSiswa = Siswa::select(DB::raw("sisNisn, sisNama, sisKelasKode, guruId, guruNama, kelasKode, kelasNama"))
        ->join('kelas_sd','kelasKode','=','sisKelasKode')
        ->join('guru_sd','guruKelasKode','=','kelasKode')
        ->get();
        
    $data = array('nilai' => $dataSiswa);   
    return view('admin.dashboard.nilai.nilai',$data);
  }

  public function edit($id)
  {
	  // mengambil data berdasarkan id yang dipilih
    $nilai = Nilai::select(DB::raw("nilaiId, nilaiGuruId, nilaiSisNisn, nilaiMapelKode, nilaiTugas, nilaiUh, nilaiUts, nilaiUas, nilaiPerilaku, nilaiKeterangan, mapelKelasId"))
        ->join('matapelajaran_sd','mapelKode','=','nilaiMapelKode')
        ->where('nilaiId','=',$id)
        ->get();
	  // passing data yang didapat ke view edit.blade.php
	  return view('admin.dashboard.nilai.editnilai', ['nilai' => $nilai]);
  }

  public function update(Request $request)
  {
    // update data 
    $nilai = Nilai::select(DB::raw("nilaiId"))
      ->where('nilaiId','=',$request->id)
      ->update([
		            'nilaiTugas' => $request->nilaiTugas,
		            'nilaiUh' => $request->nilaiUh,
		            'nilaiUts' => $request->nilaiUts,
                'nilaiUas' => $request->nilaiUas,
                'nilaiPerilaku' => $request->nilaiPerilaku,
                'nilaiKeterangan' => $request->nilaiKeterangan
	    ]);
    // alihkan halaman ke halaman
    return redirect('datanilai/'.$request->kelas);
  }

  //Tambah Nilai
  public function tambah($guruId,$sisNisn,$mapelKode)
  {
    return view('admin.dashboard.nilai.tambahnilai')
      ->with(['guruId' => $guruId, 'sisNisn' => $sisNisn, 'mapelKode' => $mapelKode]);
  }

  public function tambahnilai(Request $request)
  {
        $input =$request->all();
        $pesan = array(
            // 'sisNisn.required'        => 'NISN Nilai dibutuhkan.',            
            // 'sisNisn.unique'          => 'NISN sudah digunakan.',
            // 'sisNis.required'         => 'NIS Nilai dibutuhkan.',            
            // 'sisNis.unique'           => 'NIS sudah digunakan.',
            // 'sisNama.required'        => 'Nama Nilai dibutuhkan.',            
            // 'sisEmail.required'       => 'Email Nilai dibutuhkan.',            
            // 'sisEmail.unique'         => 'Email sudah digunakan.',            
            // 'sisTtl.required'         => 'TTL Nilai dibutuhkan.',            
            // 'sisKelasKode.required'   => 'Kelas Nilai dibutuhkan.',
            // 'sisAngkatan.required'    => 'Angkatan Nilai dibutuhkan.',
            // 'sisStatusAktif.required' => 'Status Nilai dibutuhkan.',            
        );

        $aturan = array(
            // 'sisNisn'         => 'required|unique:nilai_sd',
            // 'sisNis'         => 'required|unique:nilai_sd',
            // 'sisNama'        => 'required|max:60',
            // 'sisEmail'       => 'required|unique:nilai_sd',
            // 'sisTtl'         => 'required',
            // 'sisKelasKode'   => 'required',
            // 'sisAngkatan'    => 'required',
            // 'sisStatusAktif' => 'required',
        );
        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();

          # Bila validasi sukses
        }

        $nilai = new Nilai;
        $nilai->nilaiGuruId       = $input['nilaiGuruId'];
        $nilai->nilaiSisNisn      = $input['nilaiSisNisn'];
        $nilai->nilaiMapelKode    = $input['nilaiMapelKode'];
        $nilai->nilaiTugas        = $input['nilaiTugas'];
        $nilai->nilaiUh           = $input['nilaiUh'];
        $nilai->nilaiUts          = $input['nilaiUts'];
        $nilai->nilaiUas          = $input['nilaiUas'];
        $nilai->nilaiPerilaku     = $input['nilaiPerilaku'];
        $nilai->nilaiKeterangan   = $input['nilaiKeterangan'];
        
        if (! $nilai->save())
          App::abort(500);
        return redirect('datanilai/'.$nilai->nilaiGuruId.'/'.$nilai->nilaiSisNisn.'/'.Auth::user()->kelasKode.'/detail')
                          ->with('successMessage','Data nilai telah berhasil ditambah.'); 
      
    //return view('admin.dashboard.nilai.nilai');
  }
  // // Edit Nilai
  //   //Tambah Guru
  // public function edit()
  // {
  //   return view('admin.dashboard.nilai.editnilai');
  // }

  // public function editNilai(Request $request)
  // {
  //       $input =$request->all();
  //       $pesan = array(
  //           // 'guruNip.required'    => 'NIP Guru dibutuhkan.',            
  //           // 'guruNip.unique'      => 'NIP sudah digunakan.',
  //           // 'guruNama.required'   => 'Nama Guru dibutuhkan.',            
  //           // 'guruEmail.required'  => 'Email Guru dibutuhkan.',            
  //           // 'guruEmail.unique'    => 'Email sudah digunakan.',            
  //           // 'guruTtl.required'    => 'TTL Guru dibutuhkan.',            
  //           // 'guruAktifM.required' => 'Aktif Mulai dibutuhkan.',
  //           // 'guruAktifS.required' => 'Aktif Sampai dibutuhkan.',            
  //       );

  //       $aturan = array(

  //           // 'guruNip' => 'required|unique:guru_sd',
  //           // 'guruNama' => 'required|max:60',
            
  //       );
        

  //       $validator = Validator::make($input,$aturan, $pesan);

  //       if($validator->fails()) {
  //           # Kembali kehalaman yang sama dengan pesan error
  //           return Redirect::back()->withErrors($validator)->withInput();

  //         # Bila validasi sukses
  //       }

  //       $nilai = new Nilai();
  //       $nilai->nilaiGuruId      = $input['nilaiGuruId'];
  //       $nilai->nilaiSisNisn     = $input['nilaiSisNisn'];
  //       $nilai->nilaiMapelKode   = $input['nilaiMapelKode'];
  //       $nilai->nilaiTugas       = $input['nilaiTugas'];
  //       $nilai->nilaiUh          = $input['nilaiUh'];
  //       $nilai->nilaiUts         = $input['nilaiUts'];
  //       $nilai->nilaiUas         = $input['nilaiUas'];
  //       $nilai->nilaiPerilaku    = $input['nilaiPerilaku'];
  //       $nilai->nilaiKeterangan  = $input['nilaiKeterangan'];
        
  //       if (! $nilai->save())
  //         App::abort(500);

  //       return Redirect::action('Nilai\NilaiController@index')
  //                         ->with('successMessage','Data nilai telah berhasil diedit.'); 
      
  //   //return view('admin.dashboard.guru.guru');
  // }

  public function hapus($id)
  {
    $nilaiId = Nilai::where('nilaiId','=',$id)->first();

    if($nilaiId==null)
      App::abort(404);
    $nilaiId->delete();
    
    return Redirect::route('nilai');

  }
}

