<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

use Validator;
use App\Http\Controllers\Controller;
use App\Siswa as Siswa;
use App\Nilai as Nilai;
use App\Absensi as Absensi;

class SiswaController extends Controller
{
  
	public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $dataSiswa = Siswa::select(DB::raw("sisNisn, sisNis, sisNama, sisKelasKode, sisAngkatan, sisStatusAktif"))
        ->get();
        
    $data = array('siswa' => $dataSiswa);   
    return view('admin.dashboard.siswa.siswa',$data);
  }

  public function detail($sisNisn)
  {
    $dataSiswa = Siswa::select(DB::raw("sisNisn, sisNis, sisNama, sisEmail, sisJk, sisTtl, sisAlamat, sisKelasKode, sisAngkatan, sisStatusAktif"))
        ->where('sisNisn','=',$sisNisn)
        ->get();
        
    $data = array('siswa' => $dataSiswa);   
    return view('admin.dashboard.siswa.detailsiswa',$data);
  }

  public function anakWali($kelas)
  {
    $dataSiswa = Siswa::select(DB::raw("sisNisn, sisNis, sisNama, sisKelasKode, sisAngkatan, sisStatusAktif"))
        ->where('sisKelasKode','=',$kelas)
        ->get();
        
    $data = array('siswa' => $dataSiswa);   
    return view('admin.dashboard.siswa.siswa',$data);
  }

  //Tambah Siswa
  public function tambah()
  {
    return view('admin.dashboard.siswa.tambahsiswa');
  }

  public function tambahsiswa(Request $request)
  {
        $input =$request->all();
        $pesan = array(
            'sisNisn.required'        => 'NISN Siswa dibutuhkan.',            
            'sisNisn.unique'          => 'NISN sudah digunakan.',
            'sisNis.required'         => 'NIS Siswa dibutuhkan.',            
            'sisNis.unique'           => 'NIS sudah digunakan.',
            'sisNama.required'        => 'Nama Siswa dibutuhkan.',            
            'sisEmail.required'       => 'Email Siswa dibutuhkan.',            
            'sisEmail.unique'         => 'Email sudah digunakan.',            
            'sisTtl.required'         => 'TTL Siswa dibutuhkan.',            
            'sisKelasKode.required'   => 'Kelas Siswa dibutuhkan.',
            'sisAngkatan.required'    => 'Angkatan Siswa dibutuhkan.',
            'sisStatusAktif.required' => 'Status Siswa dibutuhkan.',            
        );

        $aturan = array(
            'sisNisn'         => 'required|unique:siswa_sd',
            'sisNis'         => 'required|unique:siswa_sd',
            'sisNama'        => 'required|max:60',
            'sisEmail'       => 'required|unique:siswa_sd',
            'sisTtl'         => 'required',
            'sisKelasKode'   => 'required',
            'sisAngkatan'    => 'required',
            'sisStatusAktif' => 'required',
        );
        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();

          # Bila validasi sukses
        }

        $siswa = new Siswa;
        $siswa->sisNisn         = $request['sisNisn'];
        $siswa->sisNis          = $input['sisNis'];
        $siswa->sisNama         = $input['sisNama'];
        $siswa->sisEmail        = $input['sisEmail'];
        $siswa->sisJk           = $input['sisJk'];
        $siswa->sisTtl          = $input['sisTtl'];
        $siswa->sisAlamat       = $input['sisAlamat'];
        $siswa->sisKelasKode    = $input['sisKelasKode'];
        $siswa->sisAngkatan     = $input['sisAngkatan'];
        $siswa->sisStatusAktif  = $input['sisStatusAktif'];
        
        if (! $siswa->save())
          App::abort(500);

        return Redirect::route('siswa')
                          ->with('successMessage','Data siswa telah berhasil ditambah.'); 
      
    //return view('admin.dashboard.siswa.siswa');
  }

  //edit Siswa
  public function edit($id)
  {
	  // mengambil data berdasarkan id yang dipilih
    $siswa = Siswa::select(DB::raw("sisNisn, sisNis, sisNama, sisEmail, sisJk, sisTtl, sisAlamat, sisKelasKode, sisAngkatan, sisStatusAktif"))
        ->where('sisNisn','=',$id)
        ->get();
	  // passing data yang didapat ke view edit.blade.php
	  return view('admin.dashboard.siswa.editsiswa', ['siswa' => $siswa]);
  }

  public function update(Request $request)
  {
    $input =$request->all();
        $pesan = array(
            'sisNis.required'         => 'NIS Siswa dibutuhkan.',            
            'sisNis.unique'           => 'NIS sudah digunakan.',
            'sisNama.required'        => 'Nama Siswa dibutuhkan.',            
            'sisEmail.required'       => 'Email Siswa dibutuhkan.',            
            'sisEmail.unique'         => 'Email sudah digunakan.',            
            'sisTtl.required'         => 'TTL Siswa dibutuhkan.',            
            'sisKelasKode.required'   => 'Kelas Siswa dibutuhkan.',
            'sisAngkatan.required'    => 'Angkatan Siswa dibutuhkan.',
            'sisStatusAktif.required' => 'Status Siswa dibutuhkan.',            
        );

        $aturan = array(
            'sisNis'         => 'required|unique:siswa_sd',
            'sisNama'        => 'required|max:60',
            'sisEmail'       => 'required|unique:siswa_sd',
            'sisTtl'         => 'required',
            'sisKelasKode'   => 'required',
            'sisAngkatan'    => 'required',
            'sisStatusAktif' => 'required',
        );
        
        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();

          # Bila validasi sukses
        }

    // update data 
    $siswa = Siswa::select(DB::raw("sisNisn"))
      ->where('sisNisn','=',$request->id)
      ->update([
                'sisNis'        => $request->sisNis,
		            'sisNama'       => $request->sisNama,
		            'sisEmail'      => $request->sisEmail,
                'sisJk'         => $request->sisJk,
                'sisTtl'        => $request->sisTtl,
                'sisAlamat'     => $request->sisAlamat,
                'sisKelasKode'  => $request->sisKelasKode,
                'sisAngkatan'   => $request->sisAngkatan,
                'sisStatusAktif'=> $request->sisStatusAktif,
	    ]);
    // alihkan halaman ke halaman
    return redirect('siswa');
  }


  public function hapus($id)
  {
    $sisNisn = Siswa::where('sisNisn','=',$id)->first();
    $nilai = Nilai::where('nilaiSisNisn','=',$id)->first();
    $absensi = Absensi::where('absensiSisNisn','=',$id)->first();

    if($sisNisn==null)
      App::abort(404);
    
    if($nilai!=null)
      $nilai->delete();
    
    if($absensi!=null)
      $absensi->delete();
    
    $sisNisn->delete();

    return Redirect::route('siswa');

  }

}

