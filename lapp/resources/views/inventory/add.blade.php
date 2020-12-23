@extends('welcome')



@section('kontent')
   {{-- menampilkan error validasi --}}
   @if (count($errors) > 0)
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
   @endif
   @if( Session::has("success") )
<div class="alert alert-success alert-block" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("success") }}
</div>
@endif

@if( Session::has("error") )
<div class="alert alert-danger alert-block" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("error") }}
</div>
@endif
<button class="btn btn-primary" onclick="window.location = '{{url('/inventory-all')}}'">List Inventory</button>
<div class="row">
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
              <div class="card-text">
                <h4 class="card-title">Tambah Data Inventory</h4>
              </div>
            </div>
            <div class="card-body">
                    <form action="{{url('/inventory-save')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Inventory</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="nama_inventory" value="{{old('tour_operators')}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah Baik</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name ="baik" value="{{old('address')}}">
                               
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah Rusak</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="rusak" value="{{old('contact')}}">
                               
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah Keseluruhan</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="total" value="{{old('title')}}">
                                
                            </div>
                           
                            
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            
                        </form>
            </div>
        </div>
    </div>
</div>


@endsection
