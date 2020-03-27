<?php

namespace App\Http\Controllers\Auth;

use App\Course;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Student;
use App\Teacher;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'course_id' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Student
     */
    public function indexStudent()
    {
        $course = Course::all();
        $current = "student";
        return view('auth\register', compact('current', 'course'));
    }

    public function indexTeacher()
    {
        $current = "teacher";
        return view('auth\register', compact('current'));
    }

    protected function createStudent(Request $request)
    {
        $user = new Student();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->course_id = $request->input('course_id');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect()->route('adm.students.list');
    }

    protected function createTeacher(Request $request)
    {
        $user = new Teacher();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect()->route('adm.teachers.list');
    }
}
