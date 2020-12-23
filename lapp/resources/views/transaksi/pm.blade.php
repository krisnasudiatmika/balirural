<form action="{{url('/addtochart')}}" method="POST">
    @csrf
<div class="form-group">
    <label for="exampleFormControlSelect1">Guliang Home Stay Field</label>
    <select class="form-control" name="standar" data-style="btn btn-link" id="pm_menu">
        <option>Pilih Standar</option>
        <option value="20to39">20 to 39 Person</option>
        <option value="40to49">40 to 49 Person</option>
        <option value="50to60">50 to 60 Person</option>
    </select>
    <input type="hidden" value="hbw" name="menu">
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
    $('#pm_menu').on('change', function () {
        var cust = $('#customer').val();
        var jns_bayar = $('#pilihmenu').val();
        var kategori = $(this).val();
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