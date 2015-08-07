<?php

/*
Name:    d4pLib_Units: Speed
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Speed')) {
    class d4pLib_Unit_Speed extends d4pLib_UnitType {
        public $base = 'kp/h';

        public function init() {
            $this->name = __("Speed", "d4plib");

            $this->list = array(
                'mp/s' => __("Meters per second", "d4plib"),
                'kp/h' => __("Kilometers per hour", "d4plib"),
                'mp/h' => __("Miles per hour", "d4plib"),
                'kn' => __("Knots", "d4plib")
            );

            $this->convert = array(
                'mp/s' => 3.6,
                'kp/h' => 1,
                'mp/h' => 1.609344,
                'kn' => 1.852
            );

            $this->system = array(
                'metric' => array('mp/s', 'kp/h'),
                'imperial' => array('mp/h'),
                'us' => array('mp/h')
            );
        }
    }
}

?>