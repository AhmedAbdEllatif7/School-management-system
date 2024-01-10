<?php

namespace app\Repositories\Interefaces\TeacherDashboard;

interface TeacherRepositoryInterface {

    public function dashboard();

    public function getSections();

    public function getStudents();

    public function getAttendance();

    public function storeAttendance($request);

    public function getReports();

    public function getTeacherStudents();

    public function reportSearch($request);
    
    // for ajax
    public function ajaxGetClassrooms($id);
    // for ajax
    public function ajaxGetSections($id);

}