<?php

/*
Name:    d4pLib_Units: Volume
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Volume')) {
    class d4pLib_Unit_Volume extends d4pLib_UnitType {
        public $base = 'l';

        public function init() {
            $this->name = __("Volume", "d4plib");

            $this->display = array(
                'dm3' => 'dm&sup3;',
                'mm3' => 'mm&sup3;',
                'm3' => 'm&sup3;',
                'km3' => 'km&sup3;',
                'cup/us' => 'cup',
                'tablespoon/us' => 'tablespoon',
                'teaspoon/us' => 'teaspoon',
                'barrel/us/petroleum' => 'barrel',
                'gallon/us' => 'gallon',
                'quart/us' => 'quart',
                'pint/us' => 'pint',
                'barrel/us/dry' => 'barrel',
                'bushel/us' => 'bushel',
                'gallon/us/dry' => 'gallon',
                'quart/us/dry' => 'quart',
                'pint/us/dry' => 'pint',
                'bushel/uk' => 'bushel',
                'gallon/uk' => 'gallon',
                'quart/uk' => 'quart',
                'pint/uk' => 'pint',
            );
            
            $this->list = array(
                'l' => __("Liter", "d4plib"),
                'dl' => __("Deciliter", "d4plib"),
                'cl' => __("Centiliter", "d4plib"),
                'ml' => __("Milliliter", "d4plib"),
                'ul' => __("Microliter", "d4plib"),
                'decl' => __("Decaliter", "d4plib"),
                'hl' => __("Hectoliter", "d4plib"),
                'dm3' => __("Cubic Decimeter", "d4plib"),
                'cc' => __("Cubic Centimeter", "d4plib"),
                'mm3' => __("Cubic Millimeter", "d4plib"),
                'm3' => __("Cubic Meter", "d4plib"),
                'km3' => __("Cubic Kilometer", "d4plib"),
                'cup' => __("Cup", "d4plib"),
                'tablespoon' => __("Table spoon", "d4plib"),
                'teaspoon' => __("Teas spoon", "d4plib"),
                'cup/us' => __("Cup / US", "d4plib"),
                'tablespoon/us' => __("Table spoon / US", "d4plib"),
                'teaspoon/us' => __("Teas spoon / US", "d4plib"),
                'barrel/us/petroleum' => __("Barrel Petroleum / US", "d4plib"),
                'gallon/us' => __("Gallon / US", "d4plib"),
                'quart/us' => __("Quart / US", "d4plib"),
                'pint/us' => __("Pint / US", "d4plib"),
                'barrel/us/dry' => __("Barrel Dry / US", "d4plib"),
                'bushel/us' => __("Bushel / US", "d4plib"),
                'gallon/us/dry' => __("Gallon Dry / US", "d4plib"),
                'quart/us/dry' => __("Quart Dry / US", "d4plib"),
                'pint/us/dry' => __("Pint Dry / US", "d4plib"),
                'bushel/uk' => __("Bushel / UK", "d4plib"),
                'gallon/uk' => __("Gallon / UK", "d4plib"),
                'quart/uk' => __("Quart / UK", "d4plib"),
                'pint/uk' => __("Pint / UK", "d4plib"),
            );

            $this->convert = array(
                'l' => 1,
                'dl' => 10,
                'cl' => 100,
                'ml' => 1000,
                'ul' => 1000000,
                'decl' => 0.1,
                'hl' => 0.01,
                'dm3' => 1,
                'cc' => 1000,
                'mm3' => 1000000,
                'm3' => 0.001,
                'km3' => 0.000000000001,
                'cup' => 4.167,
                'tablespoon' => 66.67,
                'teaspoon' => 200,
                'cup/us' => 4.227,
                'tablespoon/us' => 67.63,
                'teaspoon/us' => 202.9,
                'barrel/us/petroleum' => 0.00629,
                'gallon/us' => 0.2642,
                'quart/us' => 1.057,
                'pint/us' => 2.113,
                'barrel/us/dry' => 0.008648,
                'bushel/us' => 0.02838,
                'gallon/us/dry' => 0.227,
                'quart/us/dry' => 0.9081,
                'pint/us/dry' => 1.816,
                'bushel/uk' => 0.0275,
                'gallon/uk' => 0.22,
                'quart/uk' => 0.8799,
                'pint/uk' => 1.76,
            );
        }
    }
}

?>