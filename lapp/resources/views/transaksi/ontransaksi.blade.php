@extends('welcome')



@section('kontent')
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

<button class="btn btn-primary">Guliang Home Stay</button><button class="btn btn-primary">Rent Car</button>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transaksi</h4>
                <p class="category">Halaman ini digunakan untuk proses transaksi</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Nomor Transaksi</label>
                <input type="text" name="invoice" id="invoice" class="form form-control" value="{{$invoice}}" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Customers</label>
                    <select class="form-control" data-style="btn btn-link" id="customer">
                        <option>Pilih Opsi</option>
                        <option>Bali Historical Data</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Jenis Pembayaran</label>
                    <select class="form-control" data-style="btn btn-link" id="pilihmenu">
                        <option>Pilih Opsi</option>
                        <option value="bce">Bali Culinary Experience</option>
                        <option value="vt">Village Trekking</option>
                        <option value="rbc">Rural Bali Cycling</option>
                        <option value="dwb">A Day With Balinese</option>
                        <option value="bpb">Balinese Purification Blessing</option>
                        <option value="lwn">Lunch With Nature</option>
                        <option value="hbw">Holistic Balinese Wedding</option>
                        <option value="pm">Pasar Malam Night Market</option>
                       
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Pilihan Sub-Menu</h4>
                </div>
            </div>
            <div class="card-body">
                <div id="option_menu"></div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Tabel Transaksi</h4>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="table_data">
                    <thead>
                        <tr>

                            <th>Jenis</th>
                            <th>Kategori</th>
                            <th>Harga Kontrak</th>
                            <th>Harga Publish</th>
                            <th>Jumlah</th>

                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session::get('chart'))
                            
                            @foreach (session::get('chart') as $item)
                                <tr>
                                <td>{{$item['jns_bayar']}}</td>
                                <td>{{$item['standar']}}</td>
                                <td>{{$item['kontrak']}}</td>
                                <td>{{$item['publish']}}</td>
                                <td>{{$item['jumlah']}}</td>
                                <td><button class="btn-danger" id="hapus" onclick="window.location = '{{url('/remove-item').'/'.$item['jns_bayar']}}'" value="hapus"><i class="material-icons">delete</i></button></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<input type="button" class="btn btn-primary" value="Simpan" id="simpan_trx">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#customer').attr("disabled", false);
        $('#pilihmenu').attr("disabled", false);

        $('#pilihmenu').on('change', function () {
            if (this.value == "bce") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_bce')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "vt") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_vt')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "rbc") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_rbc')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "dwb") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_dwb')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "bpb") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_bpb')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "lwn") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_lwn')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "hbw") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_hbw')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "ghs") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_ghs')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }
            if (this.value == "pm") {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/pilih_pm')}}",
                    success: function (data) {
                        $("#option_menu").html(data);

                    }
                });
            }

            $('#customer').attr("disabled", true);
        });
        $.ajax({
            type: 'GET',
            url: "{{url('/selectoptioncustomer')}}",
            dataType: 'json',
            success: function (data) {


                var $customer = $('#customer');
                $customer.empty();
                for (var i = 0; i < data.length; i++) {
                    $customer.append('<option id=' + data[i].tour_operators + ' value=' + data[i]
                        .id + '>' + data[i].tour_operators + '</option>');
                }
            }
        });
        // $('#simpan_trx').on('click', function () {
        //     var data_trx = new Array();
        //     var data = {};
        //     var token = $('#token').val();
        //     $('#table_data .child').each(function (index) {
        //         var customer = $('#customer').val();
        //         var jumlah = $(this).find(".jumlah-" + index).text();
                
        //         var jenis_pembayaran = $(this).find(".jenis_pembayaran").html();
        //         var kategori = $(this).find(".kategori").html();
        //         var publish = $(this).find(".publish").html();
        //         var invoice = $('#invoice').val();


        //         data_trx.push({
        //             jumlah: jumlah,
        //             jenis_pembayaran: jenis_pembayaran,
        //             kategori: kategori,
        //             publish: publish,
        //             id_customer: customer,
        //             id_transaksi: invoice
        //         });

        //     });
        //     $.ajax({
        //         type: 'POST',
        //         url: "/save_pembayaran",
        //         headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //         data: {
        //             data: data_trx,
        //             _token: token
        //         },
        //         success: function (data) {
        //             if(data == 1){
        //                 window.location = '/pembayaran';
        //             }
        //         }
        //     });
            
        // });

        $('#simpan_trx').on('click', function(){
            var customer = $('#customer').val();
            var token = $('#token').val();
            var invoice = $('#invoice').val();
            $.ajax({
            type: 'POST',
            url: "{{url('/save_transaksi')}}",
            dataType: 'json',
            data: {
                customer: customer,
                invoice : invoice,
                _token: token
            },
            success: function (data) {
                console.log(data);
                window.location = '{{url("/flash_msg")}}';
            }

        });
        });

    });
</script>
@endsection