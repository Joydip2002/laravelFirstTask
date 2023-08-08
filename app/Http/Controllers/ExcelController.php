<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Imports\StudentImport;
use App\Models\Student;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function submitExcel()
    {
        return view('fetchExcelDataInsertDb');
    }
    public function upload(FormPostRequest $request)
    {
        $request->excelFile;
        
        // Example validation
        // $request->validate([
        //     'email' => 'required|unique:posts|max:100',
        //     'mobile' => 'required|unique:posts|max:12|numeric'
        // ]);
    
        // Your import logic
        Excel::import(new StudentImport, $request->file('excelFile'));
    
        $message = 'Data Fetched Successfully';
    
        // Handle session data and errors
        if (session()->has('value') && session()->has('error')) {
            $arr = session()->pull('value')[0];
            $errorarr = session()->pull('error')[0];

            return Redirect::back()
                ->with('message', $message)
                ->with('arr', $arr)
                ->with('errorarr', $errorarr)
                ->withErrors(['msg' => 'The Message','message'=> $message,'arr'=> $arr]);
        }
        if (session()->has('value')) {
            $arr = session()->pull('value')[0];
            return Redirect::back()
                ->with('message', $message)
                ->with('arr', $arr)
                ->withErrors(['msg' => 'The Message']);
        }
        if (session()->has('error')) {
            $errorarr = session()->pull('error')[0];
            return Redirect::back()
                ->with('message', $message)
                ->with('errorarr', $errorarr)
                ->withErrors(['msg' => 'The Message']);
        }
    
        return Redirect::back()
            ->with('message', $message)
            ->withErrors(['msg' => 'The Message']);
    }
    
    public function view()
    {
        $studentData = Student::orderBy('id', 'desc')->get();
        // echo "<pre>";
        // print_r($studentData->toArray());die("post");
        $data = compact('studentData');
        return view('studentView')->with($data);
    }
}