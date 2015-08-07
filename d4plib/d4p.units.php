<?php

/*
Name:    d4pLib_Units
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/

== Copyright ==
Copyright 2008 - 2015 Milan Petrovic (email: milan@gdragon.info)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('d4pLib_UnitType')) {
    abstract class d4pLib_UnitType {
        public $name = '';
        public $base = '';
        public $list = array();
        public $convert = array();
        public $system = array();
        public $display;

        public function __construct($args = array()) {
            foreach ($args as $key => $value) {
                $this->$key = $value;
            }

            $this->init();
        }

        public function convert($value, $from, $to) {
            $ratio_from = $this->convert[$from];
            $ratio_to = $this->convert[$to];

            $value_base = $value * $ratio_from;
            return $value_base / $ratio_to;
        }

        abstract public function init();
    }
}

if (!class_exists('d4pLib_Units')) {
    class d4pLib_Units {
        public $data = array();
        public $units = array();
        public $args = array();

        public function __construct() {}

        private function init() {
            $this->units = array(
                'angle' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Angle', 'name' => __("Angle", "d4plib")), 
                'area' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Area', 'name' => __("Area", "d4plib")), 
                'brightness' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Brightness', 'name' => __("Brightness", "d4plib")), 
                'currency_google' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Currency_Google', 'name' => __("Currency (Google)", "d4plib"), 'currency' => __("Google", "d4plib")), 
                'currency_ecb' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Currency_ECB', 'name' => __("Currency (European Central Bank)", "d4plib"), 'currency' => __("European Central Bank", "d4plib")), 
                'currency_oer' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Currency_OER', 'name' => __("Currency (Open Exchange Rates)", "d4plib"), 'currency' => __("Open Exchange Rates", "d4plib")), 
                'electric_current' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_ElectricCurrent', 'name' => __("Electric Current", "d4plib")), 
                'electrical_charge' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_ElectricalCharge', 'name' => __("Electrical Charge", "d4plib")), 
                'energy' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Energy', 'name' => __("Energy", "d4plib")),
                'frequency' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Frequency', 'name' => __("Frequency", "d4plib")),
                'fuel_consumption' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_FuelConsumption', 'name' => __("Fuel Consumption", "d4plib")), 
                'illumination' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Illumination', 'name' => __("Illumination", "d4plib")), 
                'length' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Lenght', 'name' => __("Lenght or Distance", "d4plib")), 
                'memory' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Memory', 'name' => __("Memory", "d4plib")), 
                'power' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Power', 'name' => __("Power", "d4plib")), 
                'sound' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Sound', 'name' => __("Sound", "d4plib")), 
                'speed' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Speed', 'name' => __("Speed", "d4plib")),
                'temperature' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Temperature', 'name' => __("Temperature", "d4plib")),
                'time' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Time', 'name' => __("Time", "d4plib")), 
                'torque' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Torque', 'name' => __("Torque", "d4plib")), 
                'volume' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_Volume', 'name' => __("Volume", "d4plib")),
                'weight' => array('source' => '__internal__', 'class' => 'd4pLib_Unit_WeightMass', 'name' => __("Weight / Mass", "d4plib"))
            );
        }

        public static function instance() {
            static $instance = null;

            if (null === $instance) {
                $instance = new d4pLib_Units();
                $instance->init();
            }

            return $instance;
        }

        public function register($name, $title, $source, $class) {
            if (isset($this->units[$name])) {
                unset($this->data[$name]);
            }

            $this->units[$name] = array('source' => $source, 'class' => $class, 'name' => $title);
        }

        public function get_unit_types() {
            $data = array();

            foreach ($this->units as $unit => $obj) {
                $data[$unit] = $obj['name'];
            }

            return $data;
        }

        public function get_currency_types() {
            $data = array();

            foreach ($this->units as $unit => $obj) {
                if (substr($unit, 0, 8) == 'currency') {
                    $data[$unit] = $obj['currency'];
                }
            }

            return $data;
        }

        public function get_unit_type_values($name) {
            $this->load_unit_type($name);

            return $this->data[$name]->list;
        }

        public function get_unit_type_display($name, $unit) {
            $this->load_unit_type($name);

            if (isset($this->data[$name]) && isset($this->data[$name]->display[$unit])) {
                return $this->data[$name]->display[$unit];
            } else {
                return $unit;
            }
        }

        public function convert($name, $value, $from, $to) {
            $this->load_unit_type($name);

            if (!isset($this->data[$name])) {
                return null;
            }

            return $this->data[$name]->convert($value, $from, $to);
        }

        public function convert_from_base($name, $value, $to) {
            $this->load_unit_type($name);

            if (!isset($this->data[$name])) {
                return null;
            }

            return $this->convert($name, $value, $this->data[$name]->base, $to);
        }

        public function convert_to_base($name, $value, $from) {
            $this->load_unit_type($name);

            if (!isset($this->data[$name])) {
                return null;
            }

            return $this->convert($name, $value, $from, $this->data[$name]->base);
        }

        public function load_all_unit_types() {
            foreach (array_keys($this->units) as $name) {
                $this->load_unit_type($name);
            }
        }

        public function load($name, $args = array()) {
            $this->load_unit_type($name, $args);
        }

        public function is_loaded($name) {
            return isset($this->data[$name]);
        }

        private function load_unit_type($name, $args = array()) {
            if (!isset($this->data[$name])) {
                $unit = $this->units[$name];
                $path = $unit['source'] == '__internal__' ? dirname(__FILE__).'/units/d4p.'.$name.'.php' : $unit['source'];

                if (file_exists($path)) {
                    include($path);

                    $obj = $unit['class'];
                    $this->data[$name] = new $obj($args);
                }
            }
        }
    }

    function d4p_units($args = array()) {
        return d4pLib_Units::instance($args);
    }
}

?>