<?php

namespace App\Repository;
use App\Http\Requests\StoreStudent;
use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Nationality;
use App\Models\Parentt;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;


class StudentRepository implements StudentRepositoryInterface{

   public function Create_Student(){

//
//       $Grades = Grade::all();
//       $Genders = Gender::all();
//       $nationals = Nationality::all();
//       $bloods = Blood::all();
//       $my_classes = Classroom::all();
//       $parents = Parentt::all();
//       return view('pages.Students.add',compact(['Grades' , 'Genders' , 'nationals' , 'bloods' , 'my_classes' , 'parents']));


       $data['my_classes'] = Classroom::all();
       $data['Grades'] = Grade::all();
       $data['parents'] = Parentt::all();
       $data['Genders'] = Gender::all();
       $data['nationals'] = Nationality::all();
       $data['bloods'] = Blood::all();
       return view('pages.Students.add',$data);

    }

    public function getClassrooms($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");
        return $list_classes;
    }

    public function getNewClassroom($id)
        {
            $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");
            return $list_classes;
        }

    public function getNewSection($id)
            {
                $list_sections = Section::where("class_id", $id)->pluck("name", "id");
                return $list_sections;
            }

    public function getSections($id){

        $list_sections = Section::where("class_id", $id)->pluck("name", "id");
        return $list_sections;
    }

    public function storeStudent($request)
    {

        DB::beginTransaction();


        try {
            $student = new Student();
            $student->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->gender_id = $request->gender_id;
            $student->nationalitie_id = $request->nationalitie_id;
            $student->blood_id = $request->blood_id;
            $student->date_birth = $request->Date_Birth;
            $student->grade_id = $request->Grade_id;
            $student->classroom_id = $request->Classroom_id;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            $student->save();


            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$request->name_ar, $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $student->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit();

            return redirect()->back()->with('add_student', trans('Students_trans.Student added successfully.'));


        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function editForm($id)
    {
        $data['my_classes'] = Classroom::all();
        $data['Grades'] = Grade::all();
        $data['parents'] = Parentt::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $data['Students'] = Student::findOrFail($id);
        return view('pages.Students.edit' , $data);
    }

     public function updateStudent($request)
        {
            try {
                $Edit_Students = Student::findorfail($request->id);
                $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
                $Edit_Students->email = $request->email;
                $Edit_Students->password = Hash::make($request->password);
                $Edit_Students->gender_id = $request->gender_id;
                $Edit_Students->nationalitie_id = $request->nationalitie_id;
                $Edit_Students->blood_id = $request->blood_id;
                $Edit_Students->Date_Birth = $request->Date_Birth;
                $Edit_Students->Grade_id = $request->Grade_id;
                $Edit_Students->Classroom_id = $request->Classroom_id;
                $Edit_Students->section_id = $request->section_id;
                $Edit_Students->parent_id = $request->parent_id;
                $Edit_Students->academic_year = $request->academic_year;
                $Edit_Students->save();

                return redirect()->route('students.index')->with(['updateStudent' => trans('Students_trans.Student updated successfully.')]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
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


