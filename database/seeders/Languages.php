<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
class Languages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$array = [
    		'hi'=>'Hindi',
    		'as'=>'Assamese',
    		'bn'=>'Bengali',
    		'brx'=>'Bodo',
    		'doi'=>'Dogri',
    		'gu'=>'Gujarati',
    		'kn'=>'Kannada',
    		'ks'=>'Kashmiri',
    		'gom'=>'Konkani',
    		'mai'=>'Maithili',
    		'ml'=>'Malayalam',
    		'mni'=>'Meitei (Manipuri)',
    		'mr'=>'Marathi',
    		'ne'=>'Nepali',
    		'or'=>'Odia',
    		'pa'=>'Punjabi',
    		'sa'=>'Sanskrit',
    		'sat'=>'Santali',
    		'sd'=>'Sindhi',
    		'ta'=>'Tamil',
    		'te'=>'Telugu',
    		'ur'=>'Urdu', // 22 india languages 
    		'af'=>'Afrikaans',
    		'ar'=>'Arabic',
    		'hy'=>'Armenian',
    		'zh'=>'Chinese',
    		'co'=>'Corsican',
    		'da'=>'Danish',
    		'nl'=>'Dutch',
    		'fil'=>'Filipino',
    		'fi'=>'Finnish',
    		'fr'=>'French',
    		'de'=>'German',
    		'gn'=>'Guarani',
    		'ha'=>'Hausa',
    		'id'=>'Indonesian',
    		'la'=>'Latin',
    		'lt'=>'Lithuanian',
    		'ms'=>'Malay',
    		'mt'=>'Maltese',
    		'ps'=>'Pashto',
    		'pt'=>'Portuguese',
    		'qu'=>'Quechua', //43
    		'ro'=>'Romanian',
    		'ru'=>'Russian',
    		'sr'=>'Serbian',
    		'so'=>'Somali',
    		'es'=>'Spanish',
    		'su'=>'Sundanese',
    		'uk'=>'Ukrainian',
    	];
    	foreach ($array as $key => $value) {
			$language = new Language();
			$language->language_name = $value;
			$language->code = $key;
			$language->save();
    	}
    	 
    }
}
