@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Guru</li>
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
                    <h3 class="box-title">Edit Guru </h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    @foreach($guru as $itemGuru)
                    <form id="formGuruEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/guru/update') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="kelas" value="{{$itemGuru->mapelKelasId}}">
                      <input type="hidden" name="id" value="{{$itemGuru->guruId}}">
                      <div class="form-group">
                          <label class="col-md-4 control-label">NIP </label>
                          <div class="col-md-6 @if ($errors->has('guruNip')) has-error @endif">
                              <input type="number" class="form-control" name="guruNip" value="{{$itemGuru->guruNip}}"> 
                              <small class="help-block"></small>
                          </div> 
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Nama </label>
                          <div class="col-md-6  @if ($errors->has('guruNama')) has-error @endif">
                              <input type="text" class="form-control" name="guruNama" value="{{$itemGuru->guruNama}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Email </label>
                          <div class="col-md-6  @if ($errors->has('guruEmail')) has-error @endif">
                              <input type="email" class="form-control" name="guruEmail" value="{{$itemGuru->guruEmail}}" multiple>
                              <small class="help-block"></small>
                         </div>
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Jenis Kelamin </label>
                          <div class="col-md-6  @if ($errors->has('guruJk')) has-error @endif">
                              <input type="text" class="form-control" name="guruJk" value="{{$itemGuru->guruJk}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">TTL </label>
                          <div class="col-md-6  @if ($errors->has('guruTtl')) has-error @endif">
                              <input type="date" class="form-control" name="guruTtl" value="{{$itemGuru->guruTtl}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alamat </label>
                          <div class="col-md-6  @if ($errors->has('guruAlamat')) has-error @endif">
                              <input type="text" class="form-control" name="guruAlamat" value="{{$itemGuru->guruAlamat}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Aktif Mulai </label>
                          <div class="col-md-6  @if ($errors->has('guruAktifM')) has-error @endif">
                              <input type="date" class="form-control" name="guruAktifM" value="{{$itemGuru->guruAktifM}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Aktif Selesai </label>
                          <div class="col-md-6  @if ($errors->has('guruAktifS')) has-error @endif">
                              <input type="date" class="form-control" name="guruAktifS" value="{{$itemGuru->guruAktifS}}">
                              <small class="help-block"></small>
                         </div>
                      </div>
   
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary" id="button-reg">
                                  Simpan
                              </button>

                              
                              <a href="{{{ action('Guru\GuruController@index') }}}" title="Cancel">
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

