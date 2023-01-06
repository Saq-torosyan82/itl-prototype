<?php

if (!function_exists('getCounties'))
{
    function getCounties()
    {
        $counties = ['Antrim', 'Armagh', 'Carlow', 'Cavan', 'Clare', 'Cork',
            'Donegal', 'Down', 'Dublin', 'Fermanagh', 'Galway', 'Kerry',
            'Kildare', 'Kilkenny', 'Laois', 'Leitrim', 'Limerick',
            'Longford', 'Louth', 'Mayo', 'Meath', 'Monaghan', 'Offaly', 'Roscommon',
            'Sligo', 'Tipperary', 'Tyrone', 'Waterford', 'Westmeath', 'Wexford', 'Wicklow'];
        sort($counties);
        return $counties;
    }
}

if (!function_exists('getProvinces'))
{
    function getProvinces()
    {
        $provs = ['Ulster', 'Leinster', 'Connaught', 'Munster'];
        sort($provs);
        return $provs;
    }
}

if (!function_exists('getCountries'))
{
    function getCountries()
    {
        $countries = ['Northern Ireland', 'Republic of Ireland'];
        return $countries;
    }
}

if (!function_exists('getCountryCodes'))
{
    function getCountryCodes()
    {
        $codes = ['+93', '+355 ', '+55', '+380', '+1'];
        return $codes;
    }
}
if (!function_exists('hasRemembeCookie'))
{
    function hasRemembeCookie() {
        $cookies = $_COOKIE;
        foreach ($cookies as $key => $cookie) {
            if (stripos($key, 'remember') !== false) {
                return true;
            }
        }
        return false;
    }
}

