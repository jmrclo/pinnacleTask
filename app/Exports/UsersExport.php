<?php

namespace App\Exports;

use App\Models\User;
use App\Models\students;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection,WithHeadings ,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

      return students::all();
        
       
    }

    public function map( $row): array
    {
        return [
       


            $row->firstname,
            $row->lastname,
            $row->gender,
            $row->birthday,
            $row->age,
            $row->birthplace,
            $row->phone,
            $row->email,
            $row->address,
            
        ];
    }


    public function headings(): array
    {
        return [
           
            'firstname' ,  
            'lastname'  , 
            'gender'   ,
            'birthday'  ,  
            'age'    ,
            'birthplace',    
            'phone'    ,
            'email'    ,
            'address'  ,
        ];
    }


}



