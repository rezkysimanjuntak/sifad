@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Siswa</li>
          </ol>
@stop
@section('content')
<div class="row">
            <div class="col-md-6">
                <div class="box-body flash-message" data-uk-alert>
                    <a href="" class="uk-alert-close uk-close"></a>
                    <p>{{  isset($successMessage) ? $successMessage : '' }}</p>
                     @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Edit Siswa </h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    @foreach($siswa as $itemSiswa)
                    <form id="formSiswaEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/siswa/update') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="{{$itemSiswa->sisNisn}}">
                      <div class="form-group">
                          <label class="col-md-4 control-label">NIS </label>
                          <div class="col-md-6 @if ($errors->has('sisNis')) has-error @endif">
                              <input type="number" class="form-control" name="sisNis" value="{{$itemSiswa->sisNis}}" min="1" readonly="true"> 
                              <small class="help-block"></small>
                          </div> 
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Nama </label>
                          <div class="col-md-6  @if ($errors->has('sisNama')) has-error @endif">
                              <input type="text" class="form-control" name="sisNama" value="{{$itemSiswa->sisNama}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Email </label>
                          <div class="col-md-6  @if ($errors->has('sisEmail')) has-error @endif">
                              <input type="email" class="form-control" name="sisEmail" value="{{$itemSiswa->sisEmail}}" multiple>
                              <small class="help-block"></small>
                         </div>
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Jenis Kelamin </label>
                          <div class="col-md-6  @if ($errors->has('sisJk')) has-error @endif">
                              <input type="text" class="form-control" name="sisJk" value="{{$itemSiswa->sisJk}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">TTL </label>
                          <div class="col-md-6  @if ($errors->has('sisTtl')) has-error @endif">
                              <input type="date" class="form-control" name="sisTtl" value="{{$itemSiswa->sisTtl}}" required>
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alamat </label>
                          <div class="col-md-6  @if ($errors->has('sisAlamat')) has-error @endif">
                              <input type="text" class="form-control" name="sisAlamat" value="{{$itemSiswa->sisAlamat}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Kelas </label>
                          <div class="col-md-6  @if ($errors->has('sisKelasKode')) has-error @endif">
                              <select class="form-control" name="sisKelasKode" value="{{$itemSiswa->sisKelasKode}}" required>
                                <option value="1">Kelas 1</option>
                                <option value="2">Kelas 2</option>
                                <option value="3">Kelas 3</option>
                                <option value="4">Kelas 4</option>
                                <option value="5">Kelas 5</option>
                                <option value="6">Kelas 6</option>
                              </select>
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Angkatan </label>
                          <div class="col-md-6  @if ($errors->has('sisAngkatan')) has-error @endif">
                              <input type="number" class="form-control" name="sisAngkatan" value="{{$itemSiswa->sisAngkatan}}" min="1" required>
                              <small class="help-block"></small>
                         </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-4 control-label">Status Aktif </label>
                          <div class="col-md-6  @if ($errors->has('sisStatusAktif')) has-error @endif">
                              <select class="form-control" name="sisStatusAktif" value="{{$itemSiswa->sisStatusAktif}}">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                              </select>
                              <small class="help-block"></small>
                         </div>
                      </div>
   
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary" id="button-reg">
                                  Simpan
                              </button>

                              
                              <a href="{{{URL::to('siswa')}}}" title="Cancel">
                              <button type="button" class="btn btn-default" id="button-reg">
                                  Cancel
                              </button>
                              </a>  
                          </div>
                      </div>
                      </form>
                      @endforeach
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
          </div><!-- /.row (main row) -->
            
@endsection

