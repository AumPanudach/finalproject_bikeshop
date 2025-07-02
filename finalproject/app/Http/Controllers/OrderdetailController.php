<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    var $rp = 5;

    public function index($id){           
        $orderdetail = Order::find($id);
        return view('orderdetail/index' , compact('orderdetail'));
}

    public function editstatus1 ($id) {
        $Order = Order::find($id);
        $Order->status = 1;
        $Order->save();
        return redirect('order');
    }

    public function editstatus2 ($id) { 
        $Order = Order::find($id);
        $Order->status = 0;
        $Order->save();
        return redirect('order');
    }
}

