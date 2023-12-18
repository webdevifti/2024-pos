<?php

use App\Models\Setting;

function get_option($option_key){
    $getOption = Setting::select('option_value')->where('option_key', $option_key)->where('option_status',1)->firstOrFail();
    return $getOption->option_value;
}

function update_option($key,$value){
    $option = Setting::where('option_key',$key)->firstOrFail();
    $option->option_value = $value;
    $option->save();
}
function create_option($key){
    $exists = Setting::where('option_key',$key)->exists();
    if(!$exists){
        Setting::create(['option_key' => $key]);
    }
}