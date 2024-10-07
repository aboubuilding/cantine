<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Vente;


class VenteController extends Controller
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

        $ventes = Vente::getListe($annee_id);

        foreach($ventes as $vente ){
            $data []  = array(

                "id"=>$vente->id,

                "reference"=>$vente->reference == null ? ' ' :$vente->reference->reference,
                 "produit"=>$vente->produit_id == null ? ' ' :$vente->produit->libelle,
                 "montant"=>$vente->quantite == null ? ' ' :$vente->quantite * $vente->prix_unitaire,
                 "date_vente"=>$vente->date_vente == null ? ' ' :$vente->date_vente,
                 "quantite"=>$vente->quantite == null ? ' ' :$vente->quantite,
                 "prix_unitaire"=>$vente->prix_unitaire == null ? ' ' :$vente->prix_unitaire,
                 "benefice"=>$vente->benefice == null ? ' ' :$vente->benefice,



            );
        }

        return view('admin.vente.index')->with(
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
            'quantite'=>'required',





        ],[

            'produit_id.required'=>'Le produit   est obligatoire ',
            'quantite.required'=>'La quantité    est obligatoire ',


        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{


                 Vente::addVente(

                    $request->date_vente,
                    Vente::genererNumero(),
                    $request->quantite,
                    $request->prix_unitaire,
                    $annee_id,
                    $request->produit_id,





                );



                return response()->json(['code'=>1,'msg'=>'Magasin  ajouté avec succès ']);
            }
        }



    public function update(Request $request, $id)
    {

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];

        $validator = \Validator::make($request->all(),[


            'produit_id'=>'required',
            'quantite'=>'required',


        ],[


             'produit_id.required'=>'Le produit   est obligatoire ',
            'quantite.required'=>'La quantité    est obligatoire ',



        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            $vente = Vente::rechercheVenteById($id);

            Vente::updateVente(

                $request->date_vente,
                $vente->reference,
                $request->quantite,
                $request->prix_unitaire,
                $annee_id,
                $request->produit_id,

                    $id


                );



                return response()->json(['code'=>1,'msg'=>'Magasin modifié  avec succès ']);
            }
        }






    /**
     * Afficher  un Magasin
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit ($id)
    {

        $vente = Vente::rechercheVenteById($id);


        return response()->json(['code'=>1, 'vente'=>$vente

    ]);


    }







    /**
     * Supprimer   une  Magasin scolaire .
     *
     * @param  int  $int
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request,$id)
    {



        $delete = Vente::deleteVente($id);


        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "Vente   supprimée ";
        } else {
            $success = true;
            $message = "Vente   non trouvée   ";
        }


        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }



}
