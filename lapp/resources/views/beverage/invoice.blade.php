INVOICE - {{$invoice->invoice}}
{{$invoice->created_at}}
Bali Rural Commune
Desa Kuliang Kangin, Bangli, Bali - Indonesia
<table class="table">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Harga</th>
                
            </tr>
        </thead>
        <tbody>
@foreach ($data as $item)

        <tr>
        <td class="text-center">{{$item->nama_item}}</td>
            <td>{{$item->harga}}</td>
            <td>{{$item->jumlah}}</td>
            <td>{{$item->harga_total}}</td>
        </tr>
      
        
  
@endforeach
</tbody>
    <table>
        <tr>
                <td>Total</td>
                <td>{{$invoice->jumlah_pembelian}}</td>
        </tr>
    </table>
</table>