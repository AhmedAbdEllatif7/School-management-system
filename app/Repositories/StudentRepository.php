<?php

namespace App\Repositories;
use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Parentt;
use App\Models\Section;
use App\Models\Student;
use App\Repositories\Interefaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class StudentRepository implements StudentRepositoryInterface{



    public function index()
    {
        $students = Student::all();
        return view('pages.adminDashboard.students.index' , compact('students'));
    }



    public function create()
    {
        $grades = Grade::all();
        $genders = Gender::all();
        $nationals = Nationality::all();
        $bloodTypes = Blood::all();
        $classes = Classroom::all();
        $parents = Parentt::all();
    
        return view('pages.adminDashboard.students.create', compact('grades', 'genders', 'nationals', 'bloodTypes', 'classes', 'parents'));
    }
    




    public function store($request)
    {
        try {
            $this->storeStudent($request);    
            return redirect()->back()->with('add_student', trans('Students_trans.Student added successfully.'));
        } 
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    private function storeStudent($request)
    {
        $student = new Student();
        $student->name = ['en' => $request->nameEn, 'ar' => $request->nameAr];
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->gender_id = $request->genderId;
        $student->nationalitie_id = $request->nationalitieId;
        $student->blood_id = $request->bloodId;
        $student->date_birth = $request->dateBirth;
        $student->grade_id = $request->gradeId;
        $student->classroom_id = $request->classroomId;
        $student->section_id = $request->sectionId;
        $student->parent_id = $request->parentId;
        $student->academic_year = $request->academicYear;
        $student->save();
        return $student;
    }






    public function edit($student)
    {
        $grades = Grade::all();
        $genders = Gender::all();
        $nationals = Nationality::all();
        $bloodTypes = Blood::all();
        $classrooms = Classroom::all();
        $parents = Parentt::all();
        return view('pages.adminDashboard.students.edit' , compact('student', 'grades', 'genders', 'nationals', 'bloodTypes', 'classrooms', 'parents'));
    }





    public function update($request)
    {
        try {
            $student = $this->findStudentById($request->id);
            $this->updateStudentAttributes($student, $request);
            return redirect()->route('students.index')->with(['updateStudent' => trans('Students_trans.Student updated successfully.')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function findStudentById($studentId)
    {
        return Student::findOrFail($studentId);
    }

    private function updateStudentAttributes($student, $request)
    {
        $student->name = ['ar' => $request->nameAr, 'en' => $request->nameEn];
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->gender_id = $request->genderId;
        $student->nationalitie_id = $request->nationalitieId;
        $student->blood_id = $request->bloodId;
        $student->date_birth = $request->dateBirth;
        $student->grade_id = $request->gradeId;
        $student->classroom_id = $request->classroomId;
        $student->section_id = $request->sectionId;
        $student->parent_id = $request->parentId;
        $student->academic_year = $request->academicYear;
        $student->save();
    }












        public function deleteStudent($request)
        {
            Student::findOrFail($request->id)->forceDelete();
            return redirect()->back()->with(['deleteStudent' => trans('Students_trans.Student deleted successfully.') ]);;

        }


        public function showStudent($id)
        {
            $Student = Student::findOrFail($id);
            return view('pages.Students.show' , compact('Student'));

        }

    public function uploadAttachments($request)
    {
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('attachments/students/' . $request->student_name, $name, 'upload_attachments');

                // insert in image_table
                $image = new Image();
                $image->filename = $name;
                $image->imageable_id = $request->student_id;
                $image->imageable_type = 'App\Models\Student';
                $image->save();
            }
        }

        return redirect()->back()->with(['add_attachment' => trans('Students_trans.File Stored successfully.') ]);
    }



            public function downloadAttachments($studentName, $fileName)
            {
                $file = 'attachments/students/' . $studentName . '/' . $fileName;

                if (!Storage::disk('upload_attachments')->exists($file)) {
                    return redirect()->back()->with('error_file', trans('main_trans.File_not_found'));
                }

                return response()->download(Storage::disk('upload_attachments')->path($file));
            }


            public function deleteAttachment($request)
            {
                $file = 'attachments/students/' . $request->student_name . '/' . $request->filename;

                if (!Storage::disk('upload_attachments')->exists($file)) {
                    return redirect()->back()->with('error_file', trans('main_trans.File_not_found'));
                }

                // Delete img in server disk
                Storage::disk('upload_attachments')->delete($file);

                // Delete in data
                Image::where('id', $request->id)->where('filename', $request->filename)->delete();

                return redirect()->back()->with(['delete_attachment' => trans('Students_trans.File deleted successfully')]);
            }

            public function viewFile($studentName, $fileName)
            {
                $file = 'attachments/students/' . $studentName . '/' . $fileName;

                if (!Storage::disk('upload_attachments')->exists($file)) {
                    return redirect()->back()->with('error_file', trans('main_trans.File_not_found'));
                }

                return response()->file(Storage::disk('upload_attachments')->path($file));
            }







            // for ajax
            public function getClassrooms($id)
            {
                $classroomList = Classroom::where("grade_id", $id)->pluck("name", "id");
                return $classroomList;
            }
        
        
        
            // for ajax
            public function getSections($id){
        
                $sectionList = Section::where("class_id", $id)->pluck("name", "id");
                return $sectionList;
            }

}




//<p class="small p-2 me-3 mb-0 text-white rounded-3 bg-warning" style="border-radius: 15px; padding: 5px 10px; word-break: break-all;">
//                                                        {{ $message->message_text }}
//                                                        @if ($message->file)
//                                                            <img src="{{ asset('storage/' . $message->file) }}" alt="Message Attachment" class="img-thumbnail" style="width: 150px;height: 150px">
//                                                            </svg>
//                                                            <span  wire:click="downloadFile({{$message->id}} , '{{$message->file}}')" class="delete-message-btn" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
//                                                                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
//                                                                  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
//                                                                </svg>
//                                                            </span>
//
//@endif
//                                                        <span  wire:click="deleteId({{$message->id}})" class="delete-message-btn" >&#10005;</span>
//                                                    </p>
//public function downloadFile($id, $file)
//{
//    $filePath = public_path('storage/' . $file);
//
//    if (file_exists($filePath)) {
//        $filename = basename($filePath); // Get the file name from the path
//
//        return response()->download($filePath, $filename);
//    } else {
//        return response()->json(['error' => 'File not found'], 404);
//    }
//}


