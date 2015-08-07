<?php

/*
Name:    d4pLib_Units: Area
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Area')) {
    class d4pLib_Unit_Area extends d4pLib_UnitType {
        public $base = 'm2';

        public function init() {
            $this->name = __("Area", "d4plib");

            $this->display = array(
                'm2' => 'm&sup2;',
                'km2' => 'km&sup2;',
                'cm2' => 'cm&sup2;',
                'mm2' => 'mm&sup2;',
                'um2' => '&micro;m&sup2;',
                'in2' => 'in&sup2;',
                'mi2' => 'mi&sup2;',
                'dt2' => 'ft&sup2;',
                'yd2' => 'yd&sup2;'
            );

            $this->list = array(
                'm2' => __("Square Meter", "d4plib"),
                'km2' => __("Square Kilometer", "d4plib"),
                'cm2' => __("Square Centimeter", "d4plib"),
                'mm2' => __("Square Millimeter", "d4plib"),
                'um2' => __("Square Micrometer", "d4plib"),
                'in2' => __("Square Inch", "d4plib"),
                'mi2' => __("Square Mile", "d4plib"),
                'ft2' => __("Square Foot", "d4plib"),
                'yd2' => __("Square Yard", "d4plib"),
                'a' => __("Are", "d4plib"),
                'ha' => __("Hectare", "d4plib"),
                'acre' => __("Acre", "d4plib")
            );

            $this->convert = array(
                'm2' => 1,
                'km2' => 1000000,
                'cm2' => 0.0001,
                'mm2' => 0.000001,
                'um2' => 0.000000000001,
                'in2' => 0.00064516,
                'mi2' => 2589988.110336,
                'ft2' => 0.09290304,
                'yd2' => 0.83612736,
                'a' => 100,
                'ha' => 10000,
                'acre' => 4046.8564224
            );

            $this->system = array(
                'metric' => array('m2', 'km2', 'cm2', 'mm2', 'um2', 'a', 'ha'),
                'imperial' => array('in2', 'mi2', 'ft2', 'yd2', 'acre'),
                'us' => array('in2', 'mi2', 'ft2', 'yd2', 'acre')
            );
        }
    }
}

?>