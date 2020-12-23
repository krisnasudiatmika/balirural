@extends('welcome')



@section('kontent')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Edit Item</h4>
                <p class="card-category">Halamn untuk Edit Item Resto</p>
            </div>
            @foreach ($data as $item)
            <div class="card-body">
                <form action="{{url('/simpan_edit_item')}}" method="post">
                    {{ csrf_field() }}
                    
                        
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nama Item</label>
                            <input type="text" name="nama_item" class="form-control" value="{{$item->nama_item}}">
                            <input type="hidden" value="{{$item->id_item}}" name="id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Harga</label>
                                <input type="number" name="harga_item" class="form-control" value="{{$item->harga}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Jumlah Stok</label>
                                <input type="number" name="jml_stok" class="form-control" value="{{$item->stok}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pilih Kategori</label>
                                <select class="form-control" name="kategori" data-style="btn btn-link"
                                    id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection