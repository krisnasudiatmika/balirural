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
                                    <th>Nomor Invoice</th>
                                    <th>Total Pembayaran</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Action</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                    <td>{{$item->id_transaksi}}</td>
                                    <td>{{"Rp.".number_format($item->jumlah_pembayaran,2,',','.')}}</td>
                                    <td>{{$item->tour_operators}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                <a href="{{url('/invoice_trx')."/".$item->id_transaksi}}" target="_blank"><button type="button" rel="tooltip" class="btn-small btn-primary">
                    <i class="material-icons">receipt</i>
                </button></a></td>
              
                    
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nomor Invoice</th>
                                    <th>Total Pembayaran</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Action</th> 
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