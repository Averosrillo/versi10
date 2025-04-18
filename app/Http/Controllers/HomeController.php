<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->query('filter');
        $view = $request->query('view', 'paginate');  

        $filterMutasi = function ($query) use ($filter) {
            if ($filter == 'topup') {
                $query->where('description', 'like', '%Top-up%');
            } elseif ($filter == 'withdraw') {
                $query->where('description', 'like', '%Withdraw%');
            } elseif ($filter == 'transfer') {
                $query->where('description', 'like', '%Transfer%');
            }

            if ($filter == 'done') {
                $query->where('status', 'done');
            } elseif ($filter == 'process') {
                $query->where('status', 'process');
            } elseif ($filter == 'rejected') {
                $query->where('status', 'reject');
            }

            return $query;
        };

        if ($user->role == 'admin') {
            $users = User::all();

            $mutasiQuery = Wallet::where('status', 'done');
            if ($view == 'all') {
                $mutasi = $filterMutasi($mutasiQuery)->orderBy('created_at', 'desc')->get();  
            } else {
                $mutasi = $filterMutasi($mutasiQuery)->orderBy('created_at', 'desc')->paginate(10);  
            }

            return view('home', compact('users', 'mutasi'));
        }

        if ($user->role == 'bank') {
            $wallet = Wallet::where('status', 'done')->get();
            $credit = $wallet->sum('credit');
            $debit  = $wallet->sum('debit');
            $saldo = $credit - $debit;
        
            $users = User::where('role', 'siswa')->get();
        
            foreach ($users as $siswa) {
                $siswa_wallet = $siswa->wallet()->where('status', 'done')->get();
                $siswa_credit = $siswa_wallet->sum('credit');
                $siswa_debit = $siswa_wallet->sum('debit');
                $siswa->saldo = $siswa_credit - $siswa_debit;
            }
        
            $request_payment = Wallet::where('status', 'process')->orderBy('created_at', 'DESC')->get();
        
            $mutasiQuery = Wallet::query(); 

            if ($view == 'all') {
                $mutasi = $filterMutasi($mutasiQuery)->orderBy('created_at', 'DESC')->get();  
            } else {
                $mutasi = $filterMutasi($mutasiQuery)->orderBy('created_at', 'DESC')->paginate(10); 
            }
        
            $allMutasi = Wallet::where('status', 'done')->count();
        
            return view('home', compact('saldo', 'users', 'request_payment', 'mutasi', 'allMutasi'));
        }        

        if ($user->role == 'siswa') {
            $wallets = Wallet::where('user_id', $user->id)->where('status', 'done')->get();
            $credit = $wallets->sum('credit');
            $debit  = $wallets->sum('debit');
            $saldo = $credit - $debit;

            $mutasiQuery = Wallet::where('user_id', $user->id)->whereIn('status', ['done', 'process', 'rejected']);
            if ($view == 'all') {
                $mutasi = $filterMutasi($mutasiQuery)->orderBy('created_at', 'desc')->get(); 
            } else {
                $mutasi = $filterMutasi($mutasiQuery)->orderBy('created_at', 'desc')->paginate(10);  
            }

            $users = User::where('role', 'siswa')->where('id', '!=', $user->id)->get();

            return view('home', compact('saldo', 'mutasi', 'users'));
        }

        return redirect()->route('home');
    }
}
