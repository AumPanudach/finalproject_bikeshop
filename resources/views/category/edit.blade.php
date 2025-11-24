
@extends("layouts.master")
@section('title') BikeShop | แก้ไขข้อมูลประเภทสินค้า @stop
@section('content')
<h1>แก้ไขข้อมูลประเภทสินค้า </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('category')}}">หน้าแรก</a></li>
    <li class="active">แก้ไขข้อมูลประเภทสินค้า</li>
</ul>



<form action="{{ url('/category/update') }}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="{{$category->id}}">
@csrf
@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <div> {{$error}}</div>
    @endforeach
</div>
@endif
<div class="panel panel-default">
<div class="panel-heading">
    <div class="panel-title">
        <strong>ข้อมูลสินค้า</strong>
    </div>
</div>
<div class="panel-body">
<table>

<tr>
    <td><label for="name">ชื่อสินค้า</label> </td>
    <td><input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control"></td>
</tr>


</table>
<br>

<button onclick="location.href='/category'" type="reset" class="btn btn-danger">ยกเลิก</button>
<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>บันทึก</button>
</div>
</div>
</form>
@endsection