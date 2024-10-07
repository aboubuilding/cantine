<?php

namespace App\Models;

use App\Types\TypeStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Vente extends Model
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


        'date_vente',
        'reference',
        'quantite',
        'prix_unitaire',
        'annee_id',
        'produit_id',
     



        'etat',

    ];



    /**
     * Ajouter un Vente
     *

     * @param  date $date_vente

     * @param  string $reference
     * @param  int $quantite
     * @param  int $prix_unitaire
     * @param  int $annee_id
     * @param  int $produit_id



     * @return Vente
     */

    public static function addVente(
        $date_vente,
        $reference,
        $quantite,
        $prix_unitaire,
        $annee_id,
        $produit_id



    )
    {
        $vente = new Vente();


        $vente->date_vente = $date_vente;
        $vente->reference = $reference;
        $vente->quantite = $quantite;
        $vente->prix_unitaire = $prix_unitaire;
        $vente->annee_id = $annee_id;
        $vente->produit_id = $produit_id;

        $vente->created_at = Carbon::now();

        $vente->save();

        return $vente;
    }

    /**
     * Affichage d'un Vente
     * @param int $id
     * @return  Vente
     */

    public static function rechercheVenteById($id)
    {

        return   $vente = Vente::findOrFail($id);
    }

    /**
     * Update d'une Vente scolaire

    * @param  date $date_vente

     * @param  string $reference
     * @param  int $quantite
     * @param  int $prix_unitaire
     * @param  int $annee_id
     * @param  int $produit_id



     * @param int $id
     * @return  Vente
     */

    public static function updateVente(
        $date_vente,
        $reference,
        $quantite,
        $prix_unitaire,
        $annee_id,
        $produit_id,

        $id)
    {


        return   $vente = Vente::findOrFail($id)->update([



            'date_vente' => $date_vente,
            'reference' => $reference,
            'quantite' => $quantite,
            'prix_unitaire' => $prix_unitaire,
            'annee_id' => $annee_id,
            'produit_id' => $produit_id,



            'id' => $id,


        ]);
    }




    /**
     * Supprimer une Vente
     *
     * @param int $id
     * @return  boolean
     */

    public static function deleteVente($id)
    {

        $vente = Vente::findOrFail($id)->update([
            'etat' => TypeStatus::SUPPRIME

        ]);

        if ($vente) {
            return 1;
        }
        return 0;
    }



    /**
     * Retourne la liste des Ventes


     * @param  int $annee_id
     * @param  int $produit_id



     *
     * @return  array
     */

    public static function getListe(

        $annee_id = null,

        $produit_id = null,




    ) {



        $query =  Vente::where('etat', '!=', TypeStatus::SUPPRIME)
        ;

        if ($annee_id != null) {

            $query->where('annee_id', '=', $annee_id);
        }

        if ($produit_id != null) {

            $query->where('produit_id', '=', $produit_id);
        }








        return    $query->get();
    }



    /**
     * Retourne le nombre  des  Ventes


   * @param  int $annee_id
     * @param  int $produit_id




     * @return  int $total
     */

    public static function getTotal(
         $annee_id = null,

        $produit_id = null






    ) {

        $query =   DB::table('Ventes')


            ->where('Ventes.etat', '!=', TypeStatus::SUPPRIME);


       if ($annee_id != null) {

            $query->where('annee_id', '=', $annee_id);
        }

        if ($produit_id != null) {

            $query->where('produit_id', '=', $produit_id);
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
     * Generer le  code de paiement

     * @return  string
     */

     public static function genererNumero()
     {

         $numero = "MAR-VENT-000";

         $last =  Vente::orderBy('id', 'DESC')
             ->latest()->first();;

         if ($last) {
             $numero = $numero . $last->id;
         }


         return $numero;
     }


}
