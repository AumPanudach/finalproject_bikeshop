<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function viewCart() {
        $cart_items = Session::get('cart_items');
        return view('cart/index', compact('cart_items'));
}



public function checkout() {
    $cart_items = Session::get('cart_items');
    return view('cart/checkout', compact('cart_items'));
    }



public function addToCart($id) {

    $product = Product::find($id);

    $cart_items = Session::get('cart_items');
    if(is_null($cart_items)) {
    $cart_items = array();
    }
    
    $qty = 0;
    if(array_key_exists($product->id, $cart_items)) {
    $qty = $cart_items[$product->id]['qty'];
    }
    
    $cart_items[$product['id']] = array( 'id' => $product->id,
    'code' => $product->code,
    'name' => $product->name,
    'price' => $product->price,
    'image_url' => $product->image_url,
    'qty' => $qty + 1,
    );
    Session::put('cart_items', $cart_items);



return redirect('cart/view');
}




    public function deleteCart($id) {
    $cart_items = Session::get('cart_items');
    unset($cart_items[$id]);
    Session::put('cart_items', $cart_items);
    return redirect('cart/view');
    }



    public function updateCart($id, $qty) {
        $cart_items = Session::get('cart_items');
        $cart_items[$id]['qty'] = $qty;
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
        }




        public function complete(Request $request) { //อย่าลืม use Request ด้วย
            $cart_items = Session::get('cart_items');
            $cust_name = $request->input('cust_name');
            $cust_email = $request->input('cust_email');
            
            if(Order::all()->last() == NULL){
                $numpo = 1;
            }
            if(Order::all()->last() != NULL){
                $order = Order::all()->last();
                $numpo =  ($order->id) + 1;
            }

            date_default_timezone_set("Asia/Bangkok");
            $po_no = 'PO'.date("Ymd") . ($numpo);
            $po_date = date("Y-m-d H:i:s");
            $total_amount = 0;

            foreach($cart_items as $c) {
                $total_amount += $c['price'] * $c['qty'];
            }


            // return view('cart/complete', compact('cart_items', 'cust_name', 'cust_email', 'po_no',
            // 'po_date', 'total_amount'));
            
            $html_output = view('cart/complete', compact('cart_items', 'cust_name', 'cust_email',
            'po_no', 'po_date', 'total_amount'))->render();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->debug = true;
            $mpdf->WriteHTML($html_output);
            $mpdf->Output('output.pdf', 'I');
           
            return $resp->withHeader("Content-type", "application/pdf");
            

            
    }
    public function addtoorder(Request $request) { //อย่าลืม use Request ด้วย
        $cart_items = Session::get('cart_items');
        $cust_name = $request->input('cust_name');
        $cust_email = $request->input('cust_email');
        if(Order::all()->last() == NULL){
            $numpo = 1;
        }
        if(Order::all()->last() != NULL){
            $order = Order::all()->last();
            $numpo =  ($order->id) + 1;
        }
       
        
        date_default_timezone_set("Asia/Bangkok");
        $po_no = 'PO'.date("Ymd") . ($numpo);
        $po_date = date("Y-m-d H:i:s");


        // return view('cart/complete', compact('cart_items', 'cust_name', 'cust_email', 'po_no',
        // 'po_date', 'total_amount'));
        
        
        $Order = new Order();
        $Order->serial_po = $po_no;
        $Order->order_name = Auth::user()->name;
        $Order->order_email = $cust_email;
        $Order->user_id = Auth::user()->id;
        $Order->status = 0;
        $Order->save();

       
        foreach($cart_items as $c) {
            
        $OrderDetail = new OrderDetail();
        $OrderDetail -> order_id = $numpo;
        $OrderDetail -> product_name = $c['name'];;
        $OrderDetail -> qty = $c['qty'];
        $OrderDetail -> price = $c['price'];
        $OrderDetail->save();
        }
        
        $cart_items = Session::get('cart_items'); Session::remove('cart_items');
        
        return redirect('home')
        ->with('ok' , true)
        ->with('msg' , 'บันทึกข้อมูลเรียบร้อยแล้ว');

        //return redirect('/');

          
    }

}
