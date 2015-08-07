<?php

/*
Name:    d4pLib_Units: Energy
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/gdr2/
Info:    http://en.wikipedia.org/wiki/Unit_conversion
*/

if (!class_exists('d4pLib_Unit_Energy')) {
    class d4pLib_Unit_Energy extends d4pLib_UnitType {
        public $base = 'Wh';

        public function init() {
            $this->name = __("Energy", "d4plib");

            $this->list = array(
                'Wh' => __("Watt Hour", "d4plib"),
                'Ws' => __("Watt Second", "d4plib"),
                'mWh' => __("Milliwatt Hour", "d4plib"),
                'kWh' => __("Kilowatt Hour", "d4plib"),
                'MWh' => __("Kilowatt Hour", "d4plib"),
                'GWh' => __("Gigawatt Hour", "d4plib"),
                'cal' => __("Calorie", "d4plib"),
                'kcal' => __("Kilocalorie", "d4plib"),
                'J' => __("Joule", "d4plib"),
                'kJ' => __("Kilojoule", "d4plib"),
                'MJ' => __("Megajoule", "d4plib"),
                'GJ' => __("Gigajoule", "d4plib"),
                'uJ' => __("Microjoule", "d4plib"),
                'mJ' => __("Millijoule", "d4plib")
            );

            $this->convert = array(
                'Wh' => 1,
                'Ws' => 0.000277777777778,
                'mWh' => 0.001,
                'kWh' => 1000,
                'MWh' => 1000000,
                'GWh' => 1000000000,
                'cal' => 0.001163,
                'kcal' => 1.163,
                'J' => 0.000277777777778,
                'kJ' => 0.277777777777778,
                'MJ' => 277.777777777778,
                'GJ' => 277777.777777778,
                'uJ' => 0.000000000277777777778,
                'mJ' => 0.000000277777777778
            );
        }
    }
}

?>