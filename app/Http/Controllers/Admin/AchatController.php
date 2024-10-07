<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achat;


use App\Models\DetailAchat;

use Illuminate\Http\Request;
use App\Types\StatutLivraison;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AchatController extends Controller
{

    /**
     * Affiche la  liste des  années
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= [] ;

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];

        $achats = Achat::getListe( $annee_id);

        foreach($achats as $achat ){
            $data []  = array(

                "id"=>$achat->id,
                "date_achat"=>$achat->date_achat == null ? ' ' :$achat->date_achat,
                "reference"=>$achat->reference == null ? ' ' :$achat->reference,
                "fournisseur"=>$achat->fournisseur_id == null ? ' ' :$achat->fournisseur->raison_sociale,
                "produit"=>$achat->produit_id == null ? ' ' :$achat->produit->libelle,

                "montant"=>$achat->quantite * $achat->prix_unitaire,
                "statut_livraison"=>$achat->statut_livraison == null ? ' ' : $achat->statut_livraison,


            );
        }

        return view('admin.achat.index')->with(
            [
                'data' => $data,

            ]


        );


    }




    public function store(Request $request){

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];


        $validator = \Validator::make($request->all(),[

            'produit_id'=>'required',
            'prix_unitaire'=>'required',
            'quantite'=>'required',




        ],[

            'fournisseur_id.required'=>'Le fournisseur    est obligatoire  ',
            'prix_unitaire.required'=>'Le prix unitaire     est obligatoire  ',
            'quantite.required'=>'La quantité     est obligatoire  ',




        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{


             DB::beginTransaction();
    try {




        $achat =  Achat::addAchat(

                    $request->date_achat,

                    Achat::genererNumero(),
                    $request->quantite,
                    $request->prix_unitaire,
                    $request->produit_id,
                    $request->fournisseur_id,
                     $annee_id,


                     StatutLivraison::NON_LIVRE,




                );




                DB::commit();

                return response()->json(
                    [
                        'code' => 1,
                        'msg' => 'Achat   ajouté avec succès ',
                        'achat_reference' => $achat->reference,
                        'montant' => DetailAchat::getMontantTotal($annee_id, $achat->id)




                    ]

                );
   } catch (\Exception $e) {
                // En cas d'erreur, annulez la transaction
                DB::rollback();

                // Gérez l'erreur ou lancez une exception personnalisée
                // throw new CustomException('Une erreur s'est produite');

                return response()->json(
                    [
                        'code' => 0,
                        'msg' => "Une erreur s'est produite !",
                        'data' => $request->all()


                    ]

                );
            }
            }
        }



    public function update(Request $request, $id){

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];
        $validator = \Validator::make($request->all(),[

           'produit_id'=>'required',
            'prix_unitaire'=>'required',
            'quantite'=>'required',


        ],[
            'fournisseur_id.required'=>'Le fournisseur    est obligatoire  ',
            'prix_unitaire.required'=>'Le prix unitaire     est obligatoire  ',
            'quantite.required'=>'La quantité     est obligatoire  ',



        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{


            $achat = Achat::rechercheAchatById($id);

                Achat::updateAchat(

                    $request->date_achat,

                    Achat::genererNumero(),
                    $request->quantite,
                    $request->prix_unitaire,
                    $request->produit_id,
                    $request->fournisseur_id,
                     $annee_id,
                     $achat->statut_livraison,

                    $id


                );



                return response()->json(['code'=>1,'msg'=>'Achat modifié  avec succès ']);
            }
        }






    /**
     * Afficher  un Achat
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit ($id)
    {

        $achat = Achat::rechercheAchatById($id);


        return response()->json(['code'=>1, 'Achat'=>$achat]);


    }










    /**
     * Supprimer   une  Achat scolaire .
     *
     * @param  int  $int
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request,$id)
    {



        $delete = Achat::deleteAchat($id);


        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "Achat  supprimée ";
        } else {
            $success = true;
            $message = "Achat  non trouvée   ";
        }


        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }







}
