
@extends("layouts.master")
@section('title') BikeShop | เพิ่มสินค้า @stop
@section('content')

<ul class="breadcrumb">
    <li><a href="{{ URL::to('product')}}">หน้าแรก</a></li>
    <li class="active">เพิ่มสินค้า</li>
</ul>



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
        <strong>เพิ่มสินค้า</strong>
    </div>
</div>

<h3>เพิ่มสินค้า</h3>

<form action="{{ url('/product/insert') }}" method="POST" enctype="multipart/form-data">
@csrf
<table>
<tr>
<td><label for="code">รหัสสินค้า </label></td>
<td><input type="text" name="code" id="code" value="{{ old('code') }}" class="form-control"></td>
</tr>
<tr>
<td><label for="name">ชื่อสินค้า </label></td>
<td><input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"></td>
</tr>
<tr>
<td><label for="category_id">ประเภทสินค้า </label></td>
<td>
    <select name="category_id" id="category_id" class="form-control">
        @foreach($categories as $id => $categoryName)
            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $categoryName }}</option>
        @endforeach
    </select>
</td>
</tr>

<tr>
<td><label for="stock_qty">คงเหลือ</label></td>
<td><input type="text" name="stock_qty" id="stock_qty" value="{{ old('stock_qty') }}" class="form-control"></td>
</tr>

<tr>
<td><label for="price">ราคาขายต่อ หน่วย</label></td>
<td><input type="text" name="price" id="price" value="{{ old('price') }}" class="form-control"></td>
</tr>
<tr>



<td><label for="image">เลือกรูปภาพสินค้า </label></td>
<td><input type="file" name="image" id="image"></td>
</tr>
</table>

<button onclick="location.href='/product'" type="reset" class="btn btn-danger">ยกเลิก</button>
<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>บันทึก</button>
</form>
@endsection