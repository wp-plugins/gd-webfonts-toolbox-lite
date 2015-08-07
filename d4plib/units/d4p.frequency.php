<?php

/*
Name:    d4pLib_Units: Frequency
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Frequency')) {
    class d4pLib_Unit_Frequency extends d4pLib_UnitType {
        public $base = 'Hz';

        public function init() {
            $this->name = __("Frequency", "d4plib");

            $this->list = array(
                'Hz' => __("Hertz", "d4plib"),
                'kHz' => __("Kilohertz", "d4plib"),
                'MHz' => __("Megahertz", "d4plib"),
                'GHz' => __("Gigahertz", "d4plib"),
                'THz' => __("Terahertz", "d4plib"),
                'mHz' => __("Millihertz", "d4plib"),
                'rad/hr' => __("Radian / Hour", "d4plib"),
                'rad/min' => __("Radian / Minute", "d4plib"),
                'rad/s' => __("Radian / Second", "d4plib"),
                'deg/hr' => __("Degree / Hour", "d4plib"),
                'deg/min' => __("Degree / Minute", "d4plib"),
                'deg/s' => __("Degree / Second", "d4plib"),
                'cps' => __("Cycle / Second", "d4plib")
            );

            $this->convert = array(
                'Hz' => 1,
                'kHz' => 1000,
                'MHz' => 1000000,
                'GHz' => 1000000000,
                'THz' => 1000000000000,
                'mHz' => 0.001,
                'rad/hr' => 0.000044209706414415,
                'rad/min' => 0.002652582384865,
                'rad/s' => 0.159154943091895,
                'deg/hr' => 0.000000771604938272,
                'deg/min' => 0.000046296296296296,
                'deg/s' => 0.002777777777778,
                'cps' => 1,
            );
        }
    }
}

?>