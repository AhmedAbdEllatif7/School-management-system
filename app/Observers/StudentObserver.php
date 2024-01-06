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


    ############################## Begin Upload Photo ###############################
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
    ############################## End Upload Photo ###############################






    public function updated(Student $student): void
    {
        $this->manageStudentFolder($student);
    }





    ############################## Begin Manage Student Folder ###############################
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
    ############################## End Manage Student Folder ###############################










    ################# Begin Soft Delete For Graduation ###################
    public function deleted(Student $student)
    {
        $this->moveStudentFolderToGraduated($student);
    }
    


    private function moveStudentFolderToGraduated($student)
    {
        if ($this->checkStudentFolderExists($student)) {
            $this->createGraduatedDirectory();
            
            $photoPath = public_path('attachments/students/' . $student->email);
            $graduatedPath = public_path('attachments/students/graduated/' . $student->email);
    
            File::move($photoPath, $graduatedPath);
        }
    }



    private function checkStudentFolderExists($student)
    {
        $photoPath = public_path('attachments/students/' . $student->email);
        $graduatedPath = public_path('attachments/students/graduated/' . $student->email);
    
        return File::exists($photoPath) && !File::exists($graduatedPath);
    }
    
    private function createGraduatedDirectory()
    {
        $graduatedDirectory = public_path('attachments/students/graduated');
    
        if (!File::exists($graduatedDirectory)) {
            File::makeDirectory($graduatedDirectory, 0755, true, true);
        }
    }
    ####################### End Soft Delete For Graduation ###############################
    


    


    



    public function restored(Student $student)
    {
        $graduatedPath = public_path('attachments/students/graduated/' . $student->email);
        $photoPath = public_path('attachments/students/' . $student->email);

        if (File::exists($graduatedPath)) {
            File::move($graduatedPath, $photoPath);
        }
    }




    ##################### Begin Force Deleted #############################
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
    ##################### End Force Deleted #############################


}
