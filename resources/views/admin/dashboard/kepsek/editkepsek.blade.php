@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Kepsek</li>
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
                    <h3 class="box-title">Edit Kepsek </h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    @foreach($kepsek as $itemKepsek)
                    <form id="formKepsekEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/kepsek/update') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="{{$itemKepsek->kepsekId}}">
                      <div class="form-group">
                          <label class="col-md-4 control-label">NIP </label>
                          <div class="col-md-6 @if ($errors->has('kepsekNip')) has-error @endif">
                              <input type="number" class="form-control" name="kepsekNip" value="{{$itemKepsek->kepsekNip}}"> 
                              <small class="help-block"></small>
                          </div> 
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Nama </label>
                          <div class="col-md-6  @if ($errors->has('kepsekNama')) has-error @endif">
                              <input type="text" class="form-control" name="kepsekNama" value="{{$itemKepsek->kepsekNama}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Email </label>
                          <div class="col-md-6  @if ($errors->has('kepsekEmail')) has-error @endif">
                              <input type="email" class="form-control" name="kepsekEmail" value="{{$itemKepsek->kepsekEmail}}" multiple>
                              <small class="help-block"></small>
                         </div>
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Jenis Kelamin </label>
                          <div class="col-md-6  @if ($errors->has('kepsekJk')) has-error @endif">
                              <input type="text" class="form-control" name="kepsekJk" value="{{$itemKepsek->kepsekJk}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">TTL </label>
                          <div class="col-md-6  @if ($errors->has('kepsekTtl')) has-error @endif">
                              <input type="date" class="form-control" name="kepsekTtl" value="{{$itemKepsek->kepsekTtl}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alamat </label>
                          <div class="col-md-6  @if ($errors->has('kepsekAlamat')) has-error @endif">
                              <input type="text" class="form-control" name="kepsekAlamat" value="{{$itemKepsek->kepsekAlamat}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Aktif Mulai </label>
                          <div class="col-md-6  @if ($errors->has('kepsekAktifM')) has-error @endif">
                              <input type="date" class="form-control" name="kepsekAktifM" value="{{$itemKepsek->kepsekAktifM}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Aktif Selesai </label>
                          <div class="col-md-6  @if ($errors->has('kepsekAktifS')) has-error @endif">
                              <input type="date" class="form-control" name="kepsekAktifS" value="{{$itemKepsek->kepsekAktifS}}">
                              <small class="help-block"></small>
                         </div>
                      </div>
   
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary" id="button-reg">
                                  Simpan
                              </button>

                              
                              <a href="{{{ action('Kepsek\KepsekController@index') }}}" title="Cancel">
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

