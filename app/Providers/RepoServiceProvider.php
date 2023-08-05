<?php

namespace App\Providers;

use App\Repository\AttendanceRepository;
use App\Repository\AttendanceRepositoryInterface;
use App\Repository\ClassroomRepository;
use App\Repository\ClassroomRepositoryInterface;
use App\Repository\ExamRepository;
use App\Repository\ExamRepositoryInterface;
use App\Repository\FeesInvoicesRepository;
use App\Repository\FeesInvoicesRepositoryInterface;
use App\Repository\FeesRepository;
use App\Repository\FeesRepositoryInterface;
use App\Repository\GradeRepository;
use App\Repository\GradeRepositoryInterface;
use App\Repository\GraduationRepository;
use App\Repository\GraduationRepositoryInterface;
use App\Repository\LibraryRepository;
use App\Repository\LibraryRepositoryInterface;
use App\Repository\ParentStudentRepository;
use App\Repository\ParentStudentRepositoryInterface;
use App\Repository\PaymentStudentRepository;
use App\Repository\PaymentStudentRepositoryInterface;
use App\Repository\ProccessingFeesRepository;
use App\Repository\ProccessingFeesRepositoryInterface;
use App\Repository\PromotionRepository;
use App\Repository\PromotionRepositoryInterface;
use App\Repository\QuestionRepository;
use App\Repository\QuestionRepositoryInterface;
use App\Repository\QuizRepository;
use App\Repository\QuizRepositoryInterface;
use App\Repository\ReceiptStudentRepository;
use App\Repository\ReceiptStudentRepositoryInterface;
use App\Repository\SectionRepository;
use App\Repository\SectionRepositoryInterface;
use App\Repository\SettingsRepository;
use App\Repository\SettingsRepositoryInterface;
use App\Repository\StudenntAccountRepositoryInterface;
use App\Repository\StudentAccountRepository;
use App\Repository\StudentRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\SubjectRepository;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
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
        $this->app->bind(FeesInvoicesRepositoryInterface::class , FeesInvoicesRepository::class);
        $this->app->bind(ReceiptStudentRepositoryInterface::class , ReceiptStudentRepository::class);
        $this->app->bind(ProccessingFeesRepositoryInterface::class , ProccessingFeesRepository::class);
        $this->app->bind(PaymentStudentRepositoryInterface::class , PaymentStudentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class , AttendanceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class , SubjectRepository::class);
        $this->app->bind(QuizRepositoryInterface::class , QuizRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class , QuestionRepository::class);
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
