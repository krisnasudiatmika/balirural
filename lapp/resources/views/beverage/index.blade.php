@extends('welcome')



@section('kontent')
<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="button" onclick='window.location="{{url("/reportbeverage")}}"' value="Report Beverage" class="btn btn-primary">
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Data Telah Ditambahkan,   <a target="_blank" href="/invoice/{{ $message }}">Print Invoice</a> </strong>
</div>
@endif
@if ($message = Session::get('gagal'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{$message}} </strong>
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
                    <h4 class="card-title">Transaksi</h4>
                </div>
            </div>
            
            <div class="card-body">
                {{-- <form method="post" action="/simpanbeverage"> --}}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputPassword4">Nomor Invoice</label>
                    <input type="text" class="form-control" name="harga" placeholder="" id="invoice" value="{{$invoice}}">
                </div>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Pilih Item</label>
                        <select name="id_item" id="item" class="form-control">
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputPassword4">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="" disabled>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="">
                </div>
                <input type="hidden" value="{{ csrf_token() }}" id="_token">
                <button type="submit" id="add" class="btn btn-primary">Add</button>
            </div>

        
        </div>
    </div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Beverage</h4>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="mytable">
                    <thead>
                        <tr>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(session::get('beverage'))
                        
                        @foreach (session::get('beverage') as $item)
                         
                            <tr>
                            <td>{{$item['nama_item']}}</td>
                            <td>{{$item['harga']}}</td>
                            <td>{{$item['jumlah']}}</td>
                            <td>{{$item['total']}}</td>
                            
                            <td><button class="btn-danger" id="hapus" onclick="window.location = '{{url('/beverage-remove').'/'.$item['id_item']}}'" value="hapus"><i class="material-icons">delete</i></button></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAddress2">Diskon</label>
                        <input type="number" class="form-control" id="diskon" name="diskon" placeholder="">

                    </div>
                    <div class="form-group col-md-6">

                        <input type="button" class="btn btn-primary" id="apply_discount" value="Apply">
                    </div>
                </div> --}}

                <div class="form-group col-md-2 ml-auto">
                    <label for="inputZip">Total Harga</label>
                    <input type="text" name="total_biaya" class="form-control" id="total_biaya" value="{{$total ?? ''}}">
                    <input type="hidden" name="total_biaya_hidden" class="form-control" id="total_biaya_hidden">

                </div>
                <button type="submit" id="simpan" class="btn btn-primary">Simpan Data</button>
            </div>
            
        </div>

    </div>

</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
      var data_beverage = [];
      var index = 0;
      var token = $('#_token').val();
      var invoice ;
      $(document).ready(function () {

          var harga = 0;
          var diskon = 0;
          $('#jumlah').attr('disabled', true);
          $('#stok').attr('disabled', true);
          $.ajax({
              type: 'GET',
              url: "{{url('/selectoptionitem')}}",
              dataType: 'json',
              success: function (data) {


                  var $item = $('#item');
                  $item.empty();
                  $item.append('<option>Pilih Pilihan</option>');
                  for (var i = 0; i < data.length; i++) {
                      $item.append('<option id=' + data[i].id_item + ' value=' + data[i]
                          .id_item + '>' + data[i].nama_item + '</option>');
                  }
              }
          });
          $('#item').on('change', function () {
              var item = $(this).val();
              var token = $('#_token').val();
              $.ajax({
                  type: 'POST',
                  url: "{{url('/finditemid')}}",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: {
                      id_item: item,
                      _token: token
                  },
                  success: function (data) {
                      var data = jQuery.parseJSON(data);
                      $('#harga').val(data[0].harga);
                      $('#stok').val(data[0].stok);
                      if (data[0].stok == 0) {
                          $('#add').attr('disabled', true);
                      } else {
                          $('#add').removeAttr("disabled");
                          $('#stok').removeAttr("disabled");
                          $('#jumlah').removeAttr("disabled");
                      }

                  }
              });
          });
          $("#apply_discount").on('click', function () {
              var harga = parseInt($('#harga').val());
              var jumlah = parseInt($('#jumlah').val());
              var diskon = parseInt($('#diskon').val());
              var harga_total = harga * jumlah;
              var harga_diskon = (diskon / 100) * harga_total;
              var total_biaya = harga_total - harga_diskon;
              $('#total_biaya').val(total_biaya);

          });



        //   $('#add').on('click', function () {
        //       var item = $('#item').val();
        //       var harga = $('#harga').val();
        //       var jumlah = $('#jumlah').val();
        //       var invoice = $('#invoice').val();
        //       var total = harga * jumlah;
              

        //       var sum = 0;
        //       //iterate through each td based on class and add the values
        //       if (jumlah <= 0) {
        //           alert('sesuaikan jumlah');
        //       } else {
        //           index = index + 1;
        //           $('#mytable').append('<tr id="id' + index + '"><td>' + item + '</td><td class="price">' + harga + '</td><td>' + jumlah + '</td><td class="total_harga">' + total + '</td><td class="td-actions text-right"><button type="button" rel="tooltip" onclick="hapus(' + index + ')" class="btn btn-danger btn-round"><i class="material-icons">close</i></button></td></tr>');

                    

        //           var data = {};
        //           data.index = index;
        //           data.harga = harga;
        //           data.item = item;
        //           data.jumlah = jumlah;
        //           data.total = total;
        //           data.invoice = invoice;
                  

        //           data_beverage.push(data);
        //           console.table(data_beverage);
        //           var overall = update_harga();
        //           $('#total_biaya').val(overall);
        //       }
        //       $('#item').val(1);
        //       $('#stok').val(0);
        //       $('#jumlah').val(0);
        //       $('#harga').val(0);
        //   });

        $('#add').on('click', function () {
            var invoice = $('#invoice').val();
            var item = $('#item').val();
            var harga = $('#harga').val();
            var stok = $('#stok').val();
            var jumlah = $('#jumlah').val();

            $.ajax({
                  type: 'POST',
                  url: "{{url('/beverage-list')}}",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: {
                      invoice: invoice,
                      item: item,
                      harga: harga,
                      stok: stok,
                      jumlah: jumlah
                      
                  },
                  success: function (data) {
                    if(data == 1){
                        window.location = '{{url("/beverage")}}';
                    }else {
                        window.location = '{{url("/error")}}';
                    }

                  }
              });
        });
        //   $('#simpan').on('click', function () {
        //       var item = [];
        //       var token = $('#_token').val();
        //       var total_biaya = $('#total_biaya').val();
        //       data_beverage['_token'] = token;
        //       item = data_beverage;

        //       $.ajax({
        //           type: "POST",
        //           data: {
        //               "_token": "{{ csrf_token() }}",
        //               "item": item,
        //               "total_biaya": total_biaya

        //           },
        //           url: "/simpan_item_trx",
        //           success: function (msg) {

        //               window.location = "/flash_msg";

        //           }

        //       });


        //   });

        $('#simpan').on('click', function () {
            var invoice = $('#invoice').val();
            window.location = '{{url("/beverage-post")}}'+'/' + invoice;
        });
      });

      function update_harga() {
          var sum = 0;
          $.each(data_beverage, function (i, el) {
              sum = sum + this.total;
          });
          return sum;
      }

      function hapus(data_index) {
          $.each(data_beverage, function (i, el) {
              if (this.index == data_index) {
                  data_beverage.splice(i, 1);
              }
          });

          console.table(data_beverage);
          $('#id' + data_index).remove();
          var overall = update_harga();
          $('#total_biaya').val(overall);

      };
    
</script>
@endsection

