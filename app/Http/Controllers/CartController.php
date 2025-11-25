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
use Mpdf\Mpdf;

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




        public function complete(Request $request) {
            $cart_items = Session::get('cart_items');
            
            // Check if cart is empty
            if (!$cart_items || count($cart_items) == 0) {
                return redirect('cart/view')
                    ->with('ok', false)
                    ->with('msg', 'ตะกร้าสินค้าว่างเปล่า');
            }
            
            $cust_name = $request->input('cust_name');
            $cust_email = $request->input('cust_email');
            
            if(Order::all()->last() == NULL){
                $numpo = 1;
            } else {
                $order = Order::all()->last();
                $numpo = ($order->id) + 1;
            }

            date_default_timezone_set("Asia/Bangkok");
            $po_no = 'PO'.date("Ymd") . sprintf('%04d', $numpo);
            $po_date = date("Y-m-d H:i:s");
            $total_amount = 0;

            foreach($cart_items as $c) {
                $total_amount += $c['price'] * $c['qty'];
            }

            // Generate HTML for PDF
            $html_output = view('cart/complete', compact('cart_items', 'cust_name', 'cust_email',
                'po_no', 'po_date', 'total_amount'))->render();
            
            try {
                // Create PDF
                $mpdf = new Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 15,
                    'margin_right' => 15,
                    'margin_top' => 15,
                    'margin_bottom' => 15,
                ]);
                
                $mpdf->WriteHTML($html_output);
                
                // Output PDF to browser
                return response()->streamDownload(function() use ($mpdf) {
                    echo $mpdf->Output('', 'S');
                }, 'invoice-' . $po_no . '.pdf', [
                    'Content-Type' => 'application/pdf',
                ]);
                
            } catch (\Exception $e) {
                return redirect('cart/checkout')
                    ->with('ok', false)
                    ->with('msg', 'เกิดข้อผิดพลาดในการสร้าง PDF: ' . $e->getMessage());
            }
    }
    public function addtoorder(Request $request) {
        $cart_items = Session::get('cart_items');
        
        // Check if cart is empty
        if (!$cart_items || count($cart_items) == 0) {
            return redirect('cart/view')
                ->with('ok', false)
                ->with('msg', 'ตะกร้าสินค้าว่างเปล่า');
        }
        
        $cust_name = $request->input('cust_name');
        $cust_email = $request->input('cust_email');
        
        if(Order::all()->last() == NULL){
            $numpo = 1;
        } else {
            $order = Order::all()->last();
            $numpo = ($order->id) + 1;
        }
        
        date_default_timezone_set("Asia/Bangkok");
        $po_no = 'PO'.date("Ymd") . sprintf('%04d', $numpo);
        $po_date = date("Y-m-d H:i:s");

        try {
            // Create Order
            $Order = new Order();
            $Order->serial_po = $po_no;
            $Order->order_name = Auth::user()->name;
            $Order->order_email = $cust_email;
            $Order->user_id = Auth::user()->id;
            $Order->status = 0;
            $Order->save();

            // Create Order Details
            foreach($cart_items as $c) {
                $OrderDetail = new OrderDetail();
                $OrderDetail->order_id = $Order->id;
                $OrderDetail->product_name = $c['name'];
                $OrderDetail->qty = $c['qty'];
                $OrderDetail->price = $c['price'];
                $OrderDetail->save();
            }
            
            // Clear cart
            Session::remove('cart_items');
            
            return redirect('home')
                ->with('ok', true)
                ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว เลขที่ใบสั่งซื้อ: ' . $po_no);
                
        } catch (\Exception $e) {
            return redirect('cart/checkout')
                ->with('ok', false)
                ->with('msg', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

}
