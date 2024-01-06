<?php

namespace App\Listeners;

use App\Events\GraduationStudentDeleting;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class GraduationStudentDeletingListener
{

    public function __construct()
    {
        //
    }


    public function handle(GraduationStudentDeleting $event)
    {
        $student = $event->student;

        $this->deleteStudentFolder($student);
        $this->deleteStudentPhotoRecord($student);
    }

    private function deleteStudentFolder($student)
    {
        $directory = public_path('attachments/students/graduated/' . $student->email);
        if (File::exists($directory)) {
            File::deleteDirectory($directory);
        }
    }
    
    private function deleteStudentPhotoRecord($student)
    {
        Image::where('imageable_id', $student->id)->delete();
    }
}
