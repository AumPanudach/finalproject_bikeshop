@extends("layouts.master")
@section('title') Management System | ระบบจัดการการสั่งซื้อสินค้า @stop
@section('content')

<h1>แก้ไขผู้ใช้ </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขผู้ใช้ </li>
</ul>

{!! Form::model($user, array('action' => 'App\Http\Controllers\UserController@update', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $user->id }}">
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>ข้อมูลผู้ใช้ </strong>
        </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="panel-body">
    <table>
        <tr>
            <td>{{ Form::label('name', 'ชื่อผู้ใช้ ') }}</td>
            <td>{{ Form::text('name', $user->name, ['class' => 'form-control']) }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('email', 'email ') }}</td>
            <td>{{ Form::text('email', $user->email, ['class' => 'form-control']) }}</td>
        </tr>   
       
    </table>
</div>

<div class="panel-footer">
    <button type="reset" class="btn btn-danger">ยกเลิก</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
</div>
{!! Form::close() !!}

@endsection