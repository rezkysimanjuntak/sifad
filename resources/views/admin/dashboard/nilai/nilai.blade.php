@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Nilai</li>
          </ol>
@stop
@section('content')
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Nilai Siswa</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="dataNilai" class="table table-bordered table-hover">
                    <thead>
                      <tr>      
                        <th>Guru Wali</th>                    
                        <th>Siswa</th>
                        <th>Kelas</th>                        
                        <th>Aksi</th> 
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($nilai as $itemNilai):  ?>
                      <tr>
                        <td>{{$itemNilai->guruNama}}</td>
                        <td>{{$itemNilai->sisNama}}</td>
                        <td>{{$itemNilai->kelasNama}}</td>
                        @if(Auth::user()->level==1)
                          <td><a href="{{{ URL::to('nilai/'.$itemNilai->guruId.'/'.$itemNilai->sisNisn.'/'.$itemNilai->kelasKode.'/detail') }}}">
                                <span class="label label-info"><i class="fa fa-list"> Lihat Nilai </i></span>
                              </a>
                          </td>
                        @else
                          <td><a href="{{{ URL::to('datanilai/'.$itemNilai->guruId.'/'.$itemNilai->sisNisn.'/'.$itemNilai->kelasKode.'/detail') }}}">
                                <span class="label label-info"><i class="fa fa-list"> Lihat Nilai </i></span>
                              </a>
                          </td>
                        @endif
                      </tr>
                      <?php endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Guru Wali</th>                    
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Aksi</th>     
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->

@endsection
@section('script')

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {

        $('#dataNilai').DataTable({"pageLength": 10});

      });

      
    </script>

@endsection

