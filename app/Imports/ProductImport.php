<?php

namespace App\Imports;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements WithHeadingRow, ToCollection
{

    public function collection(Collection $rows)
    {
        $exist = 0;
        $inserted = 0;

        $filtered = $rows->filter(function ($row) {
            if (strlen($row['kod_modeli_artikul_proizvoditelya']) === 10) {
                return true;
            }
        });

        $uniqueCategories = $filtered->unique('kategoriya_tovara');
        foreach ($uniqueCategories as $category) {
            try {
                Category::create([
                    'title' => $category['kategoriya_tovara']
                ]);
            } catch (\Exception $exception) {

            }
        }

        foreach ($filtered as $row) {
            try {
                Product::create([
                    'rubric' => $row['rubrika'],
                    'producer' => $row['proizvoditel'],
                    'name' => $row['naimenovanie_tovara'],
                    'code' => $row['kod_modeli_artikul_proizvoditelya'],
                    'description' => $row['opisanie_tovara'],
                    'guarantee' => $row['garantiya'],
                    'cost' => $row['tsena_rozn_grn'],
                    'exist' => $row['nalichie'],
                    'category_id' => Category::where('title', '=', $row['kategoriya_tovara'])->first()->id
                ]);
                $inserted++;
            } catch (\Exception $exception) {
                $exist++;
            }
        }

        session()->flash('count', ['exist' => $exist, 'inserted' => $inserted, 'inputData' => $rows->count(), 'correctStructure' => $filtered->count()]);
    }
}
