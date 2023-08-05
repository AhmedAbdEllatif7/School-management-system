<?php

namespace App\Repository;

use App\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use Illuminate\Support\Facades\File;

class LibraryRepository implements LibraryRepositoryInterface
{

    use AttachFilesTrait;
    public function index()
    {
        $books = Library::all();
        return view('pages.library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create',compact('grades'));
    }

    public function store($request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            $this->uploadFile($request,'file_name' , 'library');

            return redirect()->route('libraries.create')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit',compact('book','grades'));
    }

    public function update($request)
    {
        try {

            $book = library::findorFail($request->id);
            $book->title = $request->title;
            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;

            if($request->hasfile('file_name')){

                $this->deleteFile($book->file_name);

                $this->uploadFile($request,'file_name' , 'library');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;

            }

            $book->save();

            return redirect()->route('libraries.index')->with(['edit_done' => trans('Students_trans.edit_done')]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function download($filename)
    {
        $filePath = public_path('attachments/library/'.$filename);

        if (File::exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with(['error_file_found' => trans('main_trans.File not found')]);
        }
    }


    public function viewFile($filename)
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
