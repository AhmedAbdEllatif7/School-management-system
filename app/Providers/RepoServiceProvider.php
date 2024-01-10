<?php

namespace App\Providers;


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
            \App\Repositories\Interefaces\AdminDashboard\GradeRepositoryInterface::class,
            \App\Repositories\AdminDashboard\GradeRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\SectionRepositoryInterface::class,
            \App\Repositories\AdminDashboard\SectionRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\AttendanceRepositoryInterface::class,
            \App\Repositories\AdminDashboard\AttendanceRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\InvoiceFeesRepositoryInterface::class,
            \App\Repositories\AdminDashboard\InvoiceFeesRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\FeesRepositoryInterface::class,
            \App\Repositories\AdminDashboard\FeesRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\GraduationRepositoryInterface::class,
            \App\Repositories\AdminDashboard\GraduationRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\LibraryRepositoryInterface::class,
            \App\Repositories\AdminDashboard\LibraryRepository::class
        );
        
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\StudentPaymentRepositoryInterface::class,
            \App\Repositories\AdminDashboard\StudentPaymentRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\ProcessingFeesRepositoryInterface::class,
            \App\Repositories\AdminDashboard\ProcessingFeesRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\PromotionRepositoryInterface::class,
            \App\Repositories\AdminDashboard\PromotionRepository::class
        );
        
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\ReceiptStudentRepositoryInterface::class,
            \App\Repositories\AdminDashboard\ReceiptStudentRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\SettingsRepositoryInterface::class,
            \App\Repositories\AdminDashboard\SettingsRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\StudentRepositoryInterface::class,
            \App\Repositories\AdminDashboard\StudentRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\SubjectRepositoryInterface::class,
            \App\Repositories\AdminDashboard\SubjectRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Interefaces\AdminDashboard\TeacherRepositoryInterface::class,
            \App\Repositories\AdminDashboard\TeacherRepository::class
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


        $this->app->bind(
            \App\Repositories\Interefaces\StudentDashboard\StudentRepositoryInterface::class,
            \App\Repositories\StudentDashboard\StudentRepository::class
        );

        


        $this->app->bind(
            \App\Repositories\Interefaces\ParentDashboard\ParentRepositoryInterface::class,
            \App\Repositories\ParentDashboard\ParentRepository::class
        );

        



    }



    public function boot()
    {

    }
}
