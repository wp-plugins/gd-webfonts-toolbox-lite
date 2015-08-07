<?php

/*
Name:    d4pLib_Units: Electrical Charge
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_ElectricalCharge')) {
    class d4pLib_Unit_ElectricalCharge extends d4pLib_UnitType {
        public $base = 'C';

        public function init() {
            $this->name = __("Electrical Charge", "d4plib");

            $this->list = array(
                'C' => __("Coulomb", "d4plib"),
                'nC' => __("Nanocoulomb", "d4plib"),
                'uC' => __("Microcoulomb", "d4plib"),
                'mC' => __("Millicoulomb", "d4plib"),
                'kC' => __("Kilocoulomb", "d4plib"),
                'MC' => __("Megacoulomb", "d4plib"),
                'GC' => __("Gigacoulomb", "d4plib"),
                'abC' => __("Abcoulomb", "d4plib"),
                'emu' => __("Electromagnetic unit of charge", "d4plib"),
                'ecu' => __("Electrostatic unit of chargee", "d4plib"),
                'F' => __("Faraday", "d4plib"),
                'Fr' => __("Franklin", "d4plib"),
                'Ah' => __("Ampere Hour", "d4plib"),
                'Am' => __("Ampere Minute", "d4plib"),
                'As' => __("Ampere Second", "d4plib"),
                'mAh' => __("Milliampere Hour", "d4plib"),
                'mAm' => __("Milliampere Minute", "d4plib"),
                'mAs' => __("Milliampere Second", "d4plib")
            );

            $this->convert = array(
                'C' => 1,
                'nC' => 0.000000001,
                'uC' => 0.000001,
                'mC' => 0.001,
                'kC' => 1000,
                'MC' => 1000000,
                'GC' => 1000000000,
                'abC' => 10,
                'emu' => 10,
                'ecu' => 0.000000000334,
                'F' => 96485.338300000003,
                'Fr' => 0.000000000334,
                'Ah' => 3600,
                'Am' => 60,
                'As' => 1,
                'mAh' => 3.6,
                'mAm' => 0.06,
                'mAs' => 0.001
            );
        }
    }
}

?>