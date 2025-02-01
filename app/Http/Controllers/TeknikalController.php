<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeknikalController extends Controller
{
    //

    public function vokal()
    {
        // return view('Payment.index');
        // $kata = "Enigma Camp";
        $kata = "PT ENIGMA CIPTA HUMANIKA";
        // $kata = "PHP";
        $huruf = str_split($kata);
        // dd(count($huruf));
        // $huruf2 = array();
        // $counthuruf2 = count($huruf) - 1;
        // $counthuruf2 = 0;
        for ($i = count($huruf); $i > 0; $i--) {
            $huruf2[] = $huruf[$i - 1];
            // $counthuruf2 = $counthuruf2 + 1;
        }
        // foreach ($huruf as $data) {
        //     $huruf2[] = $huruf[$counthuruf2];
        //     $counthuruf2--;
        // }
        // dd($counthuruf2);
        dd($huruf2);
        // $jumlah_vokal = 0;
        // foreach ($huruf as $data) {
        //     if ($data == "a" || $data == "i" || $data == "u" || $data == "e" || $data == "o" || $data == "A" || $data == "I" || $data == "U" || $data == "E" || $data == "O") {
        //         $jumlah_vokal = $jumlah_vokal + 1;
        //     }
        // }
        // dd($jumlah_vokal);
    }

    //

}
