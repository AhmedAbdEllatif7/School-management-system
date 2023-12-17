<?php

namespace App\Repositories;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Observers\TeacherObserver;
use App\Repositories\Interefaces\TeacherRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class TeacherRepository implements TeacherRepositoryInterface{




    public function index(){
        $teachers = Teacher::all();
        return view('pages.teachers.admin.index',compact('teachers'));
    }



    public function create()
    {
        $specializations = Specialization::all();
        $genders = Gender::all();
        return view('pages.teachers.admin.create',compact('specializations','genders'));
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
        return view('Pages.teachers.admin.edit' ,compact(['teacher' , 'specializations' , 'genders']));
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
        return view('pages.teachers.admin.view' , compact('teacher'));
    }




    public function uploadTeacherPhoto($request)
    {
        $teacher = $this->findTeacherById($request->teacher_id);
        
        if ($teacher) {
            $this->handlePhotoUpload($teacher);
            return redirect()->back()->with(['add_photo' => trans('main_trans.photo_added')]);
        }
    
        return redirect()->back()->with(['not_found' => trans('main_trans.File_not_found')]);
    }
    
    private function findTeacherById($teacherId)
    {
        return Teacher::findOrFail($teacherId);
    }
    
    private function handlePhotoUpload($teacher)
    {
        TeacherObserver::uploadTeacherPhoto($teacher);
    }






    public function openTeacherPhoto($teacherEmail , $fileName) 
    {
        return response()->file(public_path('attachments/teachers/'.$teacherEmail.'/'.$fileName));
    }






    public function deleteTeacherPhoto($request)
    {
        DB::beginTransaction();
        try {
            $this->deleteFileFromStorage($request->teacherEmail, $request->fileName);
            $this->deleteImageRecord($request->id, $request->fileName);
    
            // If everything is successful, commit the transaction
            DB::commit();
    
            return redirect()->back()->with(['delete_attachment' => trans('teacher_trans.photo_deleted')]);
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollBack();
                return redirect()->back()->with(['error' => trans('teacher_trans.not_found')]);
        }
    }
    
    private function deleteFileFromStorage($teacherEmail, $fileName)
    {
        Storage::disk('upload_attachments')->delete('teachers/'.$teacherEmail.'/'.$fileName);
        $directory = 'teachers/'.$teacherEmail;
    
        $files = Storage::disk('upload_attachments')->files($directory);
    
        if (empty($files)) {
            Storage::disk('upload_attachments')->deleteDirectory($directory);
        }
    }
    
    private function deleteImageRecord($imageId, $fileName)
    {
        $image = Image::where('imageable_id', $imageId)->where('filename', $fileName)->first();
        if ($image) {
            $image->delete();
            return true; 
        }
        return false; 
    }
    
    

    public function downloadTeacherPhoto($teacherEmail , $fileName)
    {
        return response()->download(public_path('attachments/teachers/'.$teacherEmail.'/'.$fileName));

    }
}
