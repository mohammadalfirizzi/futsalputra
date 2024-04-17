<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FutsalController extends Controller
{
    public function home()
    {
        $cekuser = DB::table('users')->first()->role;
        return view('futsal.home', ['cekuser' => $cekuser]);
    }

    public function find()
    {
        $lapangan = DB::table('courts')
            ->join('court_types', 'court_types.id', '=', 'courts.court_type')
            ->select('courts.id', 'courts.court_type', 'courts.name', 'courts.price', 'court_types.name as court_type_name')
            ->get();
        $jam = DB::table('jam')->get();
        return view('futsal.find', ['lapangan' => $lapangan, 'jam' => $jam]);
    }

    public function checkFind(Request $request)
    {
        $tanggal = $request->tanggal;
        $lapangan = $request->lapangan;
        $jam = $request->jam;

        $find = DB::table('transactions')
            ->where('date', $tanggal)
            ->where('court_id', $lapangan)
            ->where(function ($query) use ($jam) {
                $query->where('starttime', '<=', $jam)
                    ->where('endtime', '>', $jam);
            })
            ->first();
        if ($find == NULL) {
            $nama_lapangan = DB::table('courts')
                ->join('court_types', 'courts.court_type', '=', 'court_types.id')
                ->where('courts.id', '=', $lapangan)
                ->select('courts.id', 'courts.court_type', 'courts.name', 'courts.price', 'court_types.name as court_type_name')
                ->first();
            return view('futsal.booking', ['tanggal' => $tanggal, 'jam' => $jam, 'nama_lapangan' => $nama_lapangan]);
        } else {
            return 'Lapangan Full tidak bisa dibooking';
        }
    }

    public function checkBooking(Request $request)
    {
        $date = $request->tanggal;
        $court_id = $request->lapangan;
        $starttime = $request->jam;
        $duration = $request->duration;
        $endtime = strtotime($starttime) + 60 * 60 * $duration;
        $endtime = date('H:i:s', $endtime);
        $shoes = $request->sepatu ? 1 : 0;
        $costume = $request->kaos ? 1 : 0;
        $grandtotal = $request->grandtotal;
        $paytotal = $request->paytotal;
        $find = DB::table('transactions')
            ->where('date', $date)
            ->where('court_id', $court_id)
            ->where(function ($query) use ($endtime) {
                $query->where('starttime', '<=', $endtime)
                    ->where('endtime', '>', $endtime);
            })
            ->first();
        if ($find == NULL) {
            if ($paytotal < $grandtotal) {
                return 'Kurang nih';
            } else {
                $tambah = DB::table('transactions')->insert([
                    'user_id' => 1,
                    'name' => "Rizzi",
                    'address' => "Kediri",
                    'phone' => "0838934",
                    'date' => $date,
                    'court_id' => $court_id,
                    'starttime' => $starttime,
                    'endtime' => $endtime,
                    'duration' => $duration,
                    'costume' => $costume,
                    'shoes' => $shoes,
                    'total' => $grandtotal,
                    'grandtotal' => $grandtotal,
                    'paytotal' => $paytotal
                ]);
            }
        } else {
            return 'lapangan udah dibooking nih';
        }
    }

    public function daftarbooking()
    {
        $data = DB::table('transactions')
            ->join('courts', 'transactions.court_id', '=', 'courts.id')
            ->join('court_types', 'courts.court_type', '=', 'court_types.id')
            ->select('transactions.*', 'courts.name as court_name', 'court_types.name as court_type_name')
            ->orderBy('transactions.created_at', 'desc')
            ->paginate(2);
        return view('futsal.daftarbooking', ['data' => $data]);
    }

    public function riwayattransaksi()
    {
        $data = DB::table('transactions')
            ->orderBy('transactions.created_at', 'desc')
            ->paginate(2);
        return view('futsal.riwayattransaksi', ['data' => $data]);
    }

    public function daftarlapangan()
    {
        $data = DB::table('courts')
            ->join('court_types', 'courts.court_type', '=', 'court_types.id')
            ->select('courts.*', 'court_types.name as court_type_name')
            ->get();
        return view('futsal.daftarlapangan', ['data' => $data]);
    }
}
