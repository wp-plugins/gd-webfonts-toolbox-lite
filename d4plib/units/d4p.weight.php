<?php

/*
Name:    d4pLib_Units: Weight / Mass
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_WeightMass')) {
    class d4pLib_Unit_WeightMass extends d4pLib_UnitType {
        public $base = 'mg';

        public function init() {
            $this->name = __("Weight / Mass", "d4plib");

            $this->list = array(
                'mg' => __("Milligram", "d4plib"),
                'g' => __("Gram", "d4plib"),
                'kg' => __("Kilogram", "d4plib"),
                't' => __("Tonne", "d4plib"),
                'oz' => __("Ounce", "d4plib"),
                'lb' => __("Pound", "d4plib"),
                'st' => __("Stone", "d4plib"),
                'qtr' => __("Quarter", "d4plib"),
                'carat' => __("Carat", "d4plib")
            );

            $this->convert = array(
                'mg' => 1,
                'g' => 1000,
                'kg' => 1000000,
                't' => 1000000000,
                'oz' => 28349.5231,
                'lb' => 453592.37,
                'st' => 6350293.18,
                'qtr' => 12700586.36,
                'carat' => 205.196548333
            );

            $this->system = array(
                'metric' => array('mg', 'g', 'kg', 't'),
                'imperial' => array('oz', 'lb', 'carat', 'st', 'qtr'),
                'us' => array('oz', 'lb', 'carat', 'st', 'qtr')
            );
        }
    }
}

?>