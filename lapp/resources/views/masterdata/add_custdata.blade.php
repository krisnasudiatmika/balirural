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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Tambah Master Data Biaya</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <form method="post" action="{{url('/simpanmasterdata')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Customer</label>
                            <select class="form-control" id="customer" name="id_customer">
                                <option>Pilih Customer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jenis Pembayaran</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="jenis_pembayaran">
                                <option>Pilih Opsi</option>
                                <option value="bce">Bali Culinary Experience</option>
                                <option value="vt">Village Trekking</option>
                                <option value="rbc">Rural Bali Cycling</option>
                                <option value="dwb">A Day With Balinese</option>
                                <option value="bpb">Balinese Purification Blessing</option>
                                <option value="lwn">Lunch With Nature</option>
                                <option value="hbw">Holistic Balinese Wedding</option>
                                <option value="ghs">Guliang Home Stay</option>
                                <option value="rt">Return Transfer Rates & Pick Up Time</option>
                                <option value="pm">Night Market</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Sub Pembayaran</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                <option value="standar_a">Standar A,B,C</option>
                                <option value="standar_d">Standar D</option>
                                <option value="default">default</option>
                                <option value="20to39">20 to 39 Person</option>
                                <option value="40to49">40 to 49 Person</option>
                                <option value="50to59">50 to 59 Person</option>
                                

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Harga Publish</label>
                            <input type="number" class="form-control" name="hrg_publish">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Harga Contract</label>
                            <input type="number" class="form-control" name="hrg_contract">
                        </div>

                        <input type="submit" value="Simpan" class="btn btn-primary">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: "{{url('/selectoptioncustomer')}}",
        dataType: 'json',
        success: function (data) {
            
            console.log(data);
            var $customer = $('#customer');
            $customer.empty();
            for (var i = 0; i < data.length; i++) {
                $customer.append('<option id=' + data[i].tour_operators + ' value=' + data[i].id + '>' + data[i].tour_operators + '</option>');
            }
        }
    });
});
</script>

@endsection