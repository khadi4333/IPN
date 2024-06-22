<?php

namespace App\Exports;

use App\Models\Categorie;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Categorie::all([
            'parent_id','type' 
        ]);
    }
    public function headings(): array
    {
        return [
            'PARENT_ID',
            'TYPE'
            
        ];
    }
    public function query()
    {
        return Categorie::query();
    }
    public function map($bulk): array
    {
        return [
            $bulk->type,
            $bulk->parent_id,
        ];
    }
}