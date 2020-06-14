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
                        <th>NISN Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai Tugas</th>
                        <th>Nilai UH</th>
                        <th>Nilai UTS</th>
                        <th>Nilai UAS</th>
                        <th>Nilai Perilaku</th>
                        <th>Keterangan</th>       
                        <th>Aksi</th> 
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($nilai as $itemNilai):  ?>
                      <tr>
                        <td>{{$itemNilai->sisNisn}}</td>
                        <td>{{$itemNilai->sisNama}}</td>
                        <td>{{$itemNilai->mapelNama}}</td>
                        <td>{{$itemNilai->nilaiTugas}}</td>
                        <td>{{$itemNilai->nilaiUh}}</td>
                        <td>{{$itemNilai->nilaiUts}}</td>
                        <td>{{$itemNilai->nilaiUas}}</td>
                        <td>{{$itemNilai->nilaiPerilaku}}</td>
                        <td>{{$itemNilai->nilaiKeterangan}}</td>
                        @if(Auth::user()->level==1)
                        @else
                            <td><a href="{{{ URL::to('datanilai/'.$itemNilai->nilaiId.'/edit') }}}">
                                  <span class="label label-warning"><i class="fa fa-list"> Edit </i></span>
                                </a>
                            </td>
                        @endif
                      </tr>
                      <?php endforeach  ?> 

                      <?php foreach ($nilaisd as $itemNilaiS):  ?>
                      <tr>
                        <td>{{$itemNilaiS->sisNisn}}</td>
                        <td>{{$itemNilaiS->sisNama}}</td>
                        <td>{{$itemNilaiS->mapelNama}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @if(Auth::user()->level==1)
                        @else
                            <td><a href="{{{ URL::to('datanilai/'.$itemNilai->guruId.'/'.$itemNilai->sisNisn.'/'.$itemNilai->mapelKode.'/tambah') }}}">
                                  <span class="label label-success"><i class="fa fa-list"> Tambah </i></span>
                                </a>
                            </td>
                        @endif
                      </tr>
                      <?php endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>NISN Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai Tugas</th>
                        <th>Nilai UH</th>
                        <th>Nilai UTS</th>
                        <th>Nilai UAS</th>
                        <th>Nilai Perilaku</th>
                        <th>Keterangan</th>                         
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

