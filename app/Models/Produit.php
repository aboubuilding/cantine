<?php

namespace App\Models;

use App\Types\TypeStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Produit extends Model
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
        'quantite_initiale',
        'prix_unitaire_achat',
        'prix_unitaire_vente',
        'photo',
        'unite_stock',
        'unite_achat',
        'equivalence',




        'etat',

    ];



    /**
     * Ajouter un Produit
     *

     * @param  string $libelle

     * @param  int $quantite_initiale
     * @param  int $prix_unitaire_achat
     * @param  int $prix_unitaire_vente
     * @param  string $photo
     * @param  int $unite_stock
     * @param  int $unite_achat
     * @param  int $equivalence




     * @return Produit
     */

    public static function addProduit(
        $libelle,
        $quantite_initiale,
        $prix_unitaire_achat,
        $prix_unitaire_vente,
        $photo,
        $unite_stock,
        $unite_achat,
        $equivalence



    )
    {
        $produit = new Produit();


        $produit->libelle = $libelle;
        $produit->quantite_initiale = $quantite_initiale;
        $produit->prix_unitaire_achat = $prix_unitaire_achat;
        $produit->prix_unitaire_vente = $prix_unitaire_vente;
        $produit->photo = $photo;
        $produit->unite_stock = $unite_stock;
        $produit->unite_achat = $unite_achat;
        $produit->equivalence = $equivalence;


        $produit->created_at = Carbon::now();

        $produit->save();

        return $produit;
    }

    /**
     * Affichage d'un Produit
     * @param int $id
     * @return  Produit
     */

    public static function rechercheProduitById($id)
    {

        return   $produit = Produit::findOrFail($id);
    }

    /**
     * Update d'une Produit scolaire

     * @param  string $libelle

     * @param  int $quantite_initiale
     * @param  int $prix_unitaire_achat
     * @param  int $prix_unitaire_vente
     * @param  string $photo
     * @param  int $unite_stock
     * @param  int $unite_achat
     * @param  int $equivalence



     * @param int $id
     * @return  Produit
     */

    public static function updateProduit(
        $libelle,
        $quantite_initiale,
        $prix_unitaire_achat,
        $prix_unitaire_vente,
        $photo,
        $unite_stock,
        $unite_achat,
        $equivalence,


        $id)
    {


        return   $produit = Produit::findOrFail($id)->update([



            'libelle' => $libelle,
            'quantite_initiale' => $quantite_initiale,
            'prix_unitaire_achat' => $prix_unitaire_achat,
            'prix_unitaire_vente' => $prix_unitaire_vente,
            'photo' => $photo,
            'unite_stock' => $unite_stock,
            'unite_achat' => $unite_achat,
            'equivalence' => $equivalence,




            'id' => $id,


        ]);
    }




    /**
     * Supprimer une Produit
     *
     * @param int $id
     * @return  boolean
     */

    public static function deleteProduit($id)
    {

        $produit = Produit::findOrFail($id)->update([
            'etat' => TypeStatus::SUPPRIME

        ]);

        if ($produit) {
            return 1;
        }
        return 0;
    }



    /**
     * Retourne la liste des Produits







     *
     * @return  array
     */

    public static function getListe(





    ) {



        $query =  Produit::where('etat', '!=', TypeStatus::SUPPRIME)
        ;






        return    $query->get();
    }



    /**
     * Retourne le nombre  des  Produits









     * @return  int $total
     */

    public static function getTotal(







    ) {

        $query =   DB::table('produits')


            ->where('produits.etat', '!=', TypeStatus::SUPPRIME);



        $total = $query->count();

        if ($total) {

            return   $total;
        }

        return 0;
    }






}
