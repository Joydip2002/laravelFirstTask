<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Imports\StudentImport;
use App\Models\MulImageUpload;
use App\Models\Student;
use App\Models\User;
use App\Models\UserSignup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function trash()
    {
        $studentData = Student::onlyTrashed()->paginate();
        $data = compact('studentData');
        return view('studenttrash')->with($data);
    }

    public function restore($id)
    {
        $studentData = Student::withTrashed()->find($id);
        if (!is_null($studentData)) {
            $studentData->restore();
            session()->flash('success', 'restored successfully');
        } else {
            session()->flash('error', 'student not found');
        }
        return back();
    }

    public function delete($id)
    {
        // echo $id;
        $studentData = Student::find($id);
        if (!is_null($studentData)) {
            $studentData->delete();
            session()->flash('success', 'move to trash successfully');
        } else {
            session()->flash('error', 'student not found');
        }
        return back();
    }

    public function forcedelete($id)
    {

        $studentData = Student::withTrashed()->find($id);
        if (!is_null($studentData)) {
            $studentData->forceDelete();
            session()->flash('success', 'deleted successfully');
        } else {
            session()->flash('error', 'student not found');
        }
        return back();
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


    public function update($id, Request $request)
    {
        $studentdata = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|integer|digits:10',
            'address' => 'required|string|max:255',
        ]);
        $studentdata = Student::find($id);
        $studentdata->name = $request['name'];
        $studentdata->email = $request['email'];
        $studentdata->address = $request['address'];
        $studentdata->mobile = $request['mobile'];
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

    public function deletebulk(Request $request)
    {
        $idsArr3 = $request->input('idsArr3');
        Student::whereIn('id', $idsArr3)->delete();
        return response()->json(['message' => 'move to trash successfully', 'status' => 200]);
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

    public function loginPage()
    {
        return view('login');
    }

    public function eloginuser(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'email'=>'required | email ',
        //     'password'=> 'required'
        // ]);
        // $email = $request->input('email');
        // $password = $request->input('password');

        // $user = UserSignup::where('email',$email)->first();

        // if($user && $password == $user->password){
        //     session(['user_id' => $user->id,'user_name' => $user->name]);
        //     return redirect('/submitExcel');
        // }
        // else{
        //     return back()->with('fail','Invalid Credentials');
        // }
        $request->validate([
            'email' => 'required | email ',
            'password' => 'required'
        ]);
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $credentials = $request->only('email', 'password');
        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            session(['user_id' => $user->id, 'user_name' => $user->name]);
            return redirect()->intended('/submitExcel');
        } else {
            return back()->with('fail', 'Invalid Credentials');
        }
    }

    public function signupPage()
    {
        return view('signup');
    }

    public function signupuser(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'gender' => 'required',
            'address' => 'required',
            'password' => 'required',
            'confirmpassword' => 'required|same:password'
        ]);
        $user_data = new User;
        $user_data->name = $request->input('name');
        $user_data->email = $request->input('email');
        $user_data->address = $request->input('address');
        $user_data->gender = $request->input('gender');
        $user_data->password = Hash::make($request->input('password'));
        $details = [
            'title' => 'Mail from Joydip',
            'body' => 'Hello,  ' . $request->input('name'),
            'main' => '   Welcome our environment.You have successfully registered!!',
            'credentialshead' =>'login credentials :-- ',
            'credentialsusername' => 'Username :' . $request->input('email'),
            'credentialpassword' => ' password : registration time set password|  Thank You..'
        ];

        // \Mail::to('mannajoydip290@gmail.com')->send(new \App\Mail\MyTestMail($details));
        // dd("Email is Sent.");
        \Mail::to($request->input('email'))->send(new \App\Mail\MyTestMail($details));
        $user_data->save();
        // sleep(5000);
        return redirect('/')->with("mail", "Sign up successful! Welcome to Login Page.");
    }
    public function logout()
    {
        // dd (session('user_id'));
        // session()->forget(['user_id', 'user_name']);
        //     return redirect('/');
        \Session::flush();
        \Auth::logout();
        return redirect('/');
    }

    // multiple Image upload
    public function uploadImage()
    {
        return view('mulImageUpload');
    }

    public function importMulImage(Request $request)
    {
        // dd($request->all());
        $image = [];
        $errorMessages = [];
        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $ext = strtolower($file->getClientOriginalExtension());

                if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
                    $image_name = md5(rand(1000, 10000));
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = 'public/images/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);
                    $image[] = $image_url;
                } elseif (in_array($ext, ['xls', 'xlsx'])) {
                    $errorMessages = "Excel files are not allowed.";
                }
            }
        }

        if (!empty($image) && $errorMessages) {
            MulImageUpload::insert([
                'image' => implode('|', $image), //use to concatenate url with |
            ]);
            return back()->with('success', 'Successfully Upload')->withErrors($errorMessages);
        } elseif (!$errorMessages) {
            MulImageUpload::insert([
                'image' => implode('|', $image), //use to concatenate url with |
            ]);
            return back()->with('success', 'Successfully Upload');
        } else {
            return back()->with('error', 'No supported image files were uploaded.');
        }
    }

    public function showImage()
    {
        $data = MulImageUpload::all();
        // $data = compact('images');
        return view('show-image', compact('data'));
    }

    public function forgotPassword()
    {
        return view("forgot-password");
    }

    public function forgotPasswordPage(Request $request)
    {
        // dd($request->email);
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {
            $id = base64_encode($user->id);
            $details = [
                'title' => 'Mail from Joydip',
                'body' => 'Hello,  ' . $user->email,
                'main' => 'password rest link : http://localhost:8000/reset-password/' . $id
            ];

            \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
            // dd("Email is Sent.");
            return redirect("/")->with('mailsend', 'Check Email and reset password then login..');
        } else {
            return redirect("/forgot-password")->with('notmailsend', 'Email does not exits');
        }
    }

    public function resetPassword($id)
    {
        return view('resetPassword', compact('id'));
    }
    public function resetPasswordPage(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        // dd($id);
        $request->validate([
            "password" => "required",
            "cpassword" => "required|same:password"
        ]);

        if ($request->password == $request->cpassword) {
            $uid = base64_decode($id);
            $uid = User::find($uid);
            // dd($uid);
            $uid->password = Hash::make($request->password);
            $uid->save();
            return redirect('/')->with('success','successfully updated!!');
        }
    }
}