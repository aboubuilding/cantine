<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;


use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Types\StatutPaiement;
use App\Types\StatutValidation;
use App\Types\TypeInscription;

class TableauController extends Controller
{


    /**
     * Affiche la  liste des  categories
     *
     * @return \Illuminate\Http\Response
     */
    public function tableau ()
    {





        return view('admin.tableau')->with(
            [






            ]


        );


    }













}
