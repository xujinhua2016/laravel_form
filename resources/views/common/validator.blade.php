<!-- 错误提示 -->
@if(count($errors))
    <div class="alert alert-danger" role="alert">
        <ul>
            {{--只显示第一行错误信息--}}
            <li>{{ $errors->first() }}</li>
            {{--@foreach($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        </ul>
    </div>
@endif