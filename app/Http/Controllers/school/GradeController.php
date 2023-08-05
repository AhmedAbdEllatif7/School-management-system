<?php

namespace App\Http\Controllers\school;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Requests\StoreGrade;
use App\Models\Grade;
use App\Repository\GradeRepositoryInterface;
use Illuminate\Http\Request;
use SebastianBergmann\Diff\Exception;

class GradeController extends Controller
{

    protected $grade;
    public function __construct(GradeRepositoryInterface $grade)
    {
        $this->grade = $grade;
    }
  public function index()
  {
       return $this->grade->index();
  }


  public function create()
  {

  }


  public function store(StoreGrade $request)
  {
      return $this->grade->store($request);
  }

  public function show($id)
  {

  }


  public function edit(Request $request)
  {
      return "cc";
  }


  public function update(StoreGrade $request)
  {
      return $this->grade->update($request);

  }



  public function destroy(Request $request)
  {
      return $this->grade->delete($request);

  }



    public function deleteSelected(Request $request)
    {
        return $this->grade->deleteSelected($request);

    }


    public function deleteAllGrade(Request $request)
    {
        return $this->grade->deleteAllGrade($request);

    }








}

?>
