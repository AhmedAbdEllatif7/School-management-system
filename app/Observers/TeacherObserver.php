<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\Teacher;
use App\Traits\AttachFilesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TeacherObserver
{

    use AttachFilesTrait;
    public function created(Teacher $teacher): void
    {
        $this->uploadTeacherPhoto($teacher);
    }



    private function uploadTeacherPhoto(Teacher $teacher): void
    {
        if (request()->hasFile('photo')) {
                $fileName = $this->uploadFile(request(), 'photo' , 'teachers/' . request()->email);
                $this->createImageRecord($fileName, $teacher);
        }
    }
    

    private function createImageRecord($fileName , $teacher): void
    {
        $image = new Image();
        $image->filename = $fileName;
        $image->imageable_id = $teacher->id;
        $image->imageable_type = 'App\Models\Teacher';
        $image->save();
    }





    
    public function updated(Teacher $teacher)
    {
        $this->manageTeacherFolder($teacher);
    }


    private function manageTeacherFolder($teacher)
    {
        $oldTeacherEmail = $teacher->getOriginal('email');
        $newTeacherEmail = $teacher->email;

        if ($oldTeacherEmail !== $newTeacherEmail) {
            $this->renameAttachmentFolder($oldTeacherEmail, $newTeacherEmail);
        }
    }


    private function renameAttachmentFolder($oldTeacherEmail, $newTeacherEmail)
    {
        $oldFolderName = public_path('attachments/teachers/' . $oldTeacherEmail);
        $newFolderName = public_path('attachments/teachers/' . $newTeacherEmail);

        if (File::exists($oldFolderName)) {
            rename($oldFolderName, $newFolderName);
        }
    }





    public function deleted(Teacher $teacher): void
    {
        try {
            DB::beginTransaction();
    
            $this->deleteTeacherFolder($teacher);
            $this->deleteTeacherPhotoRecord($teacher);
    
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    
    private function deleteTeacherFolder($teacher)
    {
        $directory = public_path('attachments/teachers/' . $teacher->email);
        if (File::exists($directory)) {
            File::deleteDirectory($directory);
        }
    }
    
    private function deleteTeacherPhotoRecord($teacher)
    {
        Image::where('imageable_id', $teacher->id)->delete();
    }
    




}
