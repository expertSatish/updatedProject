<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helper;
use DB;
class InstallmentsController extends Controller{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    function index($Id){
        $getdata = DB::table('pricing')->where('category_id', $Id)->orderby('id', 'DESC')->get();
        $nav_heading = DB::table('nav_heading')->where('role', 6)->where('category_id', $Id)->first();
        $category_id = $Id;
        return view('control-panel.pricing.pricing-management')->with(array('getData' => $getdata, 'nav_heading' => $nav_heading, 'category_id' => $category_id));
    }
    function New($Id){
        return view('control-panel.pricing.add-pricing')->with(array('flag' => false));
    }
    function Update($Id){
        $getdata = DB::table('pricing')->where('id', $Id)->first();
        return view('control-panel.pricing.add-pricing')->with(array('flag' => true, 'array_data' => $getdata));
    }
    function Save(Request $r){
        $Category = $r->Category;
        $Title = $r->Title;
        $Currency = $r->Currency;
        $Amount = $r->Amount;
        $Description = $r->Description;
        $list = $r->list;
        $Query = DB::table('pricing')->insertGetId(['category_id' => $Category, 'title' => $Title, 'currency' => $Currency, 'amount' => $Amount,'striked_amount' => $r->striked_price, 'text' => $Description]);
        if ($Query) {
            if (!empty($list)) {
                foreach ($list as $key => $value) {
                    if (!empty($value)) {
                        DB::table('pricing_list')->insert(['title' => $value, 'pricing_id' => $Query]);
                    }
                }
            }
            return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    function Edit(Request $r, $Id){
        $Title = $r->Title;
        $Currency = $r->Currency;
        $Amount = $r->Amount;
        $Description = $r->Description;
        $list = $r->list;
        $listId =  $r->listId;
        $Query = DB::table('pricing')->where('id', $Id)->update(['title' => $Title, 'currency' => $Currency, 'amount' => $Amount,'striked_amount' => $r->striked_price, 'text' => $Description]);
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                if (!empty($value)) {
                    if (!empty($listId[$key])) {
                        DB::table('pricing_list')->where('id', $listId[$key])->update(['title' => $value]);
                    } else {
                        DB::table('pricing_list')->insert(['title' => $value, 'pricing_id' => $Id]);
                    }
                }
            }
        }
        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }
    function Remove_Lists($Id){
        if (DB::table('pricing_list')->where('id', $Id)->delete()) {
            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    function Status($Status, $Id){
        if (DB::table('pricing')->where('id', $Id)->update(['status' => $Status])) {
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    function Remove(Request $r){
        $Check = $r->check;
        foreach ($Check as $Rows) :
            DB::table('pricing')->where('id', $Rows)->delete();
        endforeach;
        return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
    }
    public function top_selling(Request $request){
        $pricing = DB::table('pricing')
            ->where('id', $request->id)
            ->first();
        $status = $pricing->top_selling;
        if ($status == 0) {
            DB::table('pricing')
                ->update([
                    'top_selling' => 0
                ]);
            DB::table('pricing')
                ->where('id', $request->id)
                ->update([
                    'top_selling' => 1
                ]);
        } else {
            DB::table('pricing')
                ->where('id', $request->id)
                ->update([
                    'top_selling' => 0
                ]);
        }
        return redirect()->back()->with('success_msg', 'Top Selling Status Change');
    }
}
