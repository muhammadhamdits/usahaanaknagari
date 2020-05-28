<?php

namespace App\Http\Controllers;
use FarhanWazir\GoogleMaps\GMaps;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function map(){
        $config['center'] = '-0.9565177,100.4059463';
        $config['zoom'] = '14';
        $config['map_height'] = '400px';

        $gmap = new GMaps();
        $gmap->initialize($config);
     
        $map = $gmap->create_map();
        return view('guest.dashboard',compact('map'));
    }
}
