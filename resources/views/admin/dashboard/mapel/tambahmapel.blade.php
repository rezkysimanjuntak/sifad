@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Mapel</li>
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
                    <h3 class="box-title">Tambah Mapel </h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <form id="formMapelTambah" class="form-horizontal" role="form" method="POST" action="{{ url('/mapel/tambahmapel') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      <div class="form-group">
                          <label class="col-md-4 control-label">Kode </label>
                          <div class="col-md-6 @if ($errors->has('mapelKode')) has-error @endif">
                              <input type="number" class="form-control" name="mapelKode" value="{{Request::old('mapelKode')}}" min="1">
                              <small class="help-block"></small>
                          </div> 
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Nama </label>
                          <div class="col-md-6  @if ($errors->has('mapelNama')) has-error @endif">
                              <input type="text" class="form-control" name="mapelNama" value="{{Request::old('mapelNama')}}">
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Kelas </label>
                          <div class="col-md-6  @if ($errors->has('mapelKelasId')) has-error @endif">
                              <select class="form-control" name="mapelKelasId" value="{{Request::old('mapelKelasId')}}" required>
                                @foreach($kelas as $itemKelas)
                                    <option value="{{ $itemKelas->kelasKode }}">Kelas {{ $itemKelas->kelasKode }}</option>
                                @endforeach
                              </select>
                              <small class="help-block"></small>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Kurikulum </label>
                          <div class="col-md-6  @if ($errors->has('mapelKurId')) has-error @endif">
                              <select class="form-control" name="mapelKurId" value="{{Request::old('mapelKurId')}}" required>
                                @foreach($kurikulum as $itemKurikulum)
                                    <option value="{{ $itemKurikulum->kurId }}">{{ $itemKurikulum->kurId }}</option>
                                @endforeach
                              </select>
                              <small class="help-block"></small>
                         </div>
                      </div>
   
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary" id="button-reg">
                                  Simpan
                              </button>

                              
                              <a href="{{{URL::to('mapel')}}}" title="Cancel">
                              <button type="button" class="btn btn-default" id="button-reg">
                                  Cancel
                              </button>
                              </a>  
                          </div>
                      </div>
                      </form>   
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
          </div><!-- /.row (main row) -->
            
@endsection

