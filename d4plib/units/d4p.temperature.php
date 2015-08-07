<?php

/*
Name:    d4pLib_Units: Temperature
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Temperature')) {
    class d4pLib_Unit_Temperature extends d4pLib_UnitType {
        public $base = 'C';

        public function init() {
            $this->name = __("Temperature", "d4plib");

            $this->list = array(
                'C' => __("Celsius", "d4plib"),
                'F' => __("Fahrenheit", "d4plib"),
                'K' => __("Kelvin", "d4plib"),
                'R' => __("Reaumur", "d4plib")
            );

            $this->convert = array(
                'C' => array('ratio' => 1, 'offset' => 0),
                'F' => array('ratio' => 1.8, 'offset' => 32),
                'K' => array('ratio' => 1, 'offset' => 273),
                'R' => array('ratio' => 0.8, 'offset' => 0)
            );

            $this->system = array(
                'metric' => array('C', 'K'),
                'imperial' => array('F'),
                'us' => array('F')
            );
        }

        public function convert($value, $from, $to) {
            $ratio_from = $this->convert[$from];
            $ratio_to = $this->convert[$to];

            $value_base = ($value - $ratio_from['offset']) / $ratio_from['ratio'];
            echo $value_base * $ratio_to['ratio'] + $ratio_to['offset'];
        }
    }
}

?>