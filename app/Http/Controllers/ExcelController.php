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
    private $perPage = 8; // Number of records per page
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
                ->withErrors(['msg' => 'The Message', 'message' => $message, 'arr' => $arr]);
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

    public function view(Request $request)
    {
        $search = $request->input('search', '');
        $startDate = $request->input('startSearchDate', '');
        $endDate = $request->input('endSearchDate', '');
        if ($startDate && $endDate) {
            // Convert dates to the correct format (Y-m-d)
            // $formattedStartDate = date('Y-m-d', strtotime($startDate));
            // $formattedEndDate = date('Y-m-d', strtotime($endDate));

            $studentData = Student::whereBetween('created_at', [$startDate, $endDate])->paginate($this->perPage);
            $data = compact('studentData', 'search');
            return view('studentview', $data);
            // dd($studentData);
        }
        // search by name and email
        if ($search !== "") {
            $studentData = Student::where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->paginate($this->perPage);
        } else {
            $studentData = Student::orderBy('id', 'desc')->paginate($this->perPage);
        }
        $data = compact('studentData', 'search');
        return view('studentview', $data);
    }

    public function delete($id)
    {
        // echo $id;
        $studentData = Student::find($id);
        if (!is_null($studentData)) {
            $studentData->delete();
            session()->flash('success', 'Student deleted successfully');
        } else {
            session()->flash('error', 'Student not found');
        }
        return redirect('studentview');
    }

    public function edit($id)
    {
        $studentdata = Student::find($id);
        if (is_null($studentdata)) {
            return view('studentview');
        } else {
            $data = compact('studentdata');
            return view('studentedit', $data);
        }
    }


    public function update($id,Request $request){
        $studentdata = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|integer|digits:10',
            'address' => 'required|string|max:255',
        ]);
        $studentdata = Student::find($id);
        $studentdata->name = $request['name'];
        $studentdata->email=$request['email'];
        $studentdata->address= $request['address'];
        $studentdata->mobile =$request['mobile'];
        // dd( $studentdata );
        $studentdata->save();
        return redirect('/studentview');
    }

    public function sortById($type)
    {
        if ($type == 'desc') {
            $studentData = Student::orderBy('id', 'desc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentView', $data);
        } else {
            $studentData = Student::orderBy('id', 'asc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentview', $data);
        }
    }

    public function sortByName($type)
    {
        if ($type == 'desc') {
            $studentData = Student::orderBy('name', 'desc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentView', $data);
        } else {
            $studentData = Student::orderBy('name', 'asc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentView', $data);
        }
    }

    public function sortByEmail($type)
    {
        if ($type == 'desc') {
            $studentData = Student::orderBy('email', 'desc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentView', $data);
        } else {
            $studentData = Student::orderBy('email', 'asc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentView', $data);
        }
    }
    public function sortByAddress($type)
    {
        if ($type == 'desc') {
            $studentData = Student::orderBy('address', 'desc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentView', $data);
        } else {
            $studentData = Student::orderBy('address', 'asc')->paginate($this->perPage);
            $data = compact('studentData');
            return view('studentView', $data);
        }
    }

    public function updateStatus(Request $request)
    {
        $idsArr = $request->input('idsArr');
        // dd($idsArr);
        Student::whereIn('id', $idsArr)->update(['status' => '1']);
        return response()->json(['message' => 'status activate successfully', 'status' => 200]);
    }

    public function inactiveupdateStatus(Request $request)
    {
        $idsArr2 = $request->input('idsArr2');
        // dd($idsArr2);
        Student::whereIn('id', $idsArr2)->update(['status' => '0']);
        return response()->json(['message' => 'status inactivated successfully', 'status' => 200]);
    }


    public function changeStatusUsingBtn($id)
    {
        $studentData = Student::find($id);
        if ($studentData) {
            $studentData->status = $studentData->status == '1' ? '0' : '1';
            $studentData->save();
            // $message = 'Status updated successfully';
            // $data = compact('studentData','message');
            return back();
        } else {
            return back();
        }
    }

}