<?php

namespace App\Imports;

use App\Http\Models\ImportedCandidates;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCandidates implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure {

    use Importable, SkipsErrors;
    
    public function model(array $row) {
        return new ImportedCandidates([
            'full_name'     => $row['full_name'],
            'designation'    => $row['designation'],
            'last_company'    => $row['last_company'],
            'education'    => $row['education'],
            'location'    => $row['location'],
            'mobile'    => $row['mobile'],
            'email'    => $row['email'],
            'experience'    => $row['experience'],
            'gender'    => $row['gender'],
            'age'    => $row['age'],
            'salary'    => $row['salary'],
            'source'    => $row['source'],
            'remarks'    => $row['remarks'],
        ]);
    }

    public function rules(): array {
        return [
            '*.email' => ['unique:imported_candidates,email']
        ];
    }

    public function onFailure(Failure ...$failure) {
        return $failure;
    }
}
