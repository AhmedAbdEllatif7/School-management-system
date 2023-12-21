<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\Student;
use App\Traits\AttachFilesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StudentObserver
{
    use AttachFilesTrait;

    public function created(Student $student): void
    {
        $this->uploadStudentPhoto($student);
    }


    public static function uploadStudentPhoto($student): void
    {
        if (request()->hasFile('photo')) {
            $fileName = self::uploadFile(request(), 'photo', 'students/' . request()->email);
            self::createImageRecord($fileName, $student->id); 
        }
    }
    
    
    public static function createImageRecord($fileName, $studentId): void
    {
        $image = new Image();
        $image->filename = $fileName;
        $image->imageable_id = $studentId;
        $image->imageable_type = 'App\Models\Student';
        $image->save();
    }


    public function updated(Student $student): void
    {
        $this->manageStudentFolder($student);
    }



    private function manageStudentFolder($student)
    {
        $oldStudentEmail = $student->getOriginal('email');
        $newStudentEmail = $student->email;

        if ($oldStudentEmail !== $newStudentEmail)
        {
            $this->renameStudentFolder($oldStudentEmail , $newStudentEmail);
        }
    }


    private function renameStudentFolder($oldStudentEmail , $newStudentEmail)
    {
        $oldFolderPath = public_path('attachments/students/' . $oldStudentEmail);
        $newFolderPath = public_path('attachments/students/' . $newStudentEmail);

        if (File::exists($oldFolderPath))
        {
            rename($oldFolderPath , $newFolderPath);
        }
    }


    //soft delete for gradtaion 
    public function deleted(Student $student)
    {
        $this->moveStudentFolderToGraduated($student);
    }
    



    private function moveStudentFolderToGraduated($student)
    {
        $photoPath = public_path('attachments/students/' . $student->email);
        $graduatedPath = public_path('attachments/students/graduated/' . $student->email);
    
        if (File::exists($photoPath) && !File::exists($graduatedPath)) {
            if (!File::exists(public_path('attachments/students/graduated'))) {
                File::makeDirectory(public_path('attachments/students/graduated'), 0755, true, true);
            }
            File::move($photoPath, $graduatedPath);
        }
    }
    



    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student)
    {
        try {
            DB::beginTransaction();
    
            $this->deleteStudentFolder($student);
            $this->deleteStudentPhotoRecord($student);
    
            DB::commit();
        } catch (\Exception $e) {
            return redirect()->back()->with('error' , $e->getMessage());
            DB::rollBack();
        }
    }


    private function deleteStudentFolder($student)
    {
        $directory = public_path('attachments/students/' . $student->email);
        if (File::exists($directory)) {
            File::deleteDirectory($directory);
        }
    }
    
    private function deleteStudentPhotoRecord($student)
    {
        Image::where('imageable_id', $student->id)->delete();
    }

}
