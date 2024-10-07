<?php

namespace App\Models;

use App\Types\TypeStatus;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Magasin extends Model
{
    use HasFactory;

    public function __construct(array $attributes=[])
    {
        parent::__construct($attributes);
        $this->etat=TypeStatus::ACTIF;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [


        'libelle',
        'responsable',
        'description',
        'type_magasin',


        'etat',

    ];



    /**
     * Ajouter une Magasin
     *

     * @param  string $libelle
     * @param  string $responsable
     * @param  string  $description
     * @param  int  $type_magasin




     * @return Magasin
     */

    public static function addMagasin(
        $libelle,
        $responsable,
        $description,
        $type_magasin



    )
    {
        $magasin = new Magasin();


        $magasin->libelle = $libelle;
        $magasin->responsable = $responsable;
        $magasin->description = $description;
        $magasin->type_magasin = $type_magasin;


        $magasin->created_at = Carbon::now();

        $magasin->save();

        return $magasin;
    }

    /**
     * Affichage d'une année scolaire
     * @param int $id
     * @return  Magasin
     */

    public static function rechercheMagasinById($id)
    {

        return   $magasin= Magasin::findOrFail($id);
    }

    /**
     * Update d'une Magasin scolaire

   * @param  string $libelle
     * @param  string $responsable
     * @param  string $description
     * @param  int $type_magasin



     * @param int $id
     * @return  Magasin
     */

    public static function updateMagasin(
          $libelle,
        $responsable,
        $description,
        $type_magasin,


        $id)
    {


        return   $magasin= Magasin::findOrFail($id)->update([



            'libelle' => $libelle,
            'responsable' => $responsable,
            'description' => $description,
            'type_magasin' => $type_magasin,



            'id' => $id,


        ]);
    }




    /**
     * Supprimer une Magasin
     *
     * @param int $id
     * @return  boolean
     */

    public static function deleteMagasin($id)
    {

        $magasin= Magasin::findOrFail($id)->update([
            'etat' => TypeStatus::SUPPRIME

        ]);

        if ($magasin) {
            return 1;
        }
        return 0;
    }



    /**


     * Retourne la liste des Magasins



     * @param  int $type_magasin

     *
     * @return  array
     */

    public static function getListe(


        $type_magasin = null


    ) {



        $query =  Magasin::where('etat', '!=', TypeStatus::SUPPRIME)
        ;

        if ($type_magasin != null) {

            $query->where('type_magasin', '=', $type_magasin);
        }




        return    $query->get();
    }



    /**
     * Retourne le nombre  des  activités



    * @param  int $type_magasin


     * @return  int $total
     */

    public static function getTotal(

        $type_magasin = null

    ) {

        $query =   DB::table('magasins')


            ->where('magasins.etat', '!=', TypeStatus::SUPPRIME);



            if ($type_magasin != null) {

                $query->where('type_magasin', '=', $type_magasin);
            }


        $total = $query->count();

        if ($total) {

            return   $total;
        }

        return 0;
    }






}
