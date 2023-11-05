<?php

use App\Models\EditionList;
use App\Models\GeneralSetting;

function get_settings(){
    $data=GeneralSetting::first();
     $data = $data;
     return $data;
}
?>
