<?php

namespace App\Imports;

use App\Organization;
use App\Province;
use App\District;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
// use Maatwebsite\Excel\Validators\Failure;
// use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\SkipsFailures;

class OrganizationsImport implements ToModel, WithValidation, WithHeadingRow
{
   
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $province_name = strtolower($row['province']);
        $province = Province::where(strtolower('name'),$province_name)->first();
        $district_name = strtolower($row['district']);
        $district = District::where(strtolower('name'),$district_name)->first();
        if((!isset($province)) && (!isset($district)))
        {
            
            $new_province = Province::create([
                'name' => $province_name,
            ]);

                $new_district = District::create([
                    'name' => $district_name,
                    'province_id' => $new_province->id,
                ]);

            return new Organization([
                'name' => $row['name'],
                'address' => $row['address'],
                'contact' => $row['contact'],
                'province_id' => $new_province->id,
                'district_id' => $new_district->id,
            ]);
        }
        elseif((isset($province)) && (!isset($district)))
        {
            
            if(!isset($district)){
                $new_district = District::create([
                    'name' => $district_name,
                    'province_id' => $province->id,
                ]);
            }

            return new Organization([
                'name' => $row['name'],
                'address' => $row['address'],
                'contact' => $row['contact'],
                'province_id' => $province->id,
                'district_id' => $new_district->id,
            ]);
        }
        else{
            
            return new Organization([
                'name' => $row['name'],
                'address' => $row['address'],
                'contact' => $row['contact'],
                'province_id' => $province->id,
                'district_id' => $district->id,
            ]);
        }

    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
            'address' => [
                'required',
            ],
            'contact' => [
                'required',
            ],
            'province' => [
                'required',
            ],
            'district' => [
                'required',
            ],
            
        ];
    }
}
