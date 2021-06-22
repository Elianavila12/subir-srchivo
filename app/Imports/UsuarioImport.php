<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class UsuarioImport implements ToCollection
{
    use Importable;

    protected $row_number;
    private $new_registers = [];

    function __construct($row_number) {
        $this->row_number = $row_number;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $rows = $collection->toArray();

        foreach ($rows as $index => $row) {
            if($index > 0 && $index <= $this->row_number && $row[0]){

                $usuario = new \App\Models\User();
                $usuario->id = $row[0];
                $usuario->nombre = $row[1];
                $usuario->cedula = $row[2];
                $usuario->peso = $row[3];
                $usuario->fecha_nacimiento = $row[4];
                $usuario->fecha_hora_ingreso = $row[5];
                $usuario->estado = $row[6];
                //$usuario->save();

                array_push($this->new_registers, $usuario);
            }
        }
    }

    public function getNewRegisters(): array
    {
        return $this->new_registers;
    }
}
