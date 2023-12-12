<?php

namespace App\Repositories;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Repositories\Interefaces\TeacherRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){
        return Teacher::all();
    }

    public function getSpecialization(){
        return specialization::all();
    }

    public function getGender(){
        return Gender::all();
    }

    public function submitAddTeacher($request){

        DB::beginTransaction();

        try {
            $Teachers = new Teacher();
            $Teachers->email = $request->Email;
            $Teachers->password =  Hash::make($request->Password);
            $Teachers->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->specialization_id = $request->Specialization_id;
            $Teachers->gender_id = $request->Gender_id;
            $Teachers->joining_date = $request->Joining_Date;
            $Teachers->address = $request->Address;
            $Teachers->save();

            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/teacher/'.$request->Name_ar, $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $Teachers->id;
                    $images->imageable_type = 'App\Models\Teacher';
                    $images->save();
                }
            }
            DB::commit();

            return redirect()->back()->with(['add_teacher' => trans('Teacher_trans.Teacher added successfully.')]);
        }
        catch (Exception $e)
        {
            DB::rollback();

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function editTeacherForm($request){
        $specializations = specialization::all();
        $genders = Gender::all();
        $Teachers = Teacher::findOrFail($request->id);
        return view('Pages.Teachers.Edit' ,compact(['Teachers' , 'specializations' , 'genders']));
    }

    public function submitEditTeacher($request){
        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->email  = $request->Email;
            $Teachers->password =  Hash::make($request->Password);
            $Teachers->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->specialization_id  = $request->Specialization_id;
            $Teachers->gender_id  = $request->Gender_id;
            $Teachers->joining_date = $request->Joining_Date;
            $Teachers->address = $request->Address;
            $Teachers->save();
            return redirect()->route('teachers')->with(['update_teacher' => trans('Teacher_trans.Teacher updated successfully.')]);
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function deleteTeacher($request){
        try {
            $id = $request->id;
            $teacher = Teacher::findOrFail($id);
            $teacher->delete();
            return redirect()->back()->with(['delete_teacher' => trans('Teacher_trans.Teacher deleted successfully.')]);
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


     public function viewTeacherData($id){

        $teacher = Teacher::findOrFail($id);
        return view('pages.Teachers.view' , compact('teacher'));
        }


        public function uploadTeacherFile($request)
        {

            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/teacher/'.$request->teacher_name, $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $request->teacher_id;
                    $images->imageable_type = 'App\Models\Teacher';
                    $images->save();

                }

                return redirect()->back()->with(['add_attachment' => trans('Students_trans.File Stored successfully.') ]);;

            }
        }

        public function deleteFileTeacher($request)
        {
            Storage::disk('upload_attachments')->delete('attachments/teacher/'.$request->teacher_name.'/'.$request->filename);

            // Delete in data
            image::where('id',$request->id)->where('filename',$request->filename)->delete();
            return redirect()->back()->with(['delete_attachment' => trans('Students_trans.File deleted successfully ') ]);;
        }


        public function downloadFileTeacher($teacher_name, $file_name)
        {
            return response()->download(public_path('attachments/teacher/'.$teacher_name.'/'.$file_name));

        }
}
