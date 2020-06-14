<?php

namespace App\Http\Controllers\Kepsek;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

use Validator;
use App\Http\Controllers\Controller;
use App\Kepsek as Kepsek;
//use App\Jurusan as Jurusan;

class KepsekController extends Controller
{
  
	public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $dataKepsek = Kepsek::select(DB::raw("kepsekId, kepsekNip, kepsekNama, kepsekEmail, kepsekJk, kepsekTtl, kepsekAlamat, kepsekAktifM, kepsekAktifS"))
        ->leftjoin('users', 'users.email', '=', 'kepsekEmail')
        ->orderBy(DB::raw("kepsekNip"))        
        ->get();
        
    $data = array('kepsek' => $dataKepsek);   
    return view('admin.dashboard.kepsek.kepsek',$data);
  }

  public function detail($kepsekId)
  {
    $dataKepsek = Kepsek::select(DB::raw("kepsekId, kepsekNip, kepsekNama, kepsekJk, kepsekTtl, kepsekAlamat, kepsekAktifM, kepsekAktifS"))
        ->where('kepsekId','=',$kepsekId)        
        ->get();
        
    $data = array('kepsek' => $dataKepsek);   
    return view('admin.dashboard.kepsek.detailkepsek',$data);
  }

  public function tambah()
  {
    return view('admin.dashboard.kepsek.tambahkepsek');
  }

  public function tambahkepsek(Request $request)
  {
        $input =$request->all();
        $pesan = array(
            'kepsekNip.required'    => 'NIP Kepsek dibutuhkan.',            
            'kepsekNip.unique'      => 'NIP sudah digunakan.',
            'kepsekNama.required'   => 'Nama Kepsek dibutuhkan.',            
            'kepsekEmail.required'  => 'Email Kepsek dibutuhkan.',            
            'kepsekEmail.unique'    => 'Email sudah digunakan.',            
            'kepsekTtl.required'    => 'TTL Kepsek dibutuhkan.',            
            'kepsekAktifS.after'    => 'Data Aktif Sampai lebih lama dari Data Aktif Mulai',          
            'kepsekTtl.before'      => 'Data Aktif Mulai lebih lama dari Data TTL',       
        );

        $aturan = array(
          'kepsekNip' => 'required',
          'kepsekNama' => 'required|max:60',
          'kepsekEmail' => 'required',
          'kepsekTtl'   => 'required',
          'kepsekAktifS' => [
            'after:'.Input::get('kepsekAktifM') // This is what we will learn to do
          ],
          'kepsekTtl' => [
            'before:'.Input::get('kepsekAktifM') // This is what we will learn to do
          ],
            
            
        );
        

        $validator = Validator::make($input,$aturan, $pesan);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();

          # Bila validasi sukses
        }

        $kepsek = new Kepsek;
        $kepsek->kepsekId = $request['kepsekId'];
        $kepsek->kepsekNip = $input['kepsekNip'];
        $kepsek->kepsekNama = $input['kepsekNama'];
        $kepsek->kepsekEmail = $input['kepsekEmail'];
        $kepsek->kepsekJk = $input['kepsekJk'];
        $kepsek->kepsekTtl = $input['kepsekTtl'];
        $kepsek->kepsekAlamat = $input['kepsekAlamat'];
        $kepsek->kepsekAktifM = $input['kepsekAktifM'];
        $kepsek->kepsekAktifS = $input['kepsekAktifS'];
        
        if (! $kepsek->save())
          App::abort(500);

        return Redirect::action('Kepsek\KepsekController@index')
                          ->with('successMessage','Data kepala sekolah "'.$input['kepsekNama'].'" telah berhasil ditambah.'); 
      
    //return view('admin.dashboard.kepsek.kepsek');
  }

  //edit Kepsek
  public function edit($id)
  {
	  // mengambil data berdasarkan id yang dipilih
    $kepsek = Kepsek::select(DB::raw("kepsekId, kepsekNip, kepsekNama, kepsekEmail, kepsekJk, kepsekTtl, kepsekAlamat, kepsekAktifM, kepsekAktifS"))
        ->where('kepsekId','=',$id)
        ->get();
	  // passing data yang didapat ke view edit.blade.php
	  return view('admin.dashboard.kepsek.editkepsek', ['kepsek' => $kepsek]);
  }

  public function update(Request $request)
  {
    $input =$request->all();
    $pesan = array(
        'kepsekNip.required'    => 'NIP Kepsek dibutuhkan.',            
        'kepsekNip.unique'      => 'NIP sudah digunakan.',
        'kepsekNama.required'   => 'Nama Kepsek dibutuhkan.',            
        'kepsekEmail.required'  => 'Email Kepsek dibutuhkan.',            
        'kepsekEmail.unique'    => 'Email sudah digunakan.',            
        'kepsekTtl.required'    => 'TTL Kepsek dibutuhkan.',            
        'kepsekAktifS.after'    => 'Data Aktif Sampai lebih lama dari Data Aktif Mulai',          
        'kepsekTtl.after'       => 'Data Aktif Mulai lebih lama dari Data TTL',       
    );

    $aturan = array(
      'kepsekNip'    => 'required',
      'kepsekNama'   => 'required|max:60',
      'kepsekEmail'  => 'required',
      'kepsekTtl'    => 'required',
      'kepsekAktifS' => [
        'after:'.Input::get('kepsekAktifM') // This is what we will learn to do
      ],
      'kepsekTtl' => [
        'before:'.Input::get('kepsekAktifM') // This is what we will learn to do
      ],
        
        
    );
    

    $validator = Validator::make($input,$aturan, $pesan);

    if($validator->fails()) {
        # Kembali kehalaman yang sama dengan pesan error
        return Redirect::back()->withErrors($validator)->withInput();

      # Bila validasi sukses
    }

    // update data 
    $kepsek = Kepsek::select(DB::raw("kepsekId"))
      ->where('kepsekId','=',$request->id)
      ->update([
		            'kepsekNip'   => $request->kepsekNip,
		            'kepsekNama'  => $request->kepsekNama,
		            'kepsekEmail' => $request->kepsekEmail,
                'kepsekJk'    => $request->kepsekJk,
                'kepsekTtl'   => $request->kepsekTtl,
                'kepsekAlamat'=> $request->kepsekAlamat,
                'kepsekAktifM'=> $request->kepsekAktifM,
                'kepsekAktifS'=> $request->kepsekAktifS,
	    ]);
    // alihkan halaman ke halaman
    return redirect('kepsek');
  }



  public function hapus($id)
  {
    $kepsekId = Kepsek::where('kepsekId','=',$id)->first();

    if($kepsekId==null)
      App::abort(404);
    $kepsekId->delete();
    
    return Redirect::route('kepsek');

  }

}

