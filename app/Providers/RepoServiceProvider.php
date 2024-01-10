<?php

namespace App\Providers;

use App\Repositories\ClassroomRepository;
use App\Repositories\Interefaces\ClassroomRepositoryInterface;

use App\Repositories\GradeRepository;
use App\Repositories\Interefaces\GradeRepositoryInterface;

use App\Repositories\SectionRepository;
use App\Repositories\Interefaces\SectionRepositoryInterface;

use App\Repositories\AttendanceRepository;
use App\Repositories\Interefaces\AttendanceRepositoryInterface;


use App\Repositories\InvoiceFeesRepository;
use App\Repositories\Interefaces\InvoiceFeesRepositoryInterface;

use App\Repositories\FeesRepository;
use App\Repositories\Interefaces\FeesRepositoryInterface;

use App\Repositories\GraduationRepository;
use App\Repositories\Interefaces\GraduationRepositoryInterface;

use App\Repositories\LibraryRepository;
use App\Repositories\Interefaces\LibraryRepositoryInterface;

use App\Repositories\ParentStudentRepository;
use App\Repositories\Interefaces\ParentStudentRepositoryInterface;

use App\Repositories\StudentPaymentRepository;
use App\Repositories\Interefaces\StudentPaymentRepositoryInterface;

use App\Repositories\ProcessingFeesRepository;
use App\Repositories\Interefaces\ProcessingFeesRepositoryInterface;

use App\Repositories\PromotionRepository;
use App\Repositories\Interefaces\PromotionRepositoryInterface;

use App\Repositories\QuestionRepository;
use App\Repositories\Interefaces\QuestionRepositoryInterface;

use App\Repositories\QuizRepository;
use App\Repositories\Interefaces\QuizRepositoryInterface;

use App\Repositories\ReceiptStudentRepository;
use App\Repositories\Interefaces\ReceiptStudentRepositoryInterface;

use App\Repositories\SettingsRepository;
use App\Repositories\Interefaces\SettingsRepositoryInterface;

use App\Repositories\Interefaces\StudenntAccountRepositoryInterface;
use App\Repositories\StudentAccountRepository;

use App\Repositories\StudentRepository;
use App\Repositories\Interefaces\StudentRepositoryInterface;

use App\Repositories\SubjectRepository;
use App\Repositories\Interefaces\SubjectRepositoryInterface;

use App\Repositories\TeacherRepository;
use App\Repositories\Interefaces\TeacherRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register():void
    {
        $this->app->bind(
            \App\Repositories\Interefaces\TeacherDashboard\QuestionsRepositoryInterface::class,
            \App\Repositories\TeacherDashboard\QuestionsRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\GradeRepositoryInterface::class,
            \App\Repositories\GradeRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\SectionRepositoryInterface::class,
            \App\Repositories\SectionRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AttendanceRepositoryInterface::class,
            \App\Repositories\AttendanceRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\InvoiceFeesRepositoryInterface::class,
            \App\Repositories\InvoiceFeesRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\FeesRepositoryInterface::class,
            \App\Repositories\FeesRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\GraduationRepositoryInterface::class,
            \App\Repositories\GraduationRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\LibraryRepositoryInterface::class,
            \App\Repositories\LibraryRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\ParentStudentRepositoryInterface::class,
            \App\Repositories\ParentStudentRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\StudentPaymentRepositoryInterface::class,
            \App\Repositories\StudentPaymentRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\ProcessingFeesRepositoryInterface::class,
            \App\Repositories\ProcessingFeesRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\PromotionRepositoryInterface::class,
            \App\Repositories\PromotionRepository::class
        );
        
        // $this->app->bind(
        //     \App\Repositories\Interefaces\QuestionRepositoryInterface::class,
        //     \App\Repositories\QuestionRepository::class
        // );
        
        // $this->app->bind(
        //     \App\Repositories\Interefaces\QuizRepositoryInterface::class,
        //     \App\Repositories\QuizRepository::class
        // );
        
        $this->app->bind(
            \App\Repositories\Interefaces\ReceiptStudentRepositoryInterface::class,
            \App\Repositories\ReceiptStudentRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\SettingsRepositoryInterface::class,
            \App\Repositories\SettingsRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\StudenntAccountRepositoryInterface::class,
            \App\Repositories\StudentAccountRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\StudentRepositoryInterface::class,
            \App\Repositories\StudentRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\SubjectRepositoryInterface::class,
            \App\Repositories\SubjectRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\TeacherRepositoryInterface::class,
            \App\Repositories\TeacherRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interefaces\TeacherDashboard\TeacherRepositoryInterface::class,
            \App\Repositories\TeacherDashboard\TeacherRepository::class
        );


        $this->app->bind(
            \App\Repositories\Interefaces\TeacherDashboard\QuizRepositoryInterface::class,
            \App\Repositories\TeacherDashboard\QuizRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interefaces\TeacherDashboard\QuestionsRepositoryInterface::class,
            \App\Repositories\TeacherDashboard\QuestionsRepository::class
        );

        



    }



    public function boot()
    {

    }
}
