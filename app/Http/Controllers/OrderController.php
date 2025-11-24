<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    function index(){   
    $order = Order::all();
    return view('order.index' , compact('order'));

    }
}
