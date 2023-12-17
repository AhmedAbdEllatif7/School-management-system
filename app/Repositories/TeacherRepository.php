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




    public function index(){
        $teachers = Teacher::all();
        return view('pages.teachers.index',compact('teachers'));
    }



    public function create()
    {
        $specializations = Specialization::all();
        $genders = Gender::all();
        return view('pages.teachers.create',compact('specializations','genders'));
    }



    public function store($request)
    {    
        try {
            $teacher = new Teacher();
            $teacher->email = $request->email;
            $teacher->password =  $request->password;
            $teacher->name = ['en' => $request->nameEn, 'ar' => $request->nameAr];
            $teacher->specialization_id = $request->specializationId;
            $teacher->gender_id = $request->genderId;
            $teacher->joining_date = $request->joiningDate;
            $teacher->address = $request->address;
            $teacher->save();
        
            return redirect()->back()->with(['add_teacher' => trans('teacher_trans.Teacher added successfully.')]);
        } catch (Exception $e) {
            DB::rollback();
    
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    



    public function edit($teacher){
        $specializations = specialization::all();
        $genders = Gender::all();
        return view('Pages.teachers.edit' ,compact(['teacher' , 'specializations' , 'genders']));
    }





    public function update($request , $teacher){
        try {
            $teacher->email = $request->email;
            $teacher->password = $request->password;
            $teacher->name = ['en' => $request->nameEn, 'ar' => $request->nameAr];
            $teacher->specialization_id = $request->specializationId;
            $teacher->gender_id = $request->genderId;
            $teacher->joining_date = $request->joiningDate;
            $teacher->address = $request->address;
            
            $teacher->save();

            return redirect()->route('teachers.index')->with(['update_teacher' => trans('teacher_trans.Teacher updated successfully.')]);
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }




    public function destroy($teacher){
        try {
            $teacher->delete();
            return redirect()->back()->with(['delete_teacher' => trans('teacher_trans.Teacher deleted successfully.')]);
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }





    public function show($id){
        $teacher = Teacher::findOrFail($id);
        return view('pages.teachers.view' , compact('teacher'));
    }





    public function deleteTeacherPhoto($request)
    {
        Storage::disk('upload_attachments')->delete('attachments/teacher/'.$request->teacher_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        return redirect()->back()->with(['delete_attachment' => trans('Students_trans.File deleted successfully ') ]);;
    }


    public function downloadTeacherPhoto($teacher_name, $file_name)
    {
        return response()->download(public_path('attachments/teacher/'.$teacher_name.'/'.$file_name));

    }
}
