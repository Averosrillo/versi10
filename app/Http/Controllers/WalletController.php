<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function topup(Request $request)
    {
        $request->validate([
            'credit' => 'required|numeric|min:10000'
        ]);

        Wallet::create([
            'user_id' => Auth::id(),
            'debit' => 0,
            'credit' => $request->credit,
            'description' => 'Top-up Saldo',
            'status' => 'process'
        ]);

        return redirect()->back()->with('status', 'Permintaan Top-Up anda sedang diproses');
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'credit' => 'required|numeric|min:10000'
        ]);

        $user = Auth::user();
        $totalSaldo = Wallet::where('user_id', $user->id)
            ->where('status', 'done')
            ->sum(DB::raw('credit - debit'));

        if ($totalSaldo < $request->credit) {
            return redirect()->back()->with('status', 'Saldo tidak mencukupi');
        }

        $status = ($user->role === 'siswa') ? 'process' : 'done';

        Wallet::create([
            'user_id' => $user->id,
            'debit' => $request->credit,
            'credit' => 0,
            'description' => 'Withdraw Saldo',
            'status' => $status,
        ]);

        $message = ($user->role === 'siswa') ? 'Permintaan Withdraw anda sedang diproses' : 'Withdraw berhasil';

        return redirect()->back()->with('status', $message);
    }


    public function transfer(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'recepient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $recepient = User::find($request->recepient_id);

        $wallets = Wallet::where('user_id', $user->id)->where('status', 'done')->get();
        $credit = 0;
        $debit = 0;

        foreach ($wallets as $wallet) {
            $credit += $wallet->credit;
            $debit += $wallet->debit;
        }

        $saldoPengirim = $credit - $debit;

        if ($saldoPengirim < $request->amount) {
            return redirect()->back()->with('error', 'Saldo Anda tidak cukup untuk melakukan transfer.');
        }

        Wallet::create([
            'user_id' => $user->id,
            'credit' => 0,
            'debit' => $request->amount,
            'description' => 'Transfer ke ' . $recepient->name,
            'status' => 'done',
        ]);

        Wallet::create([
            'user_id' => $recepient->id,
            'credit' => $request->amount,
            'debit' => 0,
            'description' => 'Transfer dari ' . $user->name,
            'status' => 'done',
        ]);

        return redirect()->route('home')->with('success', 'Transfer berhasil.');
    }


    public function acceptRequest(Request $request, $walletId)
    {
        $wallet = Wallet::findOrFail($walletId);
        $wallet->update(['status' => 'done']);

        return redirect()->back()->with('status', 'Permintaan Berhasil disetujui');
    }

    public function rejectRequest(Request $request, $walletId)
    {
        $wallet = Wallet::findOrFail($walletId);

        $wallet->status = 'rejected';
        $wallet->save();

        return redirect()->back()->with('status', 'Permintaan Ditolak');
    }


    public function allMutasi()
    {
        $mutasi = \App\Models\Wallet::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wallet.all', compact('mutasi'));
    }

    public function all(Request $request)
    {
        $filter = $request->input('filter');

        $query = Wallet::with('user');

        if ($filter === 'topup') {
            $query->where('description', 'Top-up');
        } elseif ($filter === 'withdraw') {
            $query->where('description', 'Withdraw');
        } elseif ($filter === 'transfer') {
            $query->where('description', 'Transfer');
        } elseif ($filter === 'rejected') {
            $query->where('status', 'rejected');
        }

        if ($filter === 'all' || !$filter) {
        }

        $mutasi = $query->orderBy('created_at', 'desc')->get();

        return view('wallet.all', compact('mutasi'));
    }

    public function bankTopupToSiswa(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:10000',
        ]);

        Wallet::create([
            'user_id' => $request->siswa_id,
            'credit' => $request->amount,
            'debit' => 0,
            'description' => 'Top-up oleh Bank',
            'status' => 'done'
        ]);

        return redirect()->back()->with('success', 'Top-up berhasil dilakukan ke siswa.');
    }

    public function bankWithdrawFromSiswa(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:10000',
        ]);

        $totalSaldo = Wallet::where('user_id', $request->siswa_id)
            ->where('status', 'done')
            ->sum(DB::raw('credit - debit'));

        if ($totalSaldo < $request->amount) {
            return redirect()->back()->with('error', 'Saldo siswa tidak mencukupi.');
        }

        Wallet::create([
            'user_id' => $request->siswa_id,
            'credit' => 0,
            'debit' => $request->amount,
            'description' => 'Withdraw oleh Bank',
            'status' => 'done'
        ]);

        return redirect()->back()->with('success', 'Withdraw berhasil dilakukan dari siswa.');
    }

    public function exportMyPDF()
    {
        if (Auth::user()->role !== 'siswa') {
            abort(403, 'Akses ditolak. Hanya siswa yang bisa mendownload ini.');
        }

        $user = Auth::user();
        $mutasi = Wallet::with('user')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $pdf = Pdf::loadView('riwayat-transaksi-pdf', compact('mutasi'));
        return $pdf->download('riwayat_transaksi_' . $user->name . '.pdf');
    }

    public function exportPDF()
    {
        $mutasi = Wallet::with('user')->get();
        $pdf = Pdf::loadView('riwayat-transaksi-pdf', compact('mutasi'));
        return $pdf->download('riwayat_transaksi.pdf');
    }
}
