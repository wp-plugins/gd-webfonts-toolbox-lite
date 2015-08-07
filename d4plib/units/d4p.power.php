<?php

/*
Name:    d4pLib_Units: Power
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Power')) {
    class d4pLib_Unit_Power extends d4pLib_UnitType {
        public $base = 'W';

        public function init() {
            $this->name = __("Power", "d4plib");

            $this->list = array(
                'W' => __("Watt", "d4plib"),
                'kW' => __("Kilowatt", "d4plib"),
                'MB' => __("Megawatt", "d4plib"),
                'GB' => __("Gigawatt", "d4plib"),
                'hp' => __("Horsepower", "d4plib"),
                'hp-m' => __("Horsepower metric", "d4plib"),
                'mhp' => __("Millihorsepower", "d4plib"),
                'cal/hr' => __("Calorie / hour", "d4plib"),
                'cal/min' => __("Calorie / minute", "d4plib"),
                'cal/sec' => __("Calorie / second", "d4plib"),
                'joule/hr' => __("Joule / hour", "d4plib"),
                'joule/min' => __("Joule / minute", "d4plib"),
                'joule/sec' => __("Joule / second", "d4plib")
            );

            $this->convert = array(
                'W' => 1,
                'kB' => 1000,
                'MB' => 1000000,
                'GB' => 1000000000,
                'hp' => 745.69987158227,
                'hp-m' => 735.49875,
                'mhp' => 0.74569987158227,
                'cal/hr' => 0.001163,
                'cal/min' => 0.06978,
                'cal/sec' => 4.1868,
                'joule/hr' => 0.000277777777778,
                'joule/min' => 0.016666666666667,
                'joule/sec' => 1,
            );
        }
    }
}

?>