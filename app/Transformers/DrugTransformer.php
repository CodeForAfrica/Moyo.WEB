<?php
namespace App\Transformers;


class DrugTransformer 
{
	public static function transform($drugs)
	{
        $drugArray = [];

	    foreach ($drugs as $drug) {
            $drug->name = str_replace("Nifedipine Retard","Nifedipine",$drug->name);
            $drug->name = str_replace("Isosorbide Dinitrate","Isosorbide", $drug->name);

            array_push($drugArray,$drug);
        }

        return $drugArray;
	}
}