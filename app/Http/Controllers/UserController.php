<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Config, Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    var $rp = 5;

    public function __construct() { 
        $this->rp = Config::get('app.result_per_page');
    }

    public function index() {
        // $users = User::all();
        $users = User::paginate($this->rp);
        return view('user/index', compact('users'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
            $users = User::where('name', 'like', '%'.$query.'%')->paginate($this->rp);
        } else {
            $users = User::paginate($this->rp);
        }
        return view('user/index', compact('users'));
    }

    public function edit($id = null) {
        if($id) {
            $user = User::where('id', $id)->first(); 
            return view('user/edit')->with('user', $user);
        } else {
            return view('user/add');
        }
    }

    public function update(Request $request) {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
           
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        );

        $id = $request->id;
        $temp = array(
        
            'name' => $request->name, 
            'email' => $request->email, 
            
            
        );

        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('user/edit/'.$id)->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name = $request->name; 
        $user->email = $request->email;

        $user->save();

        return redirect('user')->with('ok', true)->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');;
    }

    public function insert(Request $request) {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        );

        $id = $request->id;
        $temp = array(
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => $request->password, 
            
        );

        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('user/edit/'.$id)->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name; 
        $user->email = $request->email; 
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('user')->with('ok', true)->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');
    }

    

    public function remove($id) {

        $test = User::find($id);
        $data = $test->detail;
         foreach( $data as $key ){
            return redirect('user')->with('notok', true)->with('msg', 'ลบข้อมูลไม่สําเร็จ');
         }
         User::find($id)->delete();
         return redirect('user')->with('ok', true)->with('msg', 'ลบข้อมูลสําเร็จ');

        
    }
}