<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function index(){
        $voucher = Voucher::latest()->get();
        return view('page.voucher.get-voucher', [
            'vouchers' => $voucher
        ]);
    }

    public function buy($id){
        $voucher = Voucher::find($id);
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if($user->poin >= $voucher->points_required){
            $point = $user->poin - $voucher->points_required;

            UserVoucher::create([
                'user_id' => $userId,
                'voucher_id' => $id,
            ]);

            $user->update([
                'poin' => $point
            ]);
        }
        

        return redirect()->back()->with('success', 'Voucher berhasil dibeli!');
    }

    public function myVoucher(){
        $userId = Auth::user()->id;
        $vouchers = UserVoucher::where('user_id', $userId)->latest()->get();
        // dd($vouchers);
        return view('page.voucher.my-voucher',[
            'vouchers' => $vouchers
        ]);
    }
}
