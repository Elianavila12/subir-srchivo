<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromArray, WithHeadings
{
    protected $user;

    function __construct($user) {
        $this->user = $user;
    }

    /**
    * @return \Illuminate\Support\Array
    */
    public function array(): array
    {
        return $this->user;
        //return User::where('id', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Cedula',
            'Peso',
            'Fecha de nacimiento',
            'Fecha y hora de ingreso',
            'Estado'
        ];
    }
}
