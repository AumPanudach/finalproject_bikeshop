<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Config, Validator;

class ProductController extends Controller
{
    //
    var $rp = 5;
    public function index(){
        $products = Product::paginate($this->rp);
        return view('product/index' , compact('products'));
    }

    public function search(Request $request){
        $query = $request->q;
        if($query){
            $products = Product::where('code','like', '%'.$query.'%')
            ->orWhere('name','like','%'.$query.'%')
            ->paginate($this->rp);
        } else {
            $products = Product::paginate($this->rp);
        }
        return view('product/index' , compact('products'));
    }

    public function edit($id = null) {
        $categories = Category::pluck('name' , 'id')->prepend('เลือกรายการ' , '');
        if ($id) {
        $product = Product::find($id);
        return view('product/edit')
        ->with('product',$product)
        ->with('categories' , $categories);
        } else {
            return view('product/add')
            ->with('categories' , $categories);
        }
    }

    public function update(Request $request){
        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'required',
        );

        $message = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน' ,
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = $request->id;
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock_qty' => $request->stock_qty,
        );
        $validator = Validator::make($temp , $rules , $message);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;


        if($request->hasFile('image')){
        $f = $request->file('image');
        $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ

        // get path
        $relative_path = $upload_to.'/'.$f->getClientOriginalName();
        $absolute_path = public_path().'/'.$upload_to;
        // upload file
        $f->move($absolute_path, $f->getClientOriginalName());
        // save image path to database
        $product->image_url = $relative_path;
        //$product->save(); < บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ
        $product->save();
        }

        $product->save();


        return redirect('product')
        ->with('ok' , true)
        ->with('msg' , 'บันทึกข้อมูลเรียบร้อยแล้ว');

    }


    public function insert(Request $request) {

        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'required',
        );

        $message = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน' ,
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = $request->id;
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock_qty' => $request->stock_qty,
        );
        $validator = Validator::make($temp , $rules , $message);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }


        // validation ไว้เขียนทีหลัง ความสําคัญน้อยกว่า วิธีเอาค่าจากฟอร์ม มาบันทึกครับ
        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;
        //$product->save(); < ถ้าไม่ชัวร์ อย่าเพิ่งพิมพ์ save
        if($request->hasFile('image')) //ไว้เขียนทีหลัง ความสําคัญน้อยกว่า วิธีเอาค่าจากฟอร์ม มาบันทึก
        {
            $f = $request->file('image');
            $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ
    
            // get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            // upload file
            $f->move($absolute_path, $f->getClientOriginalName());
            // save image path to database
            $product->image_url = $relative_path;
            //$product->save(); < บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ
            $product->save();
        }

        $product->save();
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');
        }


        public function remove($id) {
            Product::find($id)->delete();
            return redirect('product')
            ->with('OK' , true)
            ->with('msg' , 'ลบข้อมูลสำเร็จ');
        }


}
