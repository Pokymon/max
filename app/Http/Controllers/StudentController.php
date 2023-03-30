<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::query();
        if (request()->has('search')) {
            $search = request()->get('search');
            $students = $students->where('name', 'like', "%{$search}%");
            $students = $students->orWhere('phone_number', 'like', "%{$search}%");
            $students = $students->orWhere('address', 'like', "%{$search}%");
        }
        $students = $students->latest()->paginate(5);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create', [
            'classes' => StudentClass::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
        ]);
        $name = $request->name;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $student_class_id = $request->student_class_id;
        $photoPath = '';
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
        }
        Student::create([
            'name' => $name,
            'phone_number' => $phone_number,
            'address' => $address,
            'student_class_id' => $student_class_id,
            'photo' => $photoPath,
        ]);
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $achievements = DB::table('achievements')
            ->join('students', 'students.id', '=', 'achievements.student_id')
            ->where('achievements.student_id', '=', $id)
            ->select('students.name as student_name', 'students.id as student_id', 'achievements.*')
            ->get();

        return $achievements;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit', [
            'student' => $student,
            'classes' => StudentClass::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
        ]);
        $name = $request->name;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $student_class_id = $request->student_class_id;
        $photoPath = '';
        if ($request->hasFile('photo')) {
            if (Student::find($id)->photo) {
                Storage::delete(Student::find($id)->photo);
            }
            $photoPath = $request->file('photo')->store('photos');
        } else {
            $photoPath = Student::find($id)->photo;
        }
        Student::find($id)->update([
            'name' => $name,
            'phone_number' => $phone_number,
            'address' => $address,
            'student_class_id' => $student_class_id,
            'photo' => $photoPath,
        ]);
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Student::find($id)->photo) {
            Storage::delete(Student::find($id)->photo);
        }
        Student::find($id)->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
