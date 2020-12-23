@extends('welcome')



@section('kontent')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
{{-- <input type="button" class="btn btn-primary" onclick="window.location= '/export_transaksi'" value="Download Excel"> --}}
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
                                    <th>Invoice</th>
                                    <th>Total Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Action</th>
                                
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                    <td>{{$item->invoice}}</td>
                                    <td>{{"Rp. ".number_format($item->jumlah_pembelian,2,',','.')}}</td>
                                   
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        {{-- <button type="button" rel="tooltip" class="btn btn-primary btn-small">
                    <i class="material-icons">print</i>
                </button> --}}
                <a href="{{url('/invoice')."/".$item->invoice}}" target="_blank"><button type="button" rel="tooltip" class="btn btn-primary btn-small">
                    <i class="material-icons">receipt</i>
                </button></a></td>
              
                    
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Total Pembayaran</th>
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