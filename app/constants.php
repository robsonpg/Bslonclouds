<?php

//#########################################################################
// Essas constantes dependem do cadastro de permissões no banco de dados

const CONFIG_BACKSCATTERING = 1;
const CONFIG_FOWARDSCATTERING = 2;

const HENE_LASER_TYPE = "1";
const DIODE_LASER_TYPE = "2";
const OTHER_LASER_TYPE = "3";

const PERMISSION_PUBLIC = 1;
const PERMISSION_PRIVATE = 2;

const ATTR_USER = 1;
const ATTR_ADMIN = 2;
const ATTR_RESEARCHER = 3;
const ATTR_MODERATOR = 4;

const RESEARCH_STATUS_WAINTING_REVISION = 0; // Aguardando revisão
const RESEARCH_STATUS_ACCEPTED = 1; // Pesquisa aceita para publicação
const RESEARCH_STATUS_REJECTED = 2; // Pesquisa rejeitada

const CI_COUNTRIES_ARRAY = array (
    'AW' => 'Aruba',
    'AF' => 'Afghanistan',
    'AO' => 'Angola',
    'AL' => 'Albania',
    'AD' => 'Andorra',
    'AE' => 'United Arab Emirates',
    'AR' => 'Argentina',
    'AM' => 'Armenia',
    'AS' => 'American Samoa',
    'AG' => 'Antigua and Barbuda',
    'AU' => 'Australia',
    'AT' => 'Austria',
    'AZ' => 'Azerbaijan',
    'BI' => 'Burundi',
    'BE' => 'Belgium',
    'BJ' => 'Benin',
    'BF' => 'Burkina Faso',
    'BD' => 'Bangladesh',
    'BG' => 'Bulgaria',
    'BH' => 'Bahrain',
    'BS' => 'Bahamas, The',
    'BA' => 'Bosnia and Herzegovina',
    'BY' => 'Belarus',
    'BZ' => 'Belize',
    'BM' => 'Bermuda',
    'BO' => 'Bolivia',
    'BR' => 'Brazil',
    'BB' => 'Barbados',
    'BN' => 'Brunei Darussalam',
    'BT' => 'Bhutan',
    'BW' => 'Botswana',
    'CF' => 'Central African Republic',
    'CA' => 'Canada',
    'CH' => 'Switzerland',
    'JG' => 'Channel Islands',
    'CL' => 'Chile',
    'CN' => 'China',
    'CI' => 'Cote d\'Ivoire',
    'CM' => 'Cameroon',
    'CD' => 'Congo, Dem. Rep.',
    'CG' => 'Congo, Rep.',
    'CO' => 'Colombia',
    'KM' => 'Comoros',
    'CV' => 'Cabo Verde',
    'CR' => 'Costa Rica',
    'CU' => 'Cuba',
    'CW' => 'Curacao',
    'KY' => 'Cayman Islands',
    'CY' => 'Cyprus',
    'CZ' => 'Czech Republic',
    'DE' => 'Germany',
    'DJ' => 'Djibouti',
    'DM' => 'Dominica',
    'DK' => 'Denmark',
    'DO' => 'Dominican Republic',
    'DZ' => 'Algeria',
    'EC' => 'Ecuador',
    'EG' => 'Egypt, Arab Rep.',
    'ER' => 'Eritrea',
    'ES' => 'Spain',
    'EE' => 'Estonia',
    'ET' => 'Ethiopia',
    'FI' => 'Finland',
    'FJ' => 'Fiji',
    'FR' => 'France',
    'FO' => 'Faroe Islands',
    'FM' => 'Micronesia, Fed. Sts.',
    'GA' => 'Gabon',
    'GB' => 'United Kingdom',
    'GE' => 'Georgia',
    'GH' => 'Ghana',
    'GI' => 'Gibraltar',
    'GN' => 'Guinea',
    'GM' => 'Gambia, The',
    'GW' => 'Guinea-Bissau',
    'GQ' => 'Equatorial Guinea',
    'GR' => 'Greece',
    'GD' => 'Grenada',
    'GL' => 'Greenland',
    'GT' => 'Guatemala',
    'GU' => 'Guam',
    'GY' => 'Guyana',
    'HK' => 'Hong Kong SAR, China',
    'HN' => 'Honduras',
    'HR' => 'Croatia',
    'HT' => 'Haiti',
    'HU' => 'Hungary',
    'ID' => 'Indonesia',
    'IM' => 'Isle of Man',
    'IN' => 'India',
    'IE' => 'Ireland',
    'IR' => 'Iran, Islamic Rep.',
    'IQ' => 'Iraq',
    'IS' => 'Iceland',
    'IL' => 'Israel',
    'IT' => 'Italy',
    'JM' => 'Jamaica',
    'JO' => 'Jordan',
    'JP' => 'Japan',
    'KZ' => 'Kazakhstan',
    'KE' => 'Kenya',
    'KG' => 'Kyrgyz Republic',
    'KH' => 'Cambodia',
    'KI' => 'Kiribati',
    'KN' => 'St. Kitts and Nevis',
    'KR' => 'Korea, Rep.',
    'KW' => 'Kuwait',
    'LA' => 'Lao PDR',
    'LB' => 'Lebanon',
    'LR' => 'Liberia',
    'LY' => 'Libya',
    'LC' => 'St. Lucia',
    'LI' => 'Liechtenstein',
    'LK' => 'Sri Lanka',
    'LS' => 'Lesotho',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'LV' => 'Latvia',
    'MO' => 'Macao SAR, China',
    'MF' => 'St. Martin (French part)',
    'MA' => 'Morocco',
    'MC' => 'Monaco',
    'MD' => 'Moldova',
    'MG' => 'Madagascar',
    'MV' => 'Maldives',
    'MX' => 'Mexico',
    'MH' => 'Marshall Islands',
    'MK' => 'Macedonia, FYR',
    'ML' => 'Mali',
    'MT' => 'Malta',
    'MM' => 'Myanmar',
    'ME' => 'Montenegro',
    'MN' => 'Mongolia',
    'MP' => 'Northern Mariana Islands',
    'MZ' => 'Mozambique',
    'MR' => 'Mauritania',
    'MU' => 'Mauritius',
    'MW' => 'Malawi',
    'MY' => 'Malaysia',
    'NA' => 'Namibia',
    'NC' => 'New Caledonia',
    'NE' => 'Niger',
    'NG' => 'Nigeria',
    'NI' => 'Nicaragua',
    'NL' => 'Netherlands',
    'NO' => 'Norway',
    'NP' => 'Nepal',
    'NR' => 'Nauru',
    'NZ' => 'New Zealand',
    'OM' => 'Oman',
    'PK' => 'Pakistan',
    'PA' => 'Panama',
    'PE' => 'Peru',
    'PH' => 'Philippines',
    'PW' => 'Palau',
    'PG' => 'Papua New Guinea',
    'PL' => 'Poland',
    'PR' => 'Puerto Rico',
    'KP' => 'Korea, Dem. People’s Rep.',
    'PT' => 'Portugal',
    'PY' => 'Paraguay',
    'PS' => 'West Bank and Gaza',
    'PF' => 'French Polynesia',
    'QA' => 'Qatar',
    'RO' => 'Romania',
    'RU' => 'Russian Federation',
    'RW' => 'Rwanda',
    'SA' => 'Saudi Arabia',
    'SD' => 'Sudan',
    'SN' => 'Senegal',
    'SG' => 'Singapore',
    'SB' => 'Solomon Islands',
    'SL' => 'Sierra Leone',
    'SV' => 'El Salvador',
    'SM' => 'San Marino',
    'SO' => 'Somalia',
    'RS' => 'Serbia',
    'SS' => 'South Sudan',
    'ST' => 'Sao Tome and Principe',
    'SR' => 'Suriname',
    'SK' => 'Slovak Republic',
    'SI' => 'Slovenia',
    'SE' => 'Sweden',
    'SZ' => 'Swaziland',
    'SX' => 'Sint Maarten (Dutch part)',
    'SC' => 'Seychelles',
    'SY' => 'Syrian Arab Republic',
    'TC' => 'Turks and Caicos Islands',
    'TD' => 'Chad',
    'TG' => 'Togo',
    'TH' => 'Thailand',
    'TJ' => 'Tajikistan',
    'TM' => 'Turkmenistan',
    'TL' => 'Timor-Leste',
    'TO' => 'Tonga',
    'TT' => 'Trinidad and Tobago',
    'TN' => 'Tunisia',
    'TR' => 'Turkey',
    'TV' => 'Tuvalu',
    'TW' => 'Taiwan, China',
    'TZ' => 'Tanzania',
    'UG' => 'Uganda',
    'UA' => 'Ukraine',
    'UY' => 'Uruguay',
    'US' => 'United States',
    'UZ' => 'Uzbekistan',
    'VC' => 'St. Vincent and the Grenadines',
    'VE' => 'Venezuela, RB',
    'VG' => 'British Virgin Islands',
    'VI' => 'Virgin Islands (U.S.)',
    'VN' => 'Vietnam',
    'VU' => 'Vanuatu',
    'WS' => 'Samoa',
    'XK' => 'Kosovo',
    'YE' => 'Yemen, Rep.',
    'ZA' => 'South Africa',
    'ZM' => 'Zambia',
    'ZW' => 'Zimbabwe',
);

function code_to_country( $code ){

    $code = strtoupper($code);

    $countryList = array(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas the',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island (Bouvetoya)',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
        'VG' => 'British Virgin Islands',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros the',
        'CD' => 'Congo',
        'CG' => 'Congo the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote d\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FO' => 'Faroe Islands',
        'FK' => 'Falkland Islands (Malvinas)',
        'FJ' => 'Fiji the Fiji Islands',
        'FI' => 'Finland',
        'FR' => 'France, French Republic',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia the',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyz Republic',
        'LA' => 'Lao',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'AN' => 'Netherlands Antilles',
        'NL' => 'Netherlands the',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn Islands',
        'PL' => 'Poland',
        'PT' => 'Portugal, Portuguese Republic',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia (Slovak Republic)',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia, Somali Republic',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard & Jan Mayen Islands',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland, Swiss Confederation',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States of America',
        'UM' => 'United States Minor Outlying Islands',
        'VI' => 'United States Virgin Islands',
        'UY' => 'Uruguay, Eastern Republic of',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    );

    if( !$countryList[$code] ) return $code;
    else return $countryList[$code];
}