<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mouvement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MouvementController extends Controller
{



    /**
     * Affiche la  liste de tous les Mouvements
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= [] ;
        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];
        $mouvements = Mouvement::getListe($annee_id);
        foreach($mouvements as  $mouvement ){


            $data[]  = array(

                "id" => $mouvement->id,
                "reference" => $mouvement->reference == null ? ' ' : $mouvement->reference,
                "date_mouvement" => $mouvement->date_mouvement == null ? ' ' : $mouvement->date_mouvement,
                   "type_mouvement" => $mouvement->type_mouvement == null ? ' ' : $mouvement->type_mouvement,

                "quantite" => $mouvement->quantite == null ? ' ' : $mouvement->quantite,
                "produit" => $mouvement->produit_id == null ? ' ' : $mouvement->produit->libelle,
                "magasin" => $mouvement->magasin_id == null ? ' ' : $mouvement->magasin->libelle,




            );
        }

        return view('admin.mouvement.index')->with(
            [
                'data' => $data,



            ]


        );


    }







    public function store(Request $request){

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];


        $validator = \Validator::make($request->all(),[
            'magasin_id'=>'required',
            'produit_id'=>'required',
            'quantite'=>'required',





        ],[
            'magasin_id.required'=>'Le magasin  est obligatoire ',
            'produit_id.required'=>'Le produit   est obligatoire ',
            'quantite.required'=>'La quantité    est obligatoire ',


        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{


                 Mouvement::addMouvement(

                    $request->date_mouvement,
                    $request->reference,
                    $request->produit_id,
                    $request->magasin_id,
                    $annee_id,
                    $request->quantite,
                    $request->type_mouvement,




                );



                return response()->json(['code'=>1,'msg'=>'Magasin  ajouté avec succès ']);
            }
        }



    public function update(Request $request, $id)
    {

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];

        $validator = \Validator::make($request->all(),[

             'magasin_id'=>'required',
            'produit_id'=>'required',
            'quantite'=>'required',


        ],[
             'magasin_id.required'=>'Le magasin  est obligatoire ',
            'produit_id.required'=>'Le produit   est obligatoire ',
            'quantite.required'=>'La quantité    est obligatoire ',



        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            Mouvement::updateMouvement(

                $request->date_mouvement,
                $request->reference,
                $request->produit_id,
                $request->magasin_id,
                $annee_id,
                $request->quantite,
                $request->type_mouvement,

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

        $mouvement = Mouvement::rechercheMouvementById($id);


        return response()->json(['code'=>1, 'mouvement'=>$mouvement

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



        $delete = Mouvement::deleteMouvement($id);


        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "Mouvement  supprimée ";
        } else {
            $success = true;
            $message = "Mouvement  non trouvée   ";
        }


        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }























}
