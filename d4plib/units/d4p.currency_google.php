<?php

/*
Name:    d4pLib_Units: Currency (Google)
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/
*/

if (!class_exists('d4pLib_Unit_Currency_Google')) {
    class d4pLib_Unit_Currency_Google extends d4pLib_UnitType {
        public $base = 'USD';
        public $timeout = 86400;

        public function init() {
            $this->name = __("Currency (Google)", "d4plib");

            $this->display = array(
                'USD' => '$',
                'CAD' => '$',
                'HKD' => '$',
                'AUD' => '$',
                'NZD' => '$',
                'CHF' => 'Fr',
                'SEK' => 'Kr',
                'EUR' => '&euro;',
                'GBP' => '&pound;',
                'KRW' => '&#8361;',
                'JPY' => '&yen;',
                'CNY' => '&yen;',
                'INR' => '&#8377;',
                'NGN' => '&#8358;',
                'ILS' => '&#8362;',
                'KRW' => '&#8361;',
                'THB' => '&#3647;',
                'VND' => '&#8363;'
            );

            $this->list = array(
                'AED' => 'United Arab Emirates Dirham (AED)',
                'AFN' => 'Afghan Afghani (AFN)',
                'ALL' => 'Albanian Lek (ALL)',
                'AMD' => 'Armenian Dram (AMD)',
                'ANG' => 'Netherlands Antillean Guilder (ANG)',
                'AOA' => 'Angolan Kwanza (AOA)',
                'ARS' => 'Argentine Peso (ARS)',
                'AUD' => 'Australian Dollar (A$)',
                'AWG' => 'Aruban Florin (AWG)',
                'AZN' => 'Azerbaijani Manat (AZN)',
                'BAM' => 'Bosnia-Herzegovina Convertible Mark (BAM)',
                'BBD' => 'Barbadian Dollar (BBD)',
                'BDT' => 'Bangladeshi Taka (BDT)',
                'BGN' => 'Bulgarian Lev (BGN)',
                'BHD' => 'Bahraini Dinar (BHD)',
                'BIF' => 'Burundian Franc (BIF)',
                'BMD' => 'Bermudan Dollar (BMD)',
                'BND' => 'Brunei Dollar (BND)',
                'BOB' => 'Bolivian Boliviano (BOB)',
                'BRL' => 'Brazilian Real (R$)',
                'BSD' => 'Bahamian Dollar (BSD)',
                'BTN' => 'Bhutanese Ngultrum (BTN)',
                'BWP' => 'Botswanan Pula (BWP)',
                'BYR' => 'Belarusian Ruble (BYR)',
                'BZD' => 'Belize Dollar (BZD)',
                'CAD' => 'Canadian Dollar (CA$)',
                'CDF' => 'Congolese Franc (CDF)',
                'CHF' => 'Swiss Franc (CHF)',
                'CLF' => 'Chilean Unit of Account (UF) (CLF)',
                'CLP' => 'Chilean Peso (CLP)',
                'CNH' => 'CNH (CNH)',
                'CNY' => 'Chinese Yuan (CN¥)',
                'COP' => 'Colombian Peso (COP)',
                'CRC' => 'Costa Rican Colón (CRC)',
                'CUP' => 'Cuban Peso (CUP)',
                'CVE' => 'Cape Verdean Escudo (CVE)',
                'CZK' => 'Czech Republic Koruna (CZK)',
                'DEM' => 'German Mark (DEM)',
                'DJF' => 'Djiboutian Franc (DJF)',
                'DKK' => 'Danish Krone (DKK)',
                'DOP' => 'Dominican Peso (DOP)',
                'DZD' => 'Algerian Dinar (DZD)',
                'EGP' => 'Egyptian Pound (EGP)',
                'ERN' => 'Eritrean Nakfa (ERN)',
                'ETB' => 'Ethiopian Birr (ETB)',
                'EUR' => 'Euro (€)',
                'FIM' => 'Finnish Markka (FIM)',
                'FJD' => 'Fijian Dollar (FJD)',
                'FKP' => 'Falkland Islands Pound (FKP)',
                'FRF' => 'French Franc (FRF)',
                'GBP' => 'British Pound Sterling (£)',
                'GEL' => 'Georgian Lari (GEL)',
                'GHS' => 'Ghanaian Cedi (GHS)',
                'GIP' => 'Gibraltar Pound (GIP)',
                'GMD' => 'Gambian Dalasi (GMD)',
                'GNF' => 'Guinean Franc (GNF)',
                'GTQ' => 'Guatemalan Quetzal (GTQ)',
                'GYD' => 'Guyanaese Dollar (GYD)',
                'HKD' => 'Hong Kong Dollar (HK$)',
                'HNL' => 'Honduran Lempira (HNL)',
                'HRK' => 'Croatian Kuna (HRK)',
                'HTG' => 'Haitian Gourde (HTG)',
                'HUF' => 'Hungarian Forint (HUF)',
                'IDR' => 'Indonesian Rupiah (IDR)',
                'IEP' => 'Irish Pound (IEP)',
                'ILS' => 'Israeli New Sheqel (₪)',
                'INR' => 'Indian Rupee (Rs.)',
                'IQD' => 'Iraqi Dinar (IQD)',
                'IRR' => 'Iranian Rial (IRR)',
                'ISK' => 'Icelandic Króna (ISK)',
                'ITL' => 'Italian Lira (ITL)',
                'JMD' => 'Jamaican Dollar (JMD)',
                'JOD' => 'Jordanian Dinar (JOD)',
                'JPY' => 'Japanese Yen (¥)',
                'KES' => 'Kenyan Shilling (KES)',
                'KGS' => 'Kyrgystani Som (KGS)',
                'KHR' => 'Cambodian Riel (KHR)',
                'KMF' => 'Comorian Franc (KMF)',
                'KPW' => 'North Korean Won (KPW)',
                'KRW' => 'South Korean Won (₩)',
                'KWD' => 'Kuwaiti Dinar (KWD)',
                'KYD' => 'Cayman Islands Dollar (KYD)',
                'KZT' => 'Kazakhstani Tenge (KZT)',
                'LAK' => 'Laotian Kip (LAK)',
                'LBP' => 'Lebanese Pound (LBP)',
                'LKR' => 'Sri Lankan Rupee (LKR)',
                'LRD' => 'Liberian Dollar (LRD)',
                'LSL' => 'Lesotho Loti (LSL)',
                'LTL' => 'Lithuanian Litas (LTL)',
                'LVL' => 'Latvian Lats (LVL)',
                'LYD' => 'Libyan Dinar (LYD)',
                'MAD' => 'Moroccan Dirham (MAD)',
                'MDL' => 'Moldovan Leu (MDL)',
                'MGA' => 'Malagasy Ariary (MGA)',
                'MKD' => 'Macedonian Denar (MKD)',
                'MMK' => 'Myanmar Kyat (MMK)',
                'MNT' => 'Mongolian Tugrik (MNT)',
                'MOP' => 'Macanese Pataca (MOP)',
                'MRO' => 'Mauritanian Ouguiya (MRO)',
                'MUR' => 'Mauritian Rupee (MUR)',
                'MVR' => 'Maldivian Rufiyaa (MVR)',
                'MWK' => 'Malawian Kwacha (MWK)',
                'MXN' => 'Mexican Peso (MX$)',
                'MYR' => 'Malaysian Ringgit (MYR)',
                'MZN' => 'Mozambican Metical (MZN)',
                'NAD' => 'Namibian Dollar (NAD)',
                'NGN' => 'Nigerian Naira (NGN)',
                'NIO' => 'Nicaraguan Córdoba (NIO)',
                'NOK' => 'Norwegian Krone (NOK)',
                'NPR' => 'Nepalese Rupee (NPR)',
                'NZD' => 'New Zealand Dollar (NZ$)',
                'OMR' => 'Omani Rial (OMR)',
                'PAB' => 'Panamanian Balboa (PAB)',
                'PEN' => 'Peruvian Nuevo Sol (PEN)',
                'PGK' => 'Papua New Guinean Kina (PGK)',
                'PHP' => 'Philippine Peso (Php)',
                'PKG' => 'PKG (PKG)',
                'PKR' => 'Pakistani Rupee (PKR)',
                'PLN' => 'Polish Zloty (PLN)',
                'PYG' => 'Paraguayan Guarani (PYG)',
                'QAR' => 'Qatari Rial (QAR)',
                'RON' => 'Romanian Leu (RON)',
                'RSD' => 'Serbian Dinar (RSD)',
                'RUB' => 'Russian Ruble (RUB)',
                'RWF' => 'Rwandan Franc (RWF)',
                'SAR' => 'Saudi Riyal (SAR)',
                'SBD' => 'Solomon Islands Dollar (SBD)',
                'SCR' => 'Seychellois Rupee (SCR)',
                'SDG' => 'Sudanese Pound (SDG)',
                'SEK' => 'Swedish Krona (SEK)',
                'SGD' => 'Singapore Dollar (SGD)',
                'SHP' => 'Saint Helena Pound (SHP)',
                'SLL' => 'Sierra Leonean Leone (SLL)',
                'SOS' => 'Somali Shilling (SOS)',
                'SRD' => 'Surinamese Dollar (SRD)',
                'STD' => 'São Tomé and Príncipe Dobra (STD)',
                'SVC' => 'Salvadoran Colón (SVC)',
                'SYP' => 'Syrian Pound (SYP)',
                'SZL' => 'Swazi Lilangeni (SZL)',
                'THB' => 'Thai Baht (฿)',
                'TJS' => 'Tajikistani Somoni (TJS)',
                'TMT' => 'Turkmenistani Manat (TMT)',
                'TND' => 'Tunisian Dinar (TND)',
                'TOP' => 'Tongan Paʻanga (TOP)',
                'TRY' => 'Turkish Lira (TRY)',
                'TTD' => 'Trinidad and Tobago Dollar (TTD)',
                'TWD' => 'New Taiwan Dollar (NT$)',
                'TZS' => 'Tanzanian Shilling (TZS)',
                'UAH' => 'Ukrainian Hryvnia (UAH)',
                'UGX' => 'Ugandan Shilling (UGX)',
                'USD' => 'US Dollar ($)',
                'UYU' => 'Uruguayan Peso (UYU)',
                'UZS' => 'Uzbekistan Som (UZS)',
                'VEF' => 'Venezuelan Bolívar (VEF)',
                'VND' => 'Vietnamese Dong (₫)',
                'VUV' => 'Vanuatu Vatu (VUV)',
                'WST' => 'Samoan Tala (WST)',
                'XAF' => 'CFA Franc BEAC (FCFA)',
                'XCD' => 'East Caribbean Dollar (EC$)',
                'XDR' => 'Special Drawing Rights (XDR)',
                'XOF' => 'CFA Franc BCEAO (CFA)',
                'XPF' => 'CFP Franc (CFPF)',
                'YER' => 'Yemeni Rial (YER)',
                'ZAR' => 'South African Rand (ZAR)',
                'ZMK' => 'Zambian Kwacha (1968–2012) (ZMK)',
                'ZMW' => 'Zambian Kwacha (ZMW)',
                'ZWL' => 'Zimbabwean Dollar (2009) (ZWL)'
            );
        }

        public function convert($value, $from, $to) {
            $value = trim($value);

            $from = strtoupper($from);
            $to = strtoupper($to);
            $crr = array($from, $to);
            sort($crr);
            $reverse = $crr[0] != $from;

            $key = 'currency_rate_'.$crr[0].'-'.$crr[1];

            $rate = get_site_transient($key);

            if ($rate === false || is_null($rate) || empty($rate)) {
                $rate = $this->_from_google($crr[0], $crr[1]);

                if (is_null($rate) || empty($rate)) {
                    return null;
                }

                set_site_transient($key, $rate, $this->timeout);
            }

            if ($rate === false || is_null($rate) || empty($rate)) {
                return null;
            }

            $rate = $reverse ? 1 / $rate : $rate;
            return $rate * $value;
        }

        private function _from_google($from, $to) {
            $url = 'https://www.google.com/finance/converter?a=1&from='.$from.'&to='.$to;
            $json = file_get_contents($url);

            if (empty($json)) {
                return null;
            } else {
                if (strpos($json, '<span class=bld>') !== false) {
                    $get = explode("<span class=bld>", $json);
                    $get = explode("</span>", $get[1]);

                    return preg_replace("/[^0-9\.]/", null, $get[0]);
                } else {
                    return 0;
                }
            }
        }
    }
}

?>