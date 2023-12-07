<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('tbl_dbeli')->get();

        return Inertia::render('Transaksi/Index', [
            'transaksi' => $transaksi
        ]);
    }

    public function create()
    {
        return Inertia::render('Transaksi/Create', [
            'suplier' => Suplier::all(),
            'barang' => Barang::all()
        ]);
    }

    public function store(Request $request)
    {
        $transaksi = DB::table('tbl_hbeli')->orderBy('id', 'desc')->first();
        $nomorTransaksi = '';

        $validated = $request->validate([
            'qyt' => ['required'],
            'diskon' => ['required'],
            'id_suplier' => ['required'],
            'id_barang' => ['required']
        ]);

        $suplier = Suplier::find($validated['id_suplier']);
        $barang = Barang::find($validated['id_barang']);

        if($transaksi){
            $nomorTransaksi = 'B'.date('Y').date('m').strval($transaksi->id + 1);
        }else{
            $nomorTransaksi = 'B'.date('Y').date('m').strval(1);
        }

        $totalrp = $validated['qyt'] * $barang->hargabeli;
        $diskonrp = $totalrp * ($validated['diskon'] / 100);

        DB::table('tbl_hbeli')->insert([
            'notransaksi' => $nomorTransaksi,
            'kodespl' => $suplier->kodespl,
            'tglbeli' => today()
        ]);

        DB::table('tbl_dbeli')->insert([
            'notransaksi' => $nomorTransaksi,
            'kodebrg' => $barang->kodebrg,
            'hargabeli' => $barang->hargabeli,
            'qyt' => $validated['qyt'],
            'diskon' => $validated['diskon'],
            'diskonrp' => $diskonrp,
            'totalrp' => $totalrp
        ]);

        DB::table('tbl_stock')->upsert(
            [
                'kodebrg' => $barang->kodebrg,
                'qytbeli' => $validated['qyt']
            ],
            ['kodebrg'],
            ['qytbeli']
        );

        DB::table('tbl_hutang')->upsert(
            [
                'notransaksi' => $nomorTransaksi,
                'kodespl' => $suplier->kodespl,
                'tglbeli' => today(),
                'totalhutang' => $totalrp 
            ],
            ['notransaksi'],
            ['totalhutang']
        );

        return to_route('transaksi.index');
    }
}
