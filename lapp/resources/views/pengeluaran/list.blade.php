@extends('welcome')



@section('kontent')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<div class="row">
    
        <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                          <i class="material-icons">language</i>
                        </div>
                      </div>
            <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    
                                    <th>Jenis Pengeluaran</th>
                                    <th>Jumlah Pengeluaran</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                    <td>{{$item->jenis_pengeluaran}}</td>
                                    <td>{{"Rp.".number_format($item->jml_pengeluaran,2,',','.')}}</td>
                                    <td>{{$item->keterangan}}</td>
                                    <td>{{$item->created_at}}</td>
                    
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                        <th>Jenis Pengeluaran</th>
                                        <th>Jumlah Pengeluaran</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                </tr>
                            </tfoot>
                        </table>
            </div>
        </div>
   
</div>


<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection