<?php

/*
Name:    d4pLib_Units: Angle
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Angle')) {
    class d4pLib_Unit_Angle extends d4pLib_UnitType {
        public $base = 'radian';

        public function init() {
            $this->name = __("Angle", "d4plib");

            $this->list = array(
                'radian' => __("Radian", "d4plib"),
                'grad' => __("Grad", "d4plib"),
                'degree' => __("Degree", "d4plib"),
                'minute' => __("Minute", "d4plib"),
                'second' => __("Second", "d4plib"),
                'revolution' => __("Revolution", "d4plib"),
            );

            $this->convert = array(
                'radian' => 1,
                'grad' => 0.015707963268,
                'degree' => 0.01745329252,
                'minute' => 0.00029088820867,
                'second' => 0.0000048481368111,
                'revolution' => 6.283185307,
            );
        }
    }
}

?>