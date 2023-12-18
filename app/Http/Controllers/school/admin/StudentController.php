<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudent;
use App\Http\Requests\StudentRequest;
use App\Models\Section;
use App\Models\Student;
use App\Repositories\Interefaces\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    protected $student;
    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return $this->student->index();
    }


    public function create()
    {
        return $this->student->create();
    }


    public function store(StudentRequest $request)
    {
        return $this->student->store($request);
    }


    public function edit(Student $student)
    {
        return $this->student->edit($student);
    }


    public function update(StudentRequest $request)
    {
        return $this->student->update($request);
    }


    public function show(Student $student)
    {
        return$this->student->show($student);
    }


    public function destroy(Request $request)
    {
        return $this->student->destroy($request);
    }


    public function addPhotoFromDetails(Request $request) 
    {
        return $this->student->addPhotoFromDetails($request);
    }


    public function deletePhotoFromDetails(Request $request)
    {
        return $this->student->deletePhotoFromDetails($request);
    }


    public function downloadPhoto($studentEmail , $fileName){

        return $this->student->downloadPhoto($studentEmail , $fileName);
    }



        public function viewFile($studentName , $fileName){

            return $this->student->viewFile($studentName , $fileName);

        }


        public function studentInformation()
        {

            $ids= DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
            $students = Student::whereIn('section_id',$ids)->get();
            $sections = Section::whereIn('id',$ids)->get();
            return view('pages.Teachers.students.index',compact('students' , 'sections'));
        }



        public function sectionInformation()
        {
            $ids= DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
            $sections = Section::whereIn('id',$ids)->get();
            return view('pages.Teachers.section.index',compact('sections'));
        }



    //for ajax
    public function getClassrooms($id)
    {
        return $this->student->getClassrooms($id);
    }

    public function getSections($id) {
        return $this->student->getSections($id);
    }
}
