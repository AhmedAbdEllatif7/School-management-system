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
use Illuminate\Support\Facades\Storage;

class TeacherRepository implements TeacherRepositoryInterface {

    public function index(){
        $teachers = Teacher::all();
        return view('dashboards.admin.teachers.index',compact('teachers'));
    }




    public function create()
    {
        $specializations = Specialization::all();
        $genders = Gender::all();
        return view('dashboards.admin.teachers.create',compact('specializations','genders'));
    }



    // Teacher Observer manages automatic photo uploads.
    public function store($request)
    {    
        try {
                $this->storeTeacher($request);
                return redirect()->back()->with(['add_teacher' => trans('teacher_trans.Teacher added successfully.')]);
        } catch (Exception $e) {
            DB::rollback();
    
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    



    private function storeTeacher($request)
    {
        $validatedData = $request->validated();
        $formattedName = [
            'en' => $validatedData['nameEn'],
            'ar' => $validatedData['nameAr'],
        ];
    
        $validatedData['name'] = $formattedName;
        Teacher::create($validatedData);
    }







    public function edit($teacher){
        $specializations = specialization::all();
        $genders = Gender::all();
        return view('Pages.adminDashboard.teachers.edit' ,compact(['teacher' , 'specializations' , 'genders']));
    }




    // Teacher Observer manages automatic student folder rename.
    public function update($request , $teacher){
        try {
            $validatedData = $request->validated();
            $formattedName = [
                'en' => $validatedData['nameEn'],
                'ar' => $validatedData['nameAr'],
            ];
    
            $validatedData['name'] = $formattedName;
            $teacher->update($validatedData);

            return redirect()->route('teachers.index')->with(['update_teacher' => trans('teacher_trans.Teacher updated successfully.')]);
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }








    // Teacher Observer manages automatic delete it's folder .
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
        return view('dashboards.admin.teachers.view' , compact('teacher'));
    }




    public function addPhotoFromDetails($request)
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






    public function openPhoto($teacherEmail , $fileName) 
    {
        return response()->file(public_path('attachments/teachers/'.$teacherEmail.'/'.$fileName));
    }






    public function deletePhotoFromDetails($request)
    {
        DB::beginTransaction();
        try {
            $this->deleteFileFromStorage($request->teacherEmail, $request->fileName);
            $this->deleteImageRecord($request->teacherId, $request->fileName);
    
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
    
    private function deleteImageRecord($teacherId, $fileName)
    {
        $image = Image::where('imageable_id', $teacherId)->where('filename', $fileName)->first();
        if ($image) {
            $image->delete();
            return true; 
        }
        return false; 
    }
    
    


    public function downloadPhoto($teacherEmail, $fileName)
    {
        $filePath = public_path('attachments/teachers/' . $teacherEmail . '/' . $fileName);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with(['error' => trans('teacher_trans.not_found')]);
        }
    }
    
    
}
