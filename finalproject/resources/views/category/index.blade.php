@extends('layouts.master')
@section('title') BikeShop | รายการข้อมูลประเภทสินค้า @stop
@section('content')

<div class="container">
<h1>รายการข้อมูลประเภทสินค้า</h1>
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title"><strong>รายการ</strong></div>
</div>
<div class="panel-body">


<form action=" {{URL::to ('category/search')}}" method="post" class="form-inline">
    {{csrf_field()}}
    <input type="text" name="q" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา">
    <button type="submit" class="btn btn-primary">ค้นหา</button>
    <a href="{{ URL::to('category/edit') }}" class="btn btn-success pull-right">เพิ่มข้อมูลประเภทสินค้า</a>
</form>
</div>

<table class="table table-bordered bs-table">
<thead>
<tr>
<th>รหัส</th>
<th>ชื่อประเภทสินค้า</th>
<th>การทำงาน</th>
</tr>
</thead>
<tbody>

@foreach ($category as $c)
<tr>
    <td>{{ $c->id}}</td>
    <td>{{ $c->name}}</td>

<td class="bs-center">
<a href="{{ URL::to('category/edit/'.$c->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข </a>
<a href="{{ URL::to('category/remove/'.$c->id)}}"  onclick="return confirm('Are you sure you want to delete this item?')"  class="btn btn-danger"><i class="fa fa-trash"></i> ลบ </a>
</td>
</tr>
@endforeach
</tbody>

</div>


</table>
<div class="panel-footer">
    <span>แสดงข้อมูลจํานวน {{ count($category) }} รายการ</span>
</div>
{{$category->links()}}
@endsection