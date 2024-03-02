<?php

class Helper{
    public static function currency_load()
    {
        if(session()->has('system_default_currency_info') == false){
            session()->put('system_default_currency_info' , \App\Models\Currency::where('status' , 'active')->first());
        }
    }
    public static function currency_converter($amount)
    {
        return format_price(convert_price($amount));
    }

    public static function return_convert_price($price)
    {
        Helper::currency_load();
        $system_default_currency_info = session('system_default_currency_info');

        if(\Illuminate\Support\Facades\Session::has('currency_exchange_rate'))
        {
            $exchange = session('currency_exchange_rate');
        }else{
            $exchange= $system_default_currency_info->exchange_rate;
        }

        $price = floatval($price) * floatval($exchange);

        return $price;
    }
}

if(!function_exists('convert_price'))
{
    function convert_price($price)
    {
        Helper::currency_load();
        $system_default_currency_info = session('system_default_currency_info');
//        $price = floatval($price)/floatval($system_default_currency_info->exchange_rate);

        if(\Illuminate\Support\Facades\Session::has('currency_exchange_rate'))
        {
            $exchange = session('currency_exchange_rate');
        }else{
            $exchange= $system_default_currency_info->exchange_rate;
        }

        $price = floatval($price) * floatval($exchange);

        return $price;
    }

}

if(!function_exists('currency_symbol'))
{
    function currency_symbol()
    {
        Helper::currency_load();
        if(session()->has('currency_symbol'))
        {
            $symbol =session('currency_symbol');
        }else{
            $system_default_currency_info = session('system_default_currency_info');

            $symbol=$system_default_currency_info->symbol;
        }
        return $symbol;
    }
}

if(!function_exists('format_price')){
function  format_price($price)
{
    return currency_symbol().number_format($price , 2);
}
}
if(!function_exists('get_settings'))
{
    function get_settings($key)
    {
        return \App\Models\Settings::value($key);
    }
}
