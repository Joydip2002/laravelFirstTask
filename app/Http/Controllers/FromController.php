<?php

namespace App\Http\Controllers;

use App\Models\Tabulardata;
use Illuminate\Http\Request;
class FromController extends Controller
{
    public function submitForm(Request $request)
    {
        
        $options = $request->input('data', []);
        $options_data = [];
        foreach ($options as $key => $value) {
           
            // echo "<pre>";print_r ($value['name']);"<br />";
            // echo $value->name;die;
            $options_data[] = ['name' => $value['name'], 'email' => $value['email'],'mobile' => $value['mobile'],'address' => $value['address']];
        }    
        Tabulardata::insert($options_data); 
        $response = [
            "status" => 200,
            "message" => "saved successfully",
            "data" => []
        ];
        return response()->json($response);
    }
}
