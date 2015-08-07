<?php

/*
Name:    d4pLib_Units: Lenght or Distance
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Lenght')) {
    class d4pLib_Unit_Lenght extends d4pLib_UnitType {
        public $base = 'mm';

        public function init() {
            $this->name = __("Lenght or Distance", "d4plib");

            $this->display = array(
                'um' => '&micro;m',
                'uin' => '&micro;in'
            );

            $this->list = array(
                'nm' => __("Picometre", "d4plib"),
                'nm' => __("Nanometre", "d4plib"),
                'um' => __("Micrometre", "d4plib"),
                'mm' => __("Millimeter", "d4plib"),
                'cm' => __("Centimeter", "d4plib"),
                'dm' => __("Decimeter", "d4plib"),
                'm' => __("Meter", "d4plib"),
                'km' => __("Kilometer", "d4plib"),
                'pt' => __("Point", "d4plib"),
                'uin' => __("Micro Inch", "d4plib"),
                'in' => __("Inch", "d4plib"),
                'ft' => __("Feet", "d4plib"),
                'yd' => __("Yard", "d4plib"),
                'mi' => __("Mile", "d4plib"),
                'nmi' => __("Nautical Mile", "d4plib")
            );

            $this->convert = array(
                'pm' => 0.000000001,
                'nm' => 0.000001,
                'um' => 0.001,
                'mm' => 1,
                'cm' => 10,
                'dm' => 100,
                'm' => 1000,
                'km' => 1000000,
                'pt' => .3527778,
                'uin' => .0000254,
                'in' => 25.4,
                'ft' => 304.8,
                'yd' => 914.4,
                'mi' => 1609344,
                'nmi' => 1852000
            );

            $this->system = array(
                'metric' => array('pm', 'nm', 'um', 'mm', 'cm', 'dm', 'm', 'km'),
                'imperial' => array('pt', 'uin', 'in', 'ft', 'yd', 'mi', 'nmi'),
                'us' => array('pt', 'uin', 'in', 'ft', 'yd', 'mi', 'nmi')
            );
        }
    }
}

?>