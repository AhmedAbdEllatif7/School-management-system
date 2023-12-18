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
use App\Observers\StudentObserver;
use App\Repositories\Interefaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
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
    



    // Student Observer manages automatic photo uploads.
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
        $validatedData = $request->validated();
        $formattedName = [
            'en' => $validatedData['nameEn'],
            'ar' => $validatedData['nameAr'],
        ];
    
        $validatedData['name'] = $formattedName;
        Student::create($validatedData);        
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





    // Student Observer manages automatic student folder rename.
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
        $validatedData = $request->validated();

        $formattedName = [
            'en' => $validatedData['nameEn'],
            'ar' => $validatedData['nameAr'],
        ];
    
        $validatedData['name'] = $formattedName;
        $student->update($validatedData);
    }






    public function destroy($request)
    {
        Student::findOrFail($request->id)->forceDelete();
        return redirect()->back()->with(['deleteStudent' => trans('Students_trans.Student deleted successfully.') ]);;
    }





    public function show($student)
    {
        return view('pages.adminDashboard.students.show' , compact('student'));
    }






    public function addPhotoFromDetails($request)
    {
        $student = $this->findStudentById($request->student_id);
        
        if ($student) {
            $this->handlePhotoUpload($student);
            return redirect()->back()->with(['add_photo' => trans('main_trans.photo_added')]);
        }
        return redirect()->back()->with(['not_found' => trans('main_trans.File_not_found')]);
    }

    


    private function handlePhotoUpload($student)
    {
        StudentObserver::uploadStudentPhoto($student);
    }




    public function deletePhotoFromDetails($request)
    {
        DB::beginTransaction();
        try {
            $this->deleteFileFromStorage($request->studentEmail, $request->fileName);
            $this->deleteImageRecord($request->studentId, $request->fileName);
    
            // If everything is successful, commit the transaction
            DB::commit();
    
            return redirect()->back()->with(['delete_attachment' => trans('teacher_trans.photo_deleted')]);
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollBack();
                return redirect()->back()->with(['error' => trans('teacher_trans.not_found')]);
        }
    }
    




    private function deleteFileFromStorage($studentEmail, $fileName)
    {
        Storage::disk('upload_attachments')->delete('students/'.$studentEmail.'/'.$fileName);
        $directory = 'students/'.$studentEmail;
    
        $files = Storage::disk('upload_attachments')->files($directory);
    
        if (empty($files)) {
            Storage::disk('upload_attachments')->deleteDirectory($directory);
        }
    }
    
    private function deleteImageRecord($studentId, $fileName)
    {
        $image = Image::where('imageable_id', $studentId)->where('filename', $fileName)->first();
        if ($image) {
            $image->delete();
            return true; 
        }
        return false; 
    }


    public function downloadPhoto($studentEmail, $fileName)
    {
        $filePath = public_path('attachments/students/' . $studentEmail . '/' . $fileName);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with(['error' => trans('teacher_trans.not_found')]);
        }
    }




    public function openPhoto($studentEmail , $fileName) 
    {
        return response()->file(public_path('attachments/students/'.$studentEmail.'/'.$fileName));
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


