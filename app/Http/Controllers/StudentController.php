<?php
namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //student list page
    public function index()
    {
        $students = Student::paginate(4);       //设置分页，每页显示两个数据
        return view('student.index',[
            'students' => $students,
         ]);
    }
    
    //新增页面
    public function create(Request $request)
    {
        $student = new Student();

        if($request->isMethod('post')){

//            //控制器验证，有异常，阻塞在当前界面
//            $this->validate($request,[
//                'Student.name' => 'required|min:2|max:20',
//                'Student.age' => 'required|integer',
//                'Student.sex' => 'required|integer',
//            ],
//                ['required'=>':attribute为必填项',
//                    'min'=>':attribute最小长度',
//                    'max'=>':attribute最大长度',
//                    'integer'=>':attribute必须为数字'
//            ],
//                ['Student.name'=>'姓名','Student.age'=>'年龄','Student.sex'=>'性别']);
//            //异常来之一个中间件shareError，错误信息保存在全局变量$errors中

            //Validator类验证
            $validator = Validator::make($request->input(),
                [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
                 ],
                ['required'=>':attribute为必填项',
                    'min'=>':attribute最小长度',
                    'max'=>':attribute最大长度',
                    'integer'=>':attribute必须为数字'
                ],
                ['Student.name'=>'姓名',
                    'Student.age'=>'年龄',
                    'Student.sex'=>'性别'
                ]
            );
            //如果有错误
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }



            $data = $request->input('Student');
            if(Student::create($data)){
                return redirect('student/index')->with('success','添加成功');
            }else{
                return redirect()->back();
            }
        }

        return view('student.create',[
            'student' => $student,
        ]);
    }

    //提交按钮到达保存界面
    public function save(Request $request)
    {
        $data = $request->input('Student');

        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if($student->save()){
            return redirect('student/index');
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request,$id)
    {
        $student = Student::find($id);

        if ($request->isMethod('post')){

            $this->validate($request,[
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ],
                ['required'=>':attribute为必填项',
                    'min'=>':attribute最小长度',
                    'max'=>':attribute最大长度',
                    'integer'=>':attribute必须为数字'
            ],
                ['Student.name'=>'姓名','Student.age'=>'年龄','Student.sex'=>'性别']);

            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];

            if($student->save()){
                return redirect('student/index')->with('success','修改成功-'.$id);
            }
        }

        return view('student.update',[
            'student'=>$student,
        ]);
    }

    public function detail($id)
    {
        $student = Student::find($id);
        return view('student.detail',[
            'student'=>$student
        ]);
    }

    public function delete($id)
    {
        $student = Student::find($id);
        if($student->delete()){
            return redirect('student/index')->with('success','删除成功-'.$id);
        }else{
            return redirect('student/index')->with('error','删除失败-'.$id);
        }
    }
}