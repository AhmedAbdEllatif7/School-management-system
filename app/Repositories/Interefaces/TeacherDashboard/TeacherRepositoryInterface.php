<?php

namespace App\Repositories\Interefaces\TeacherDashboard;

interface TeacherRepositoryInterface {

    public function dashboard();

    public function getSections();

    public function getStudents();

    public function getAttendance();

    public function storeAttendance($request);

    public function getReports();

    public function getTeacherStudents();

    public function reportSearch($request);

    public function examedStudents($quiz_id);

    public function repeatExam($request);
    
    // for ajax
    public function ajaxGetClassrooms($id);
    // for ajax
    public function ajaxGetSections($id);

}