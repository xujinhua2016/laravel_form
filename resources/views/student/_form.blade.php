{{--<form class="form-horizontal" role="form" method="post" action="{{ url('student/save') }}">--}}
<form class="form-horizontal" role="form" method="post" action="">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-5">
            <input type="text" name="Student[name]"
                   value="{{ old('Student')['name'] ? old('Student')['name'] : $student->name}}"
                   class="form-control" placeholder="姓名">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('Student.name') }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-5">
            <input type="text" name="Student[age]"
                   value="{{ old('Student')['age']  ? old('Student')['age'] : $student->age }}"
                   class="form-control" placeholder="年龄">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('Student.age') }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">性别</label>
        <div class="col-sm-5">
            @foreach($student->sex() as $ind =>  $val)
                <label class="radio-inline">
                    <input type="radio" name="Student[sex]"
                           {{ isset($student->sex) && $student->sex == $ind ? 'checked' : "" }}
                           value="{{ $ind }}">{{ $val }}
                </label>
            @endforeach
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('Student.sex') }}</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
</form>