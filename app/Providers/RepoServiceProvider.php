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
            \app\Repositories\Interefaces\AdminDashboard\GradeRepositoryInterface::class,
            \app\Repositories\AdminDashboard\GradeRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\SectionRepositoryInterface::class,
            \app\Repositories\AdminDashboard\SectionRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\AttendanceRepositoryInterface::class,
            \app\Repositories\AdminDashboard\AttendanceRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\InvoiceFeesRepositoryInterface::class,
            \app\Repositories\AdminDashboard\InvoiceFeesRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\FeesRepositoryInterface::class,
            \app\Repositories\AdminDashboard\FeesRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\GraduationRepositoryInterface::class,
            \app\Repositories\AdminDashboard\GraduationRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\LibraryRepositoryInterface::class,
            \app\Repositories\AdminDashboard\LibraryRepository::class
        );
        
        // $this->app->bind(
        //     \app\Repositories\Interefaces\AdminDashboard\ParentStudentRepositoryInterface::class,
        //     \app\Repositories\AdminDashboard\ParentStudentRepository::class
        // );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\StudentPaymentRepositoryInterface::class,
            \app\Repositories\AdminDashboard\StudentPaymentRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\ProcessingFeesRepositoryInterface::class,
            \app\Repositories\AdminDashboard\ProcessingFeesRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\PromotionRepositoryInterface::class,
            \app\Repositories\AdminDashboard\PromotionRepository::class
        );
        
        // $this->app->bind(
        //     \app\Repositories\Interefaces\AdminDashboard\QuestionRepositoryInterface::class,
        //     \app\Repositories\AdminDashboard\QuestionRepository::class
        // );
        
        // $this->app->bind(
        //     \app\Repositories\Interefaces\AdminDashboard\QuizRepositoryInterface::class,
        //     \app\Repositories\AdminDashboard\QuizRepository::class
        // );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\ReceiptStudentRepositoryInterface::class,
            \app\Repositories\AdminDashboard\ReceiptStudentRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\SettingsRepositoryInterface::class,
            \app\Repositories\AdminDashboard\SettingsRepository::class
        );

        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\StudentRepositoryInterface::class,
            \app\Repositories\AdminDashboard\StudentRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\SubjectRepositoryInterface::class,
            \app\Repositories\AdminDashboard\SubjectRepository::class
        );
        
        $this->app->bind(
            \app\Repositories\Interefaces\AdminDashboard\TeacherRepositoryInterface::class,
            \app\Repositories\AdminDashboard\TeacherRepository::class
        );

        $this->app->bind(
            \app\Repositories\Interefaces\TeacherDashboard\TeacherRepositoryInterface::class,
            \app\Repositories\TeacherDashboard\TeacherRepository::class
        );


        $this->app->bind(
            \app\Repositories\Interefaces\TeacherDashboard\QuizRepositoryInterface::class,
            \app\Repositories\TeacherDashboard\QuizRepository::class
        );

        $this->app->bind(
            \app\Repositories\Interefaces\TeacherDashboard\QuestionsRepositoryInterface::class,
            \app\Repositories\TeacherDashboard\QuestionsRepository::class
        );

        



    }



    public function boot()
    {

    }
}
