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

use App\Repositories\PaymentStudentRepository;
use App\Repositories\Interefaces\PaymentStudentRepositoryInterface;

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
        $this->app->bind(TeacherRepositoryInterface::class , TeacherRepository::class);

        $this->app->bind(StudentRepositoryInterface::class , StudentRepository::class);

        $this->app->bind(PromotionRepositoryInterface::class , PromotionRepository::class);

        $this->app->bind(GraduationRepositoryInterface::class , GraduationRepository::class);

        $this->app->bind(FeesRepositoryInterface::class , FeesRepository::class);

        $this->app->bind(StudenntAccountRepositoryInterface::class , StudentAccountRepository::class);

        $this->app->bind(InvoiceFeesRepositoryInterface::class , InvoiceFeesRepository::class);

        $this->app->bind(ReceiptStudentRepositoryInterface::class , ReceiptStudentRepository::class);

        $this->app->bind(ProcessingFeesRepositoryInterface::class , ProcessingFeesRepository::class);

        $this->app->bind(PaymentStudentRepositoryInterface::class , PaymentStudentRepository::class);

        $this->app->bind(AttendanceRepositoryInterface::class , AttendanceRepository::class);

        $this->app->bind(SubjectRepositoryInterface::class , SubjectRepository::class);
        
        // $this->app->bind(QuizRepositoryInterface::class , QuizRepository::class);

        // $this->app->bind(QuestionRepositoryInterface::class , QuestionRepository::class);

        $this->app->bind(LibraryRepositoryInterface::class , LibraryRepository::class);

        $this->app->bind(SettingsRepositoryInterface::class , SettingsRepository::class);

        $this->app->bind(ClassroomRepositoryInterface::class , ClassroomRepository::class);

        $this->app->bind(GradeRepositoryInterface::class , GradeRepository::class);

        $this->app->bind(ParentStudentRepositoryInterface::class , ParentStudentRepository::class);

        $this->app->bind(SectionRepositoryInterface::class , SectionRepository::class);




    }



    public function boot()
    {

    }
}
