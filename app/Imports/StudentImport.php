<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $arr = array();
        $errorArr = [];
        foreach ($rows as $row) {
            if (!str_contains($row['email'], '@')) {
                array_push($errorArr, $row['email'] . '  --is not a valid email must Contains @');
            } else if (!str_contains($row['email'], '.')) {
                array_push($errorArr, $row['email'] . '  --is not a valid email must contains .');
            } else if (!is_numeric($row['mobile'])) {
                array_push($errorArr, $row['mobile'] . '  --it is only contains numeric value');
            } else if (!(strlen($row['mobile']) == 10)) {
                array_push($errorArr, $row['mobile'] . '  --must contains 10 numeric value');
            } else {
                $emailExists = Student::where('email', $row['email'])->count();
                $mobileExists = Student::where('mobile', $row['mobile'])->count();
                if ($emailExists === 0 && $mobileExists === 0) {
                    Student::create(
                        [
                            'name' => $row['name'],
                            'email' => $row['email'],
                            'address' => $row['address'],
                            'mobile' => $row['mobile'],
                        ]
                    );
                } else {
                    // dd($row['email']);
                    // dd('Duplicate entry: ' . $row['email'] . ' or ' . $row['mobile']);
                    // dd(array_push($arr,$row['email'],$row['mobile']));
                    array_push($arr, $row['email'] . " " . $row['mobile']);
                }
            }
        }
        // dd($arr);
        if(count($arr) >= 1){
            session()->push('value', $arr);
        }
        if(count($errorArr) >= 1){
            session()->push('error',$errorArr);
        }
        
    }
}