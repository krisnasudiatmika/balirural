<?php

namespace App\Http\Controllers;

use App\Beverage;
use App\BeverageTransaksi;
use App\bvg_transaksi;
use App\Customers;
use App\Customer_master;
use App\Exports\TransaksiExport;
use App\Inventory;
use App\Item;
use App\Pengeluaran;
use App\Transaksi;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Input;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/pembayaran');
    }
    public function item()
    {
        $item = Item::all();

        return view('item_input', ['item' => $item]);
    }
    public function save_item(Request $req)
    {
        $this->validate($req, [
            'nama_item' => 'required',
            'harga_item' => 'required|numeric',
            'jml_stok' => 'required|numeric',
            'kategori' => 'required',
        ]);

        Item::create([
            'nama_item' => $req->nama_item,
            'kategori' => $req->kategori,
            'harga' => $req->harga_item,
            'stok' => $req->jml_stok,
        ]);
        return redirect('/item')->with('success', 'Item Tersimpan!');
    }
    public function get_session()
    {
        $userId = Auth::id();
        echo $userId;
    }
    public function add_customer()
    {
        return view('customer/input');
    }
    public function save_customer(Request $req)
    {
        $this->validate($req, [
            'tour_operators' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'title' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        Customers::create([
            'tour_operators' => $req->tour_operators,
            'address' => $req->address,
            'contact' => $req->contact,
            'fax' => $req->fax,
            'title' => $req->title,
            'phone' => $req->phone,
            'email' => $req->email,

        ]);

        return redirect('/customer')->with('success', 'Data Customer Tersimpan!');
    }
    public function masterdata()
    {

    }
    public function add_masterdata()
    {

    }
    public function pembayaran()
    {
        $data = DB::table('transaksi')->latest('id')->first();
        $no_invoice = '';
        $number = 0;
        if (empty($data->id)) {
            $number = 0;
            $no_invoice = 'BC' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
            $number = $data->id + 1;
            $no_invoice = 'BC' . str_pad($number, 4, '0', STR_PAD_LEFT);
        }

        return view('transaksi.ontransaksi', ['invoice' => $no_invoice])->with('success', 'Data Ditambahkan');

    }
    public function invoice()
    {
        $data = DB::table('transaksi')->latest('id')->first();
        $no_invoice = '';
        $number = 0;
        if (empty($data->id)) {
            $number = 0;
            $no_invoice = 'BC' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
            $number = $data->id + 1;
            $no_invoice = 'BC' . str_pad($number, 4, '0', STR_PAD_LEFT);
        }

        return $no_invoice;
    }
    public function bce_template()
    {
        return view('transaksi.bce');
    }
    public function vt_template()
    {
        return view('transaksi.vt');
    }
    public function rbc_template()
    {
        return view('transaksi.rbc');
    }
    public function bpb_template()
    {
        return view('transaksi.bpb');
    }
    public function add_masterdatacustomer()
    {
        return view('masterdata.add_custdata');
    }
    public function dwb_template()
    {
        return view('transaksi.dwb');
    }
    public function lwn_template()
    {
        return view('transaksi.lwn');
    }
    public function hbw_template()
    {
        return view('transaksi.hbw');
    }
    public function ghs_template()
    {
        return view('transaksi.ghs');
    }
    public function pm_template()
    {
        return view('transaksi.pm');
    }

    public function selectoptioncustomer()
    {
        $customer = Customers::all();
        return $customer->toJson(JSON_PRETTY_PRINT);

    }
    public function simpanmasterdata(Request $req)
    {
        $this->validate($req, [
            'id_customer' => 'required',
            'jenis_pembayaran' => 'required',
            'kategori' => 'required',
            'hrg_publish' => 'required|numeric',
            'hrg_contract' => 'required|numeric',

        ]);

        Customer_master::create([
            'id_customer' => $req->id_customer,
            'jenis' => $req->jenis_pembayaran,
            'kategori' => $req->kategori,
            'hrg_publish' => $req->hrg_publish,
            'hrg_contract' => $req->hrg_contract,

        ]);

        return redirect('/add_masterdata')->with('success', 'Data Tersimpan!');

    }
    public function get_masterdata_trx(Request $req)
    {

        $result = Customer_master::where([
            'id_customer' => $req->customer,
            'jenis' => $req->jenis,
            'kategori' => $req->kategori,
        ])->get();

        return $result->toJson(JSON_PRETTY_PRINT);

    }
    public function simpanPembayaran(Request $req)
    {
        $data = $req->data;
        foreach ($data as $key) {
            # code...
            Transaksi::create([
                'id_transaksi' => $key['id_transaksi'],
                'id_customer' => $key['id_customer'],
                'jenis_pembayaran' => $key['jenis_pembayaran'],
                'kategori_pembayaran' => $key['kategori'],
                'jumlah' => $key['jumlah'],
                'total' => $key['publish'],

            ]);
        }

        return '1';

    }
    public function list_transaksi(Request $req)
    {
        $start_date = $req->start_date;
        $end_date = $req->end_date;
        if (isset($start_date) && isset($end_date)) {
            $query = bvg_transaksis::where(DB::Raw("(DATE(created_at))"), '>=', $start_date)
                ->where(DB::Raw("(DATE(created_at))"), '<=', $end_date)
                ->get();
        } else if (isset($start_date)) {
            $query = DB::table('bvg_transaksis')->where(DB::Raw("(DATE(created_at))"), $start_date)->get();
        }
        return view('transaksi.all', ['data' => $query]);
    }
    public function filter_transaksi()
    {
        return view('transaksi.filter');
    }
    public function pengeluaran()
    {
        return view('pengeluaran.index');
    }
    public function save_pengeluaran(Request $req)
    {
        $this->validate($req, [
            'jenis_pengeluaran' => 'required',
            'jumlah_pengeluaran' => 'required|numeric',
            'keterangan' => 'required',

        ]);
        Pengeluaran::create([
            'jenis_pengeluaran' => $req->jenis_pengeluaran,
            'jml_pengeluaran' => $req->jumlah_pengeluaran,
            'keterangan' => $req->keterangan,
        ]);

        return redirect('/pengeluaran')->with('success', 'Item Tersimpan!');

    }
    public function delete_item($id)
    {

        Item::where('id_item', $id)->delete();
        return redirect('/item')->with('success', 'Item Berhasil Terhapus!');
    }
    public function edit_item($id)
    {
        $result = Item::where('id_item', $id)->orderBy('id_item', 'desc')->get();
        return view('item.edit', ['data' => $result]);

    }
    public function simpan_edit_item(Request $req)
    {
        $id = $req->id;
        $nama_item = $req->nama_item;
        $harga = $req->harga_item;
        $stok = $req->jml_stok;

        Item::where('id_item', $id)->update(['nama_item' => $nama_item, 'stok' => $stok, 'harga' => $harga]);
        return redirect('/item')->with('success', 'Item Berhasil Terupdate!');
    }
    public function generateInvoice()
    {
        //mengambil data dari table orders
        $order = Beverage::orderBy('created_at', 'DESC');
        //jika sudah terdapat records
        if ($order->count() > 0) {
            //mengambil data pertama yang sdh dishort DESC
            $order = $order->first();
            //explode invoice untuk mendapatkan angkanya
            $explode = $order->id + 1;
            return 'INV-' . $explode;
        }
        //jika belum terdapat records maka akan me-return INV-1
        return 'INV-1';
    }
    public function beverage()
    {
        $total = 0;
        if (Session::has('beverage')) {

            $data = session::get('beverage');

            foreach ($data as $key) {
                # code...
                $total = $total + $key['total'];
            }
        }
        $new_invoice = $this->generateInvoice();
        return view('beverage.index', ['invoice' => $new_invoice, 'total' => $total]);
    }
    public function selectoptionitem()
    {
        $item = DB::table('item')
            ->whereNull('deleted_at')
            ->get();
        return $item->toJson(JSON_PRETTY_PRINT);
    }
    public function get_item_id(Request $req)
    {
        $id = $req->id_item;
        $item = DB::table('item')
            ->where('id_item', $id)
            ->get();
        return $item->toJson(JSON_PRETTY_PRINT);
    }
    public function simpanbeverage(Request $req)
    {
        $this->validate($req, [
            'stok' => 'required|not_in:0',
            'jumlah' => 'required|not_in:0',

        ]);

        $id_item = $req->id_item;
        $stok = $req->stok;
        $jumlah = $req->jumlah;
        $total_stok = $stok - $jumlah;
        $diskon = $req->diskon;
        $total_biaya_hidden = $req->total_biaya_hidden;
        $total_biaya = $req->total_biaya;

        Beverage::create([
            'id_item' => $id_item,
            'jumlah' => $jumlah,
            'harga_total' => $total_biaya_hidden,
            'diskon' => $diskon,
            'summary_price' => $total_biaya,
        ]);
        DB::table('item')->where('id_item', $id_item)->update(array('stok' => $total_stok));

        return redirect('/beverage')->with('success', 'Item Berhasil Terupdate!');

    }
    public function export_transaksi()
    {
        return Excel::download(new TransaksiExport('2019-12-01', '2019-12-05'), 'siswa.xlsx');
    }
    public function reportpengeluaran()
    {
        return view('pengeluaran.report');
    }
    public function list_pengeluaran(Request $req)
    {
        $start_date = $req->start_date;
        $end_date = $req->end_date;
        if (isset($start_date) && isset($end_date)) {
            $query = Pengeluaran::where(DB::Raw("(DATE(created_at))"), '>=', $start_date)
                ->where(DB::Raw("(DATE(created_at))"), '<=', $end_date)
                ->get();
        } else if (isset($start_date)) {
            $query = DB::table('pengeluaran')
                ->where(DB::Raw("(DATE(created_at))"), $start_date)->get();
        }
        return view('pengeluaran.list', ['data' => $query]);
    }
    public function reportbeverage()
    {
        return view('beverage.report');
    }
    public function list_beverage(Request $req)
    {
        $start_date = $req->start_date;
        $end_date = $req->end_date;
        if (isset($start_date) && isset($end_date)) {
            $query = bvg_transaksis::where(DB::Raw("(DATE(beverage.created_at))"), '>=', $start_date)
                ->where(DB::Raw("(DATE(created_at))"), '<=', $end_date)
                ->get();
        } else if (isset($start_date)) {
            $query = DB::table('bvg_transaksis')
                ->where(DB::Raw("(DATE(created_at))"), $start_date)->get();
        }
        return view('beverage.list', ['data' => $query]);
    }
    public function beverageSearch(Request $request)
    {
        $fromDate = $request->get('start_date');
        $toDate = $request->get('end_date');
        if (empty($fromDate) && empty($toDate)) {
            return redirect('/beverage');
        }
        $results = bvg_transaksi::whereBetween('bvg_transaksis.created_at', array($fromDate, $toDate))
            ->get();
        return view('beverage.list', ['data' => $results]);

    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('/login');
    }
    public function set_cookie_beverage(Request $response)
    {

        $data = array(
            'name' => 'krisnaa',
            'hp' => 'testing5',
        );
        Cookie::make('testing', json_encode($data), 60);

    }
    public function get_cookie_beverage()
    {
        $value = Cookie::get('testing');
        $new = json_decode($value);
        echo $value;
    }
    public function simpan_item_trx(Request $req)
    {
        $item = $req->item;
        $total_biaya = $req->total_biaya;
        DB::beginTransaction();
        try {
            foreach ($item as $key) {
                # code...
                $id_item = $key["item"];
                $jumlah = $key["jumlah"];
                $harga_total = $key["total"];
                $invoice = $key["invoice"];

                $cek_item = Item::where('id_item', '=', $id_item)->first();

                $new_stok = ($cek_item->stok) - $jumlah;
                Item::where('id_item', $id_item)
                    ->update(['stok' => $new_stok]);

                Beverage::create([
                    'id_item' => $key["item"],
                    'jumlah' => $key["jumlah"],
                    'harga_total' => $key["total"],
                    'invoice' => $key["invoice"],

                ]);

            }
            bvg_transaksi::create([
                'jumlah_pembelian' => $total_biaya,
                'invoice' => $invoice,

            ]);

            DB::Commit();

        } catch (\Throwable $e) {
            //throw $th;
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 400);
        }

    }
    public function get_invoice_detail($no)
    {
        $total = 0;
        $data = DB::table('beverage')
            ->where('beverage.invoice', '=', $no)
            ->join('bvg_transaksis', 'bvg_transaksis.invoice', '=', 'beverage.invoice')
            ->join('item', 'item.id_item', '=', 'beverage.id_item')
            ->get();
        foreach ($data as $key) {
            # code...
            $total = $total + $key->harga_total;
        }
        $invoice = DB::table('bvg_transaksis')
            ->where('invoice', '=', $no)
            ->first();

        return view('beverage.beverage-small', ['data' => $data, 'invoice' => $invoice, 'total' => $total]);

    }
    public function addtochart(Request $req)
    {

        $data = array('jns_bayar' => $req->menu,
            'jumlah' => $req->jumlah,
            'kontrak' => $req->kontrak,
            'publish' => $req->publish,
            'standar' => $req->standar,
        );
        if ($req->session()->has('chart')) {
            $req->session()->push('chart', $data);
        } else {
            $req->session()->push('chart', $data);
        }
        return redirect('/pembayaran');

    }
    public function clear_session(Request $req)
    {
        $req->session()->forget('chart');
        echo "Data telah dihapus dari session.";
    }
    public function clearBeverageCart(Request $req)
    {
        $req->session()->forget('beverage');
        echo "Data telah dihapus dari session.";
    }
    public function simpan_transaksi(Request $req)
    {
        $customer = $req->customer;
        $invoice = $req->invoice;
        $total = 0;
        $chart = session::get('chart');
        foreach ($chart as $key) {
            $total = $key['publish'];
        }
        BeverageTransaksi::create([
            'id_transaksi' => $invoice,
            'id_customer' => $customer,
            'jumlah_pembayaran' => $total,
        ]);
        foreach ($chart as $key) {
            # code...
            Transaksi::create([
                'id_transaksi' => $invoice,
                'id_customer' => $customer,
                'jenis_pembayaran' => $key['jns_bayar'],
                'kategori_pembayaran' => $key['standar'],
                'jumlah' => $key['jumlah'],
                'total' => $total,

            ]);
        }
        $req->session()->forget('chart');
        echo json_encode('sukses');

    }
    public function searchCustomers(Request $request, Transaksi $trx)
    {
        $fromDate = $request->get('start_date');
        $toDate = $request->get('end_date');
        if (empty($fromDate) && empty($toDate)) {
            return redirect('/pembayaran');
        }
        $results = BeverageTransaksi::whereBetween('beverage_transaksi.created_at', array($fromDate, $toDate))->groupBy('id_transaksi')
            ->select('customers.tour_operators', 'beverage_transaksi.id_transaksi', 'beverage_transaksi.jumlah_pembayaran', 'beverage_transaksi.created_at')
            ->join('customers', 'customers.id', '=', 'beverage_transaksi.id_customer')
            ->get();
        return view('transaksi.search', ['data' => $results]);
    }
    public function searchDateResult($fromDate, $toDate, Transaksi $trx)
    {
        $trx = $trx->newQuery();

        $trx->whereBetween('created_at', [$fromDate, $toDate]);

        $results = $trx->get();

        return response()->json($results);
    }
    public function invoice_trx($id)
    {
        DB::enableQueryLog();
        $total = 0;
        $result = DB::select(DB::raw("SELECT transaksi.id_transaksi, transaksi.created_at, customer_masters.hrg_contract, customer_masters.hrg_publish, transaksi.jumlah, master_menus.keterangan as jenis, master_standars.keterangan as kategori   FROM transaksi join customer_masters on customer_masters.id_customer = transaksi.id_customer join master_standars on master_standars.id_standar = transaksi.kategori_pembayaran join master_menus on master_menus.id_menu = transaksi.jenis_pembayaran WHERE transaksi.id_transaksi = :somevariable and transaksi.jenis_pembayaran = customer_masters.jenis and transaksi.kategori_pembayaran = customer_masters.kategori"), array(
            'somevariable' => $id,
        ));
        foreach ($result as $key) {
            # code...
            $total = $total + $key->hrg_publish;
        }
        $NumberTRX = BeverageTransaksi::where('id_transaksi', $id)
            ->select('beverage_transaksi.id_transaksi', 'beverage_transaksi.created_at', 'beverage_transaksi.jumlah_pembayaran', 'customers.tour_operators')
            ->join('customers', 'customers.id', '=', 'beverage_transaksi.id_customer')
            ->first();

        return view('beverage.invoice-form', ['data' => $result, 'customer' => $NumberTRX, 'total_price' => $total]);
    }
    public function slice_cart($id, Request $request)
    {
        $products = Session::get('chart');
        foreach ($products as $key => $value) {
            if ($value["jns_bayar"] == $id) {
                Session::pull('chart.' . $key);
            }
        }

        return redirect()->back();
        // //put back in session array without deleted item

    }
    public function inventory()
    {
        return view('inventory.add');
    }
    public function inventory_all()
    {
        $result = Inventory::All();
        return view('inventory.all', ['data' => $result]);
    }
    public function save_inventory(Request $req)
    {
        Inventory::create([
            'nama_inventory' => $req->input('nama_inventory'),
            'baik' => $req->input('baik'),
            'rusak' => $req->input('rusak'),
            'total' => $req->input('total'),

        ]);
        return redirect('/inventory')->with('success', 'Item Tersimpan!');
    }
    public function get_inventory(Request $req)
    {
        $id = $req->id;

        $result = Inventory::where('id', $id)->get();
        return response()->json($result);

    }
    public function inventorySaveUpdate(Request $req)
    {
        $nama_inv = $req->nama_inventory;
        $baik = $req->baik;
        $rusak = $req->rusak;
        $total = $req->total;
        $id = $req->id;

        $data = array('nama_inventory' => $nama_inv,
            'baik' => $baik,
            'rusak' => $rusak,
            'total' => $total,
        );

        DB::table('inventories')
            ->where('id', $id) // find your user by their email
            ->limit(1) // optional - to ensure only one record is updated.
            ->update($data);

        return redirect('/inventory-all');

    }
    public function pengeluaranSearch(Request $req)
    {
        $start_date = $req->get('start_date');
        $end_date = $req->get('end_date');
        $results = Pengeluaran::whereBetween('created_at', array($start_date, $end_date))->get();
        return view('pengeluaran.list', ['data' => $results]);

    }
    public function dashboard()
    {
        return view('dashboard.home');
    }
    public function beverageBills()
    {
        return view('beverage.invoice-form');
    }
    public function beverageList(Request $req)
    {

        $jumlah = $req->jumlah;
        $stok = $req->stok;
        if ($jumlah <= 0 || $stok <= 0) {
            return 0;
        }
        $result = Item::where('id_item', $req->item)->first();
        $namaItem = $result->nama_item;
        $data = array('id_item' => $req->item,
            'nama_item' => $namaItem,
            'jumlah' => $req->jumlah,
            'harga' => $req->harga,
            'stok' => $req->stok,
            'invoice' => $req->invoice,
            'total' => ($req->harga) * $req->jumlah,
        );
        if ($req->session()->has('beverage')) {
            $req->session()->push('beverage', $data);
        } else {
            $req->session()->push('beverage', $data);
        }

        return 1;
    }
    public function beveragePost(Request $req, $id)
    {
        $msg = 'It is done, <a href="' . url('/user/profile') . '"> click here  </a>  to see the result';
        Session::flash('success', $msg);
        $data = session::get('beverage');
        $total = 0;
        $invoice = $data[0]['invoice'];
        foreach ($data as $key) {
            # code...
            $total = $total + $key['total'];
            Beverage::create([
                'id_item' => $key['id_item'],
                'jumlah' => $key['jumlah'],
                'harga_total' => $key['total'],
                'invoice' => $key['invoice'],
            ]);
            $result = Item::where('id_item', $key['id_item'])->first();
            $stok = $result->stok;
            $newStok = $stok - $key['jumlah'];
            DB::table('item')
                ->where('id_item', $key['id_item'])
                ->update(['stok' => $newStok]);
        }

        bvg_transaksi::create([
            'jumlah_pembelian' => $total,
            'invoice' => $invoice,
        ]);
        $req->session()->forget('beverage');
        return redirect('/beverage')->withSuccess($id);
    }
    public function removeItem($id)
    {
        $products = Session::get('beverage');
        foreach ($products as $key => $value) {
            if ($value["id_item"] == $id) {
                Session::pull('beverage.' . $key);
            }
        }

        return redirect()->back();
    }

}
