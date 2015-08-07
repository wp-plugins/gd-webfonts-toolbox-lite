<?php

/*
Name:    d4pLib_Units: Time
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Time')) {
    class d4pLib_Unit_Time extends d4pLib_UnitType {
        public $base = 'ns';

        public function init() {
            $this->name = __("Time", "d4plib");

            $this->list = array(
                'ns' => __("Nanosecond", "d4plib"),
                'us' => __("Microsecond", "d4plib"),
                'ms' => __("Millisecond", "d4plib"),
                's' => __("Second", "d4plib"),
                'min' => __("Minute", "d4plib"),
                'hour' => __("Hour", "d4plib"),
                'day' => __("Day", "d4plib"),
                'week' => __("Week", "d4plib"),
                'month' => __("Month", "d4plib"),
                'year' => __("Year", "d4plib"),
                'century' => __("Century", "d4plib"),
                'millennium' => __("Millennium", "d4plib")
            );

            $this->convert = array(
                'ns' => 1,
                'us' => 1000,
                'ms' => 1000000,
                's' => 1000000000,
                'min' => 60000000000,
                'hour' => 3600000000000,
                'day' => 86400000000000,
                'week' => 604800000000000,
                'month' => 2592000000000000,
                'year' => 31556926000000000,
                'century' => 3155692600000000000,
                'millennium' => 31556926000000000000
            );
        }
    }
}

?>