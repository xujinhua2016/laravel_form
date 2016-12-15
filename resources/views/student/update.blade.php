@extends('common.layouts')

@section('content')
    @include('common.validator')
     @include('common.message')
    <!-- 自定义内容 -->
    <div class="panel panel-default">
    <div class="panel-heading">修改学生</div>
    <div class="panel-body">
        @include('student._form')

    </div>
</div>
@stop