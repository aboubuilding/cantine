<?php

namespace App\Models;

use App\Types\TypeStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Mouvement extends Model
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


        'date_mouvement',
        'reference',
        'produit_id',
        'magasin_id',
        'annee_id',
        'quantite',
        'type_mouvement',



        'etat',

    ];



    /**
     * Ajouter un Mouvement
     *

     * @param  date $date_mouvement

     * @param  string $reference
     * @param  int $produit_id
     * @param  int $magasin_id
     * @param  int $annee_id
     * @param  int $quantite
     * @param  int $type_mouvement



     * @return Mouvement
     */

    public static function addMouvement(
        $date_mouvement,
        $reference,
        $produit_id,
        $magasin_id,
        $annee_id,
        $quantite,
        $type_mouvement



    )
    {
        $mouvement = new Mouvement();


        $mouvement->date_mouvement = $date_mouvement;
        $mouvement->reference = $reference;
        $mouvement->produit_id = $produit_id;
        $mouvement->magasin_id = $magasin_id;
        $mouvement->annee_id = $annee_id;
        $mouvement->quantite = $quantite;
        $mouvement->type_mouvement = $type_mouvement;

        $mouvement->created_at = Carbon::now();

        $mouvement->save();

        return $mouvement;
    }

    /**
     * Affichage d'un Mouvement
     * @param int $id
     * @return  Mouvement
     */

    public static function rechercheMouvementById($id)
    {

        return   $mouvement = Mouvement::findOrFail($id);
    }

    /**
     * Update d'une Mouvement scolaire

    * @param  date $date_mouvement

     * @param  string $reference
     * @param  int $produit_id
     * @param  int $magasin_id
     * @param  int $annee_id
     * @param  int $quantite
     * @param  int $type_mouvement



     * @param int $id
     * @return  Mouvement
     */

    public static function updateMouvement(
        $date_mouvement,
        $reference,
        $produit_id,
        $magasin_id,
        $annee_id,
        $quantite,
        $type_mouvement,

        $id)
    {


        return   $mouvement = Mouvement::findOrFail($id)->update([



            'date_mouvement' => $date_mouvement,
            'reference' => $reference,
            'produit_id' => $produit_id,
            'magasin_id' => $magasin_id,
            'annee_id' => $annee_id,
            'quantite' => $quantite,
            'type_mouvement' => $type_mouvement,



            'id' => $id,


        ]);
    }




    /**
     * Supprimer une Mouvement
     *
     * @param int $id
     * @return  boolean
     */

    public static function deleteMouvement($id)
    {

        $mouvement = Mouvement::findOrFail($id)->update([
            'etat' => TypeStatus::SUPPRIME

        ]);

        if ($mouvement) {
            return 1;
        }
        return 0;
    }



    /**
     * Retourne la liste des Mouvements


     * @param  int $annee_id
     * @param  int $magasin_id
     * @param  int $produit_id
     * @param  int $type_mouvement



     *
     * @return  array
     */

    public static function getListe(

        $annee_id = null,

        $magasin_id = null,
        $produit_id = null,
        $type_mouvement = null




    ) {



        $query =  Mouvement::where('etat', '!=', TypeStatus::SUPPRIME)
        ;

        if ($annee_id != null) {

            $query->where('annee_id', '=', $annee_id);
        }

        if ($produit_id != null) {

            $query->where('produit_id', '=', $produit_id);
        }

        if ($magasin_id != null) {

            $query->where('magasin_id', '=', $magasin_id);
        }

        if ($type_mouvement != null) {

            $query->where('type_mouvement', '=', $type_mouvement);
        }



        return    $query->get();
    }



    /**
     * Retourne le nombre  des  Mouvements



     * @param  int $annee_id
     * @param  int $magasin_id
     * @param  int $produit_id
     * @param  int $type_mouvement




     * @return  int $total
     */

    public static function getTotal(
        $annee_id = null,

        $magasin_id = null,
        $produit_id = null,
        $type_mouvement = null






    ) {

        $query =   DB::table('Mouvements')


            ->where('Mouvements.etat', '!=', TypeStatus::SUPPRIME);


            if ($annee_id != null) {

                $query->where('annee_id', '=', $annee_id);
            }

            if ($produit_id != null) {

                $query->where('produit_id', '=', $produit_id);
            }

            if ($magasin_id != null) {

                $query->where('magasin_id', '=', $magasin_id);
            }

            if ($type_mouvement != null) {

                $query->where('type_mouvement', '=', $type_mouvement);
            }






        $total = $query->count();

        if ($total) {

            return   $total;
        }

        return 0;
    }



    /**
     * Obtenir une année
     *
     */
    public function annee()
    {


        return $this->belongsTo(Annee::class, 'annee_id');
    }


    /**
     * Obtenir un produit
     *
     */
    public function produit()
    {


        return $this->belongsTo(Produit::class, 'produit_id');
    }


     /**
     * Obtenir un magasin
     *
     */
    public function magasin()
    {


        return $this->belongsTo(Magasin::class, 'magasin_id');
    }




     /**
     * Generer le  code de paiement

     * @return  string
     */

     public static function genererNumero()
     {

         $numero = "MAR-MVT-000";

         $last =  Mouvement::orderBy('id', 'DESC')
             ->latest()->first();;

         if ($last) {
             $numero = $numero . $last->id;
         }


         return $numero;
     }


}
