<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Config, Validator;

class CategoryController extends Controller
{
    //
    var $rp = 5;
    public function index(){
        $category = Category::paginate($this->rp);
        return view('category/index' , compact('category'));
    }



    public function search(Request $request){
        $query = $request->q;
        if($query){
            $category = Category::where('id','like', '%'.$query.'%')
            ->orWhere('name','like','%'.$query.'%')
            ->paginate($this->rp);
        } else {
            $category = Category::paginate($this->rp);
        }
        return view('category/index' , compact('category'));
    }



    public function edit($id = null) {
        if ($id) {
            $category = Category::find($id);
                return view('category/edit')
                ->with('category',$category); 
        } else {
            return view('category/add');
        }
        
    }


    public function update(Request $request){
        $rules = array(
            'name' => 'required',
        );

        $message = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน' ,
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = $request->id;
        $temp = array(
            'name' => $request->name,
        );
        $validator = Validator::make($temp , $rules , $message);
        if ($validator->fails()) {
            return redirect('category/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $category = Category::find($id);
        $category->name = $request->name;

        $category->save();

        return redirect('category')
        ->with('ok' , true)
        ->with('msg' , 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }


    public function remove($id) {
        Category::find($id)->delete();
        return redirect('category')
        ->with('OK' , true)
        ->with('msg' , 'ลบข้อมูลสำเร็จ');
    }

    public function insert(Request $request) {

        $rules = array(
            'name' => 'required',
        );

        $message = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน' ,
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = $request->id;
        $temp = array(
            'name' => $request->name,
        );
        $validator = Validator::make($temp , $rules , $message);
        if ($validator->fails()) {
            return redirect('category/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }




        // validation ไว้เขียนทีหลัง ความสําคัญน้อยกว่า วิธีเอาค่าจากฟอร์ม มาบันทึกครับ
        $category = new Category();
        $category->name = $request->name;
        
        //$product->save(); < ถ้าไม่ชัวร์ อย่าเพิ่งพิมพ์ save

        $category->save();
        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');

    }

}
