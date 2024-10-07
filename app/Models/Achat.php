<?php

namespace App\Models;

use App\Types\TypeStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Achat extends Model
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


        'date_achat',
        'reference',
        'quantite',
        'prix_unitaire',
        'produit_id',
        'fournisseur_id',
        'annee_id',
        'statut_livraison',



        'etat',

    ];



    /**
     * Ajouter un achat
     *

     * @param  date $date_achat

     * @param  string $reference
     * @param  int $quantite
     * @param  int $prix_unitaire
     * @param  int $produit_id
     * @param  int $fournisseur_id
     * @param  int $annee_id
     * @param  int $statut_livraison



     * @return Achat
     */

    public static function addAchat(
        $date_achat,
        $reference,
        $quantite,
        $prix_unitaire,
        $produit_id,
        $fournisseur_id,
        $annee_id,
        $statut_livraison


    )
    {
        $achat = new Achat();


        $achat->date_achat = $date_achat;
        $achat->reference = $reference;
        $achat->quantite = $quantite;
        $achat->prix_unitaire = $prix_unitaire;
        $achat->produit_id = $produit_id;
        $achat->fournisseur_id = $fournisseur_id;
        $achat->annee_id = $annee_id;
        $achat->statut_livraison = $statut_livraison;

        $achat->created_at = Carbon::now();

        $achat->save();

        return $achat;
    }

    /**
     * Affichage d'un achat
     * @param int $id
     * @return  Achat
     */

    public static function rechercheAchatById($id)
    {

        return   $achat = Achat::findOrFail($id);
    }

    /**
     * Update d'une Achat scolaire

    * @param  date $date_achat

     * @param  string $reference
     * @param  int $quantite
     * @param  int $prix_unitaire
     * @param  int $produit_id
     * @param  int $fournisseur_id
     * @param  int $annee_id
     * @param  int $statut_livraison



     * @param int $id
     * @return  Achat
     */

    public static function updateAchat(
        $date_achat,
        $reference,
        $quantite,
        $prix_unitaire,
        $produit_id,
        $fournisseur_id,
        $annee_id,
        $statut_livraison,

        $id)
    {


        return   $achat = Achat::findOrFail($id)->update([



            'date_achat' => $date_achat,
            'reference' => $reference,
            'quantite' => $quantite,
            'prix_unitaire' => $prix_unitaire,
            'produit_id' => $produit_id,
            'fournisseur_id' => $fournisseur_id,
            'annee_id' => $annee_id,
            'statut_livraison' => $statut_livraison,



            'id' => $id,


        ]);
    }




    /**
     * Supprimer une Achat
     *
     * @param int $id
     * @return  boolean
     */

    public static function deleteAchat($id)
    {

        $achat = Achat::findOrFail($id)->update([
            'etat' => TypeStatus::SUPPRIME

        ]);

        if ($achat) {
            return 1;
        }
        return 0;
    }



    /**
     * Retourne la liste des Achats


     * @param  int $annee_id
     * @param  int $fournisseur_id

     * @param  int $statut_livraison

     *
     * @return  array
     */

    public static function getListe(

        $annee_id = null,

        $fournisseur_id = null,

        $statut_livraison = null


    ) {



        $query =  Achat::where('etat', '!=', TypeStatus::SUPPRIME)
        ;

        if ($annee_id != null) {

            $query->where('annee_id', '=', $annee_id);
        }

        if ($fournisseur_id != null) {

            $query->where('fournisseur_id', '=', $fournisseur_id);
        }





            if ($statut_livraison != null) {

            $query->where('statut_livraison', '=', $statut_livraison);
        }





        return    $query->get();
    }



    /**
     * Retourne le nombre  des  achats


   * @param  int $annee_id
     * @param  int $fournisseur_id

     * @param  int $statut_livraison


     * @return  int $total
     */

    public static function getTotal(
         $annee_id = null,

        $fournisseur_id = null,

        $statut_livraison = null





    ) {

        $query =   DB::table('achats')


            ->where('achats.etat', '!=', TypeStatus::SUPPRIME);


       if ($annee_id != null) {

            $query->where('annee_id', '=', $annee_id);
        }

        if ($fournisseur_id != null) {

            $query->where('fournisseur_id', '=', $fournisseur_id);
        }






            if ($statut_livraison != null) {

            $query->where('statut_livraison', '=', $statut_livraison);
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
     * Obtenir un fournisseur
     *
     */
    public function fournisseur()
    {


        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }



     /**
     * Generer le  code de paiement

     * @return  string
     */

     public static function genererNumero()
     {

         $numero = "MAR-ACHT-000";

         $last =  Achat::orderBy('id', 'DESC')
             ->latest()->first();;

         if ($last) {
             $numero = $numero . $last->id;
         }


         return $numero;
     }





       /**
     * Retourne le motant total  des  paiements par type de frais  ...




     * @return  int $total
     */

    public static function getMontantTotal(
        $annee_id = null,
        $fournisseur_id = null,
        $produit_id = null,
        $statut_livraison = null,
        $date1 = null,
        $date2 = null,


    ) {

        $query =  DB::table('achats')

            ->join('produits','achats.produit_id','=','produits.id')
            ->join('fournisseurs','achats.fournisseur_id','=','fournisseurs.id')



            ->where('achats.etat', '!=', TypeStatus::SUPPRIME)
            ->where('produits.etat', '!=', TypeStatus::SUPPRIME)
            ->where('fournisseurs.etat', '!=', TypeStatus::SUPPRIME)
           ;

        if ($annee_id != null) {

            $query->where('details.annee_id', '=', $annee_id);
        }

        if ($fournisseur_id != null) {

            $query->where('achats.fournisseur_id', '=', $fournisseur_id);
        }



        if ($produit_id != null) {

            $query->where('achats.produit_id', '=', $produit_id);
        }




         if ($statut_livraison != null) {

            $query->where('achats.statut_livraison', '=', $statut_livraison);
        }


        if ($date1 != null && $date2 != null) {

            $query->whereBetween('achats.date_achat', [$date1, $date2]);
        }


        if ($date1 != null && $date2 == null) {

            $query->where('achats.date_achat', '=', $date1);
        }

        if ($date1 == null && $date2 != null) {

            $query->where('achats.date_achat', '=', $date2);
        }



        $total = $query->SUM('achats.montant');

        if ($total) {

            return   $total;
        }

        return 0;
    }




}
