<form action="{{url('/addtochart')}}" method="POST">
    @csrf
<div class="form-group">
    <label for="exampleFormControlSelect1">BCE Field</label>
    <select class="form-control" name="standar" data-style="btn btn-link" id="bpb_menu">
        <option>Pilih Standar</option>
        <option value="standar_a">Standar A,B,C</option>
        <option value="standar_d">Standar D</option>
    </select>
    <input type="hidden" value="bpb" name="menu">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Jumlah</label>
    <input type="text" name="jumlah" class="form-control" id="jumlah">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Harga Kontrak</label>
    <input type="text" class="form-control" name="kontrak" id="kontrak">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Harga Publish</label>
    <input type="text" class="form-control" name="publish" id="publish">
</div>
<input type="submit" class="btn btn-primary" id="btn_tambah" value="Tambah">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</form>

<script>

$(document).ready(function () {
    var token = $('#token').val();
    $('#bpb_menu').on('change', function () {
        var cust = $('#customer').val();
        var jns_bayar = $('#pilihmenu').val();
        var kategori = $('#bce_menu').val();
        var token =$('#token').val();
        $.ajax({
            type: 'POST',
            url: "{{url('/getbiaya')}}",
            dataType: 'json',
            data: {
                customer: cust,
                jenis: jns_bayar,
                kategori: kategori,
                _token: token
            },
            success: function (data) {
                $('#publish').val(data[0].hrg_publish);
                $('#kontrak').val(data[0].hrg_contract);
            }

        });
    });
    var nilai = 0;
    // $('#btn_tambah').on('click', function () {
        
    //     var jumlah = $('#jumlah').val();
    //     var kategori = $('#bce_menu').val();
    //     var publish = $('#publish').val();
    //     var kontrak = $('#kontrak').val();
    //     var jns_bayar = $('#pilihmenu').val();
    //     var kategori = $('#bce_menu').val();
    //     $('#table_data').append('<tr class="child"><td class="jenis_pembayaran">'+jns_bayar+'</td><td class="kategori">' + kategori + '</td><td class="publish">' + publish + '</td><td class="jumlah-'+nilai+'">' + jumlah + '</td></tr>');
    //     nilai = nilai + 1;
    // });
    
    // $('#btn_tambah').on('click', function(){
    //     var jns_bayar = 'bce';
    //     var standar = $('#bce_menu').val();
    //     var jumlah = $('#jumlah').val();
    //     var kontrak = $('#kontrak').val();
    //     var publish = $('#publish').val();

    //     $.ajax({
    //         type: 'POST',
    //         url: '/addtochart',
    //         dataType: 'json',
    //         data: {
    //             jns_bayar: jns_bayar,
    //             standar: standar,
    //             jumlah: jumlah,
    //             kontrak:kontrak,
    //             publish:publish,
    //             _token: token
    //         },
    //         success: function (data) {
    //             console.log(data);
    //         }

    //     });
    // })

});

</script>