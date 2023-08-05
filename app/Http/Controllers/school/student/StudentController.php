<?php

namespace App\Http\Controllers\school\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudent;
use App\Models\Section;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
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
        $students = Student::all();
        return view('pages.Students.index' , compact('students'));
    }


    public function create()
    {
        return $this->student->Create_Student();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudent $request)
    {
        return $this->student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return$this->student->showStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        return $this->student->editForm($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudent $request)
    {
        return $this->student->updateStudent($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->student->deleteStudent($request);
    }

    public function getClassrooms($id)
    {
       return $this->student->getClassrooms($id);
    }

    public function getSections($id){

        return $this->student->getSections($id);
    }


    public function getNewSections($id){

            return $this->student->getNewSection($id);
        }

     public function getNewClassroom($id){

            return $this->student->getNewClassroom($id);
        }

     public function uploadAttachments(Request $request){

            return $this->student->uploadAttachments($request);
        }

     public function downloadAttachments($studentName , $fileName){

            return $this->student->downloadAttachments($studentName , $fileName);
        }

        public function deleteAttachment(Request $request){

            return $this->student->deleteAttachment($request);
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


}
