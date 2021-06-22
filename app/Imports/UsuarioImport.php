<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Validators\Failure;

class UsuarioImport implements ToCollection, WithValidation, WithChunkReading, WithCustomCsvSettings, SkipsOnFailure
{
    use Importable, SkipsFailures;

    private $new_registers = [];
    private $errors = [];

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $rows = $collection->toArray();

        foreach ($rows as $index => $row) {
            if($index >= 1 && $row[0]){                
                $validator = Validator::make($row, $this->rules(), $this->validationMessages());
                if ($validator->fails()) {
                    foreach ($validator->errors()->messages() as $messages) {
                        foreach ($messages as $error) {
                            $this->errors[] = $error;
                        }
                    }
                } else {                    
                    try {
                        $usuario = \App\Models\User::where('cedula', $row[1])->first();

                        if (isset($usuario)) {
                            $usuario->nombre = $row[0];
                            $usuario->cedula = $row[1];
                            $usuario->peso = $row[2];
                            $usuario->fecha_nacimiento = $row[3];
                            $usuario->fecha_hora_ingreso = $row[4];
                            $usuario->estado = ($row[5] == 'si' ? 1 : 0);
                        } else { 
                            $usuario = new \App\Models\User();
                            $usuario->nombre = $row[0];
                            $usuario->cedula = $row[1];
                            $usuario->peso = $row[2];
                            $usuario->fecha_nacimiento = $row[3];
                            $usuario->fecha_hora_ingreso = $row[4];
                            $usuario->estado = ($row[5] == 'si' ? 1 : 0);
                            $usuario->save();
                        }

                        array_push($this->new_registers, $usuario);
                    } catch (\Throwable $th) {
                        $this->errors[] = 'Ocurrio un error | ' . $row[1]. '|' .$th->getMessage();
                    }
                }
            }
        }
    }

    public function getNewRegisters(): array
    {
        return $this->new_registers;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required|unique:users,cedula',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
        ];
    }

    public function validationMessages()
    {
        return [
            '0.required' => 'El campo nombre es requerido',
            '1.required' => 'El campo cedula es requerido',
            '1.unique'   => 'El campo cedula :input debe ser unico',
            '2.required' => 'El campo peso es requerido',
            '3.required' => 'El campo fecha de nacimiento es requerido',
            '4.required' => 'El campo fecha y hora de ingreso es requerido',
            '5.required' => 'El campo estado es requerido',
        ];        
    }
}
