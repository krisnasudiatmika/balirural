@extends('welcome')



@section('kontent')
@if(count($errors) > 0)

<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<input type="button" class="btn btn-primary" onclick="window.location = '{{url('/reportpengeluaran')}}'" value="List Pengeluaran">
<div class="row">
   
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Data Pengeluaran</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('/save_pengeluaran')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Pengeluaran</label>
                        <select class="form-control" name="jenis_pengeluaran">
                            <option>Pilih Pengeluaran</option>
                            <option value="cos">Cost on Sales</option>
                            <option value="ohc">Offer Head Cost</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Pengeluaran</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="jumlah_pengeluaran">

                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            name="keterangan"></textarea>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection