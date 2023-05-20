<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class CouponController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function coupon_add(Request $request)
    {
        return view('control-panel.coupons.coupon-add');
    }

    public function coupon_save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'percentage' => 'required|numeric',
            'start_date' => 'required|after:yesterday',
            'end_date' => 'required|after:start_date',
        ]);
        $start_date = date("Y-m-d", strtotime($request->start_date));
        $end_date = date("Y-m-d", strtotime($request->end_date));
        $percentage = $request->percentage;
        if ($percentage <= 100 && $percentage > 0) {
            $is_exist = DB::table('coupon')->where('name', $request->name)->first();
            if (isset($is_exist)) {
                $request->flash();
                return redirect()->back()->with(['error_msg' => 'Coupon Already Exist'])->withInput();
            } else {
                $name = strtoupper($request->name);
                DB::table('coupon')
                    ->insert([
                        'name' => $name,
                        'percentage' => $request->percentage,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ]);
                return redirect('/control-panel/coupon-list')->with(['success_msg' => 'Coupon Added Successfully']);
            }
        } else {
            $request->flash();
            return redirect()->back()->with(['error_msg' => 'Percentage should between 1 to 100'])->withInput();
        }
    }

    public function coupon_list(Request $request)
    {
        $coupons = DB::table('coupon')->get();
        return view('control-panel.coupons.coupon-list', ['coupons' => $coupons]);
    }

    public function coupon_status(Request $request)
    {
        $coupon = DB::table('coupon')->where('coupon_id', $request->id)->first();
        $status = $coupon->status;
        if ($status == 0) {
            DB::table('coupon')
                ->where('coupon_id', $request->id)
                ->update([
                    'status' => 1
                ]);
        } else {
            DB::table('coupon')
                ->where('coupon_id', $request->id)
                ->update([
                    'status' => 0
                ]);
        }
        return redirect('/control-panel/coupon-list')->with(['success_msg' => 'Coupon Status Change']);
    }

    public function coupon_edit(Request $request)
    {
        $coupon = DB::table('coupon')->where('coupon_id', $request->id)->first();
        return view('control-panel.coupons.coupon-edit', ['coupon' => $coupon]);
    }

    public function coupon_update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'percentage' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required|after:start_date',
        ]);
        $start_date = date("Y-m-d", strtotime($request->start_date));
        $end_date = date("Y-m-d", strtotime($request->end_date));
        $name = strtoupper($request->name);
        $percentage = $request->percentage;
        if ($percentage <= 100 && $percentage > 0) {
            DB::table('coupon')->where('coupon_id', $request->id)
                ->update([
                    'name' => $name,
                    'percentage' => $percentage,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                ]);
            return redirect('/control-panel/coupon-list')->with(['success_msg' => 'Coupon Updated Successfully']);
        } else {
            $request->flash();
            return redirect()->back()->with(['error_msg' => 'Percentage should between 1 to 100'])->withInput();
        }
    }

    public function coupon_delete(Request $request)
    {
        DB::table('coupon')->where('coupon_id', $request->id)->delete();
        return redirect('/control-panel/coupon-list')->with(['success_msg' => 'Coupon Deleted Successfully']);
    }
}
