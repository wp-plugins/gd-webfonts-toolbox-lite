<?php

/*
Name:    d4pLib_Units: Electric Current
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_ElectricCurrent')) {
    class d4pLib_Unit_ElectricCurrent extends d4pLib_UnitType {
        public $base = 'A';

        public function init() {
            $this->name = __("Electric Current", "d4plib");

            $this->list = array(
                'A' => __("Ampere", "d4plib"),
                'mA' => __("Milliampere", "d4plib"),
                'abamp' => __("Abamper", "d4plib"),
                'MA' => __("Megampere", "d4plib"),
                'esu/s' => __("Statampere", "d4plib")
            );

            $this->convert = array(
                'A' => 1,
                'mA' => 0.001,
                'abamp' => 10,
                'MA' => 0.000333564095198,
                'esu/s' => 3.33564095198152e-010
            );
        }
    }
}

?>