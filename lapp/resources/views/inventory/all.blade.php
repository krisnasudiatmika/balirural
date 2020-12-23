@extends('welcome')



@section('kontent')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <th>Nama Inventory</th>
                                    <th>Jumlah Baik</th>
                                    <th>Jumlah Rusak</th>
                                    <th>Total</th>
                                    <th>Tanggal Update</th>   
                                    <th>Action</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data ?? '' as $item)
                                    <tr>
                                    <td>{{$item->nama_inventory}}</td>
                                    <td>{{$item->baik}}</td>
                                    <td>{{$item->rusak}}</td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                <button data-toggle="modal" id="{{$item->id}}" data-target="#exampleModal" type="button" rel="tooltip" class="btn-small btn-primary edit-data">
                    <i class="material-icons">receipt</i>
                </button></td>
              
                    
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Inventory</th>
                                    <th>Jumlah Baik</th>
                                    <th>Jumlah Rusak</th>
                                    <th>Total</th>
                                    <th>Tanggal Update</th>   
                                    <th>Action</th>   
                                </tr>
                            </tfoot>

                         
                        </table>
            </div>
        </div>
   
</div>

{{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="{{url('/inventory-save-update')}}">
          {{csrf_field()}}
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Inventory</label>
            <input type="text" class="form-control" name="nama_inventory" id="nama_inv">  
          </div>  
          <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Baik</label>
            <input type="text" class="form-control" name="baik" id="baik">  
          </div>  
          <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Rusak</label>
            <input type="text" class="form-control" name="rusak" id="rusak">  
          </div>  
          <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Total</label>
            <input type="text" class="form-control" name="total" id="total"> 
            <input type="hidden" class="form-control" name="id" id="id"> 
          </div>  
        </div>
      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </form>
  </div>
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<script>
    var token;
    $(document).ready(function () {
        $('#example').DataTable();
        token = $('#token').val();
    });
    $(document).on('click','.edit-data',function(){
        var id = $(this).attr('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({

            type: 'POST',
            url: '{{url("/inventory-get")}}',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function (data) {
                console.log(data[0].nama_inventory);
                $('#nama_inv').val(data[0].nama_inventory);
                $('#baik').val(data[0].baik);
                $('#rusak').val(data[0].rusak);
                $('#total').val(data[0].total);
                $('#id').val(data[0].id);
            }

        });


    });

</script>
@endsection