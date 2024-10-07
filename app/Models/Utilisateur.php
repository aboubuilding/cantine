<?php

namespace App\Models;

use App\Types\Role;

use App\Types\TypeStatus;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->etat = TypeStatus::ACTIF;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [


        'nom',
        'prenom',
        'login',

        'mot_passe',
        'role',

        'etat',

    ];



    /**
     * Ajouter une Utilisateur
     *

     * @param  string $nom
     * @param  string $prenom
     * @param  string $login
     * @param  string $mot_passe
     * @param  int $role





     * @return Utilisateur
     */

    public static function addUtilisateur(
        $nom,
        $prenom,
        $login,
        $mot_passe,
        $role


    ) {
        $utilisateur = new Utilisateur();


        $utilisateur->nom = $nom;
        $utilisateur->prenom = $prenom;
        $utilisateur->login = $login;
        $utilisateur->mot_passe = $mot_passe;
        $utilisateur->role = $role;



        $utilisateur->created_at = Carbon::now();

        $utilisateur->save();

        return $utilisateur;
    }

    /**
     * Affichage d'une année scolaire
     * @param int $id
     * @return  Utilisateur
     */

    public static function rechercheUtilisateurById($id)
    {

        return $utilisateur = Utilisateur::findOrFail($id);
    }

    /**
     * Update d'une Utilisateur scolaire

     * @param  string $nom
     * @param  date $prenom
     * @param  date $login
     * @param  int $role



     * @param int $id
     * @return  Utilisateur
     */

    public static function updateUtilisateur(
        $nom,
        $prenom,
        $login,
        $role,



        $id
    ) {


        return $utilisateur = Utilisateur::findOrFail($id)->update([



            'nom' => $nom,
            'prenom' => $prenom,
            'login' => $login,
            'role' => $role,


            'id' => $id,


        ]);
    }




    /**
     * Supprimer une Utilisateur
     *
     * @param int $id
     * @return  boolean
     */

    public static function deleteUtilisateur($id)
    {

        $utilisateur = Utilisateur::findOrFail($id)->update([
            'etat' => TypeStatus::SUPPRIME

        ]);

        if ($utilisateur) {
            return 1;
        }
        return 0;
    }



    /**
     * Retourne la liste des années
     * @param  int $role



     *
     * @return  array
     */

    public static function getListe(

        $role = null



    ) {

        $query = Utilisateur::where('etat', '!=', TypeStatus::SUPPRIME)
        ;




        if ($role != null) {

            $query->where('role', '=', $role);
        }



        return $query->get();
    }



    /**
     * Retourne le nombre  des  années


     * @param  int $role


     * @return  int $total
     */

    public static function getTotal(

        $role = null
    ) {

        $query = DB::table('utilisateurs')


            ->where('utilisateurs.etat', '!=', TypeStatus::SUPPRIME);


        if ($role != null) {

            $query->where('role', '=', $role);
        }



        $total = $query->count();

        if ($total) {

            return $total;
        }

        return 0;
    }






    /**
     * Verifier si l'Utilisateur   existe deja
     *


     * @param  string $login
     * @param  string $mot_passe

     * @return  boolean
     */

    public static function isExiste($login, $mot_passe)
    {
        $utilisateurs = Utilisateur::getTotal();

        if (!$utilisateurs) {

            Utilisateur::genererUtilisateur();
        }


        $utilisateur = Utilisateur::where('etat', '!=', TypeStatus::SUPPRIME)


            ->where('login', '=', $login)

            ->where('mot_passe', '=', $mot_passe)


            ->first();


        if ($utilisateur) {



            return 1;
        }

        return 0;
    }


    /**
     * Verification de l' authenttification '


     * @param  string $login
     * @param  string $mot_passe



     * @return  array
     */

    public static function isAuthenticate($login, $mot_passe)
    {

        $data = array();

        $isValid = false;



        $erreurMessage = '';


        // Verification de la validité des données

        if (!Utilisateur::isExiste($login, $mot_passe)) {
            $erreurMessage = "Le login ou le mot de passe est incorrect";

        } else {

            $erreurMessage = '';

            $isValid = true;
        }

        return $data = [


            'isValid' => $isValid,

            'erreurMessage' => $erreurMessage,


        ];
    }



   


}
