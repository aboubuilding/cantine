<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Produit;


use Illuminate\Http\Request;


class ArticleController extends Controller
{

    /**
     * Affiche la  liste des  années
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= [] ;



        $Articles = Produit::getListe();

        foreach($Articles as $Article ){
            $data []  = array(

                "id"=>$Article->id,
                "libelle"=>$Article->libelle == null ? ' ' :$Article->libelle,
                "prix_unitaire_achat"=>$Article->prix_unitaire_achat == null ? ' ' :$Article->prix_unitaire_achat,
                "prix_unitaire_vente"=>$Article->prix_unitaire_vente == null ? ' ' :$Article->prix_unitaire_vente,
                "unite_stock"=>$Article->unite_stock == null ? ' ' :$Article->unite_stock,
                "unite_achat"=>$Article->unite_achat == null ? ' ' :$Article->unite_achat,
                "type_Article"=>$Article->equivalence == null ? ' ' :$Article->type_Article,




            );
        }

        return view('admin.Article.index')->with(
            [
                'data' => $data,

            ]


        );


    }




    public function store(Request $request){

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];


        $validator = \Validator::make($request->all(),[
            'libelle'=>'required|string|max:25',

            'type_Article'=>'required',




        ],[
            'libelle.required'=>'Le libellé  est obligatoire ',
            'libelle.string'=>'Le libellé  doit etre une chaine de caracteres ',
            'libelle.max'=>'Le libellé  ne peut pas depasser 25 caracteres ',

            'type_Article.required'=>'Le type de Article   est obligatoire  ',




        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{


                 Article::addArticle(

                    $request->libelle,
                    $request->quantite_initiale,
                    $request->prix_unitaire_achat,
                    $request->prix_unitaire_vente,
                    $request->photo,
                    $request->unite_stock,
                    $request->unite_achat,
                    $request->equivalence,
                    $request->type_Article,




                );



                return response()->json(['code'=>1,'msg'=>'Article  ajouté avec succès ']);
            }
        }



    public function update(Request $request, $id){

        $session = session()->get('LoginUser');
        $annee_id = $session['annee_id'];
        $validator = \Validator::make($request->all(),[

            'libelle'=>'required|string|max:25',

            'type_Article'=>'required',



        ],[
            'libelle.required'=>'Le libellé  est obligatoire ',
            'libelle.string'=>'Le libellé  doit etre une chaine de caracteres ',
            'libelle.max'=>'Le libellé  ne peut pas depasser 25 caracteres ',

            'type_Article.required'=>'Le type de Article   est obligatoire  ',



        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

                Article::updateArticle(

                    $request->libelle,
                    $request->quantite_initiale,
                    $request->prix_unitaire_achat,
                    $request->prix_unitaire_vente,
                    $request->photo,
                    $request->unite_stock,
                    $request->unite_achat,
                    $request->equivalence,
                    $request->type_Article,



                    $id


                );



                return response()->json(['code'=>1,'msg'=>'Article modifié  avec succès ']);
            }
        }






    /**
     * Afficher  un Article
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit ($id)
    {

        $Article = Article::rechercheArticleById($id);


        return response()->json(['code'=>1, 'Article'=>$Article]);


    }







    /**
     * Supprimer   une  Article scolaire .
     *
     * @param  int  $int
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request,$id)
    {



        $delete = Article::deleteArticle($id);


        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "Article  supprimée ";
        } else {
            $success = true;
            $message = "Article  non trouvée   ";
        }


        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }







}
