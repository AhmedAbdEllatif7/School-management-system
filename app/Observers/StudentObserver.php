<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\Student;
use App\Models\User;
use App\Traits\AttachFilesTrait;

//enhance the structure name of blade pages , 
//edit route name to be best name convension , 
//rename request validation to be name convension ,
//rename request input to be more readable ,
//enhance ajax method names ,
//make observer of student to store photos and delete it's photo automatic ,
//enhance student methods
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
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
