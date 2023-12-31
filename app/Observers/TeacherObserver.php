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



    public static function uploadTeacherPhoto($teacher): void
    {
        if (request()->hasFile('photo')) {
            $fileName = self::uploadFile(request(), 'photo', 'teachers/' . request()->email);
            self::createImageRecord($fileName, $teacher->id); 
        }
    }
    
    
    public static function createImageRecord($fileName, $teacherId): void
    {
        $image = new Image();
        $image->filename = $fileName;
        $image->imageable_id = $teacherId;
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





    public function deleted(Teacher $teacher)
    {
        try {
            DB::beginTransaction();
    
            $this->deleteTeacherFolder($teacher);
            $this->deleteTeacherPhotoRecord($teacher);
    
            DB::commit();
        } catch (\Exception $e) {
            return redirect()->back()->with('error' , $e->getMessage());
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
