@extends('welcome')



@section('kontent')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<style type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"></style>
<style type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></style>
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
                <h4 class="card-title">Item</h4>
                <p class="card-category">Halamn untuk Item Resto</p>
            </div>
            <div class="card-body">
                <form action="/simpan_item" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nama Item</label>
                                <input type="text" name="nama_item" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Harga</label>
                                <input type="number" name="harga_item" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Jumlah Stok</label>
                                <input type="number" name="jml_stok" class="form-control">
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

                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Item</h4>
                <p class="card-category">List Item Yang Sudah Diinput</p>
            </div>
            <div class="card-body">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Item</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $items)


                        <tr>
                            <td class="text-center">3</td>
                            <td>{{$items->nama_item}}</td>
                            <td>{{$items->harga}}</td>
                            <td>{{$items->stok}}</td>
                            
                            <td class="td-actions text-right">
								<a href="/edit_item/{{$items->id_item}}">
                                <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                                    <i class="material-icons">edit</i>
								</button>
							</a>
							<a href="/delete_item/{{$items->id_item}}">
                                <button type="button" rel="tooltip" class="btn btn-danger btn-simple">
                                    <i class="material-icons">close</i>
								</button>
							</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });

</script>

@endsection
