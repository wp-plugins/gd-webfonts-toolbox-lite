<?php

/*
Name:    d4pLib_Units: Torque
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Torque')) {
    class d4pLib_Unit_Torque extends d4pLib_UnitType {
        public $base = 'Nm';

        public function init() {
            $this->name = __("Torque", "d4plib");

            $this->display = array(
                'uNm' => '&micro;Nm'
            );

            $this->list = array(
                'Nm' => __("Newton Meter", "d4plib"),
                'Ncm' => __("Newton Centimeter", "d4plib"),
                'Nmm' => __("Newton Millimeter", "d4plib"),
                'kNm' => __("Kilonewton Meter", "d4plib"),
                'MNm' => __("Meganewton Meter", "d4plib"),
                'uNm' => __("Micronewton Meter", "d4plib"),
                'dyn cm' => __("Dyne Centimeter", "d4plib"),
                'dyn m' => __("Dyne Meter", "d4plib"),
                'dyn mm' => __("Dyne Millimeter", "d4plib"),
                'ozf ft' => __("Ounce Force Feet", "d4plib"),
                'ozf in' => __("Ounce Force Inch", "d4plib"),
                'lbf ft' => __("Pound Force Feet", "d4plib"),
                'lbf in' => __("Pound Force Inch", "d4plib"),
                'gf cm' => __("Gram Force Centimeter", "d4plib"),
                'gf m' => __("Gram Force Meter", "d4plib"),
                'gf mm' => __("Gram Force Millimeter", "d4plib"),
                'kgf cm' => __("Kilogram Force Centimeter", "d4plib"),
                'kgf m' => __("Kilogram Force Meter", "d4plib"),
                'kgf mm' => __("Kilogram Force Millimeter", "d4plib")
            );

            $this->convert = array(
                'Nm' => 1,
                'Ncm' => 100,
                'Nmm' => 1000,
                'kNm' => 0.001,
                'MNm' => 0.000001,
                'uNm' => 1000000,
                'dyn cm' => 10000000,
                'dyn m' => 100000,
                'dyn mm' => 100000000,
                'ozf ft' => 11.800994078,
                'ozf in' => 141.61192894,
                'lbf ft' => 0.73756212117,
                'lbf in' => 8.850745454,
                'gf cm' => 10197.16213,
                'gf m' => 101.9716213,
                'gf mm' => 101971.6213,
                'kgf cm' => 10.19716213,
                'kgf m' => 0.1019716213,
                'kgf mm' => 101.9716213
            );

            $this->system = array(
                'metric' => array('Nm', 'Ncm', 'Nmm', 'kNm', 'MNm', 'uNm', 'dyn cm', 'dyn m', 'dyn mm', 'gf cm', 'gf m', 'gf mm', 'kgf cm', 'kgf m', 'kgf mm'),
                'imperial' => array('ozf ft', 'ozf in', 'lbf ft', 'lbf in'),
                'us' => array('ozf ft', 'ozf in', 'lbf ft', 'lbf in')
            );
        }
    }
}

?>