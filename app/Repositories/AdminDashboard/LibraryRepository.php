<?php

namespace app\Repositories\AdminDashboard;

use App\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use app\Repositories\Interefaces\AdminDashboard\LibraryRepositoryInterface;
use Illuminate\Support\Facades\File;

class LibraryRepository implements LibraryRepositoryInterface
{

    use AttachFilesTrait;
    public function index()
    {
        $books = Library::select('id', 'title', 'file_name', 'grade_id', 'classroom_id', 'section_id')->get();
        return view('dashboards.admin.library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::select('id', 'name')->get();
        return view('dashboards.admin.library.create',compact('grades'));
    }


    ############## Begin Store ###############################################################
    public function store($request)
    {
        try {
            $validatedData = $request->validated();
            $fileName = $this->extractFileName($request);
            $this->createLibraryRecord($validatedData, $fileName);
    
            $this->uploadFile($request, 'file_name', 'library');
    
            return redirect()->route('libraries.create')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    
    private function extractFileName($request)
    {
        return $request->file('file_name')->getClientOriginalName();
    }
    
    private function createLibraryRecord($validatedData, $fileName)
    {
        $validatedData['file_name'] = $fileName;
        Library::create($validatedData);
    }
    ################ End Store ###############################################################





    public function edit($id)
    {
        $grades =Grade::select('id', 'name')->get();
        $book = library::findorFail($id);
        return view('dashboards.admin.library.edit',compact('book','grades'));
    }




    ############## Begin Update ###############################################################
    public function update($request)
    {
        try {
            $validatedData = $request->validated();

            $book = Library::findOrFail($request->id);

            if ($request->hasFile('file_name')) {
                $validatedData['file_name'] = $this->updateTheFile($book, $request);
            }

            $book->update($validatedData);

            return redirect()->route('libraries.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    private function updateTheFile($book, $request)
    {
        $this->deleteFile('library/' . $book->file_name);

        $file_name_new = $this->uploadFile($request, 'file_name', 'library');
        
        return $file_name_new;
    }
    ############## End Update ###############################################################




    public function downloadBook($filename)
    {
        $filePath = public_path('attachments/library/'.$filename);

        if (File::exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with(['error_file_found' => trans('main_trans.File not found')]);
        }
    }


    public function viewBook($filename)
    {
        $filePath = public_path('attachments/library/'.$filename);

        if (File::exists($filePath)) {
            return response()->file($filePath);
        } else {
            return redirect()->back()->with(['error_file_found' => trans('main_trans.File not found')]);
        }
    }


    public function delete($request)
    {
        $filePath = public_path('attachments/library/'.$request->file_name);

        if (File::exists($filePath)) {
            $this->deleteFile($request->file_name);
            library::destroy($request->id);
            return redirect()->route('libraries.index')->with(['delete_done' => trans('Students_trans.delete_done')]);
        } else {
            return redirect()->back()->with(['error_file_found' => trans('main_trans.File not found')]);
        }
    }
}
