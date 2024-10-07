<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Les routes des interfaces de l admin

Route::get('/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin_login');

Route::get('/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin_logout');

Route::post('/utilisateurs/authenticate', [App\Http\Controllers\Admin\UtilisateurController::class, 'authenticate'])->name('utilisateur_authenticate');

Route::get('/', [\App\Http\Controllers\Admin\TableauController::class, 'tableau'])->name('tableau');



Route::middleware(['admin'])->group(function () {

//-----------------  Tableau de bord admin




     //----------------- produits

     Route::get('/produits/index', [App\Http\Controllers\Admin\ProduitController::class, 'index'])->name('admin_produit_index');
     Route::get('/produits/add', [App\Http\Controllers\Admin\ProduitController::class, 'add'])->name('admin_produit_add');
     Route::post('/produits/save', [App\Http\Controllers\Admin\ProduitController::class, 'store'])->name('admin_produit_store');
     Route::get('/produits/modifier/{id}', [App\Http\Controllers\Admin\ProduitController::class, 'edit'])->name('admin_produit_edit');
     Route::post('/produits/update/{id}', [App\Http\Controllers\Admin\ProduitController::class, 'update'])->name('admin_produit_update');
     Route::post('/produits/delete/{id}', [App\Http\Controllers\Admin\ProduitController::class, 'delete'])->name('admin_produit_delete');



     //----------------- Articles

     Route::get('/articles/index', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin_article_index');
     Route::get('/articles/add', [App\Http\Controllers\Admin\ArticleController::class, 'add'])->name('admin_article_add');
     Route::post('/articles/save', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('admin_article_store');
     Route::get('/articles/modifier/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('admin_article_edit');
     Route::post('/articles/update/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('admin_article_update');
     Route::post('/articles/delete/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('admin_article_delete');



      //----------------- magasins

      Route::get('/magasins/index', [App\Http\Controllers\Admin\MagasinController::class, 'index'])->name('admin_magasin_index');
      Route::get('/magasins/add', [App\Http\Controllers\Admin\MagasinController::class, 'add'])->name('admin_magasin_add');
      Route::post('/magasins/save', [App\Http\Controllers\Admin\MagasinController::class, 'store'])->name('admin_magasin_store');
      Route::get('/magasins/modifier/{id}', [App\Http\Controllers\Admin\MagasinController::class, 'edit'])->name('admin_magasin_edit');
      Route::post('/magasins/update/{id}', [App\Http\Controllers\Admin\MagasinController::class, 'update'])->name('admin_magasin_update');
      Route::post('/magasins/delete/{id}', [App\Http\Controllers\Admin\MagasinController::class, 'delete'])->name('admin_magasin_delete');


 //----------------- boutiques

 Route::get('/boutiques/index', [App\Http\Controllers\Admin\BoutiqueController::class, 'index'])->name('admin_boutique_index');
 Route::get('/boutiques/add', [App\Http\Controllers\Admin\BoutiqueController::class, 'add'])->name('admin_boutique_add');
 Route::post('/boutiques/save', [App\Http\Controllers\Admin\BoutiqueController::class, 'store'])->name('admin_boutique_store');
 Route::get('/boutiques/modifier/{id}', [App\Http\Controllers\Admin\BoutiqueController::class, 'edit'])->name('admin_boutique_edit');
 Route::post('/boutiques/update/{id}', [App\Http\Controllers\Admin\BoutiqueController::class, 'update'])->name('admin_boutique_update');
 Route::post('/boutiques/delete/{id}', [App\Http\Controllers\Admin\BoutiqueController::class, 'delete'])->name('admin_boutique_delete');



    //----------------- achats

    Route::get('/achats/index', [App\Http\Controllers\Admin\AchatController::class, 'index'])->name('admin_achat_index');
    Route::get('/achats/add', [App\Http\Controllers\Admin\AchatController::class, 'add'])->name('admin_achat_add');
    Route::post('/achats/save', [App\Http\Controllers\Admin\AchatController::class, 'store'])->name('admin_achat_store');
    Route::get('/achats/modifier/{id}', [App\Http\Controllers\Admin\AchatController::class, 'edit'])->name('admin_achat_edit');
    Route::post('/achats/update/{id}', [App\Http\Controllers\Admin\AchatController::class, 'update'])->name('admin_achat_update');
    Route::post('/achats/delete/{id}', [App\Http\Controllers\Admin\AchatController::class, 'delete'])->name('admin_achat_delete');


    //----------------- achats pour les boutiques

    Route::get('/boutiques/achats/index', [App\Http\Controllers\Admin\AchatBoutiqueController::class, 'index'])->name('admin_achat_boutique_index');
    Route::get('/boutiques/achats/add', [App\Http\Controllers\Admin\AchatBoutiqueController::class, 'add'])->name('admin_achat_boutique_add');
    Route::post('/boutiques/achats/save', [App\Http\Controllers\Admin\AchatBoutiqueController::class, 'store'])->name('admin_achat_boutique_store');
    Route::get('/boutiques/achats/modifier/{id}', [App\Http\Controllers\Admin\AchatBoutiqueController::class, 'edit'])->name('admin_achat_boutique_edit');
    Route::post('/boutiques/achats/update/{id}', [App\Http\Controllers\Admin\AchatBoutiqueController::class, 'update'])->name('admin_achat_boutique_update');
    Route::post('/boutiques/achats/delete/{id}', [App\Http\Controllers\Admin\AchatBoutiqueController::class, 'delete'])->name('admin_achat_boutique_delete');



    //----------------- ventes

    Route::get('/ventes/index', [App\Http\Controllers\Admin\VenteController::class, 'index'])->name('admin_vente_index');
    Route::get('/ventes/add', [App\Http\Controllers\Admin\VenteController::class, 'add'])->name('admin_vente_add');
    Route::post('/ventes/save', [App\Http\Controllers\Admin\VenteController::class, 'store'])->name('admin_vente_store');
    Route::get('/ventes/modifier/{id}', [App\Http\Controllers\Admin\VenteController::class, 'edit'])->name('admin_vente_edit');
    Route::post('/ventes/update/{id}', [App\Http\Controllers\Admin\VenteController::class, 'update'])->name('admin_vente_update');
    Route::post('/ventes/delete/{id}', [App\Http\Controllers\Admin\VenteController::class, 'delete'])->name('admin_vente_delete');



     //----------------- fournisseurs

     Route::get('/fournisseurs/index', [App\Http\Controllers\Admin\FournisseurController::class, 'index'])->name('admin_fournisseur_index');
     Route::get('/fournisseurs/add', [App\Http\Controllers\Admin\FournisseurController::class, 'add'])->name('admin_fournisseur_add');
     Route::post('/fournisseurs/save', [App\Http\Controllers\Admin\FournisseurController::class, 'store'])->name('admin_fournisseur_store');
     Route::get('/fournisseurs/modifier/{id}', [App\Http\Controllers\Admin\FournisseurController::class, 'edit'])->name('admin_fournisseur_edit');
     Route::post('/fournisseurs/update/{id}', [App\Http\Controllers\Admin\FournisseurController::class, 'update'])->name('admin_fournisseur_update');
     Route::post('/fournisseurs/delete/{id}', [App\Http\Controllers\Admin\FournisseurController::class, 'delete'])->name('admin_fournisseur_delete');




     //----------------- livreurs

     Route::get('/livreurs/index', [App\Http\Controllers\Admin\LivreurController::class, 'index'])->name('admin_livreur_index');
     Route::get('/livreurs/add', [App\Http\Controllers\Admin\LivreurController::class, 'add'])->name('admin_livreur_add');
     Route::post('/livreurs/save', [App\Http\Controllers\Admin\LivreurController::class, 'store'])->name('admin_livreur_store');
     Route::get('/livreurs/modifier/{id}', [App\Http\Controllers\Admin\LivreurController::class, 'edit'])->name('admin_livreur_edit');
     Route::post('/livreurs/update/{id}', [App\Http\Controllers\Admin\LivreurController::class, 'update'])->name('admin_livreur_update');
     Route::post('/livreurs/delete/{id}', [App\Http\Controllers\Admin\LivreurController::class, 'delete'])->name('admin_livreur_delete');


      //----------------- annee

      Route::get('/annees/index', [App\Http\Controllers\Admin\AnneeController::class, 'index'])->name('admin_annee_index');
      Route::get('/annees/add', [App\Http\Controllers\Admin\AnneeController::class, 'add'])->name('admin_annee_add');
      Route::post('/annees/save', [App\Http\Controllers\Admin\AnneeController::class, 'store'])->name('admin_annee_store');
      Route::get('/annees/modifier/{id}', [App\Http\Controllers\Admin\AnneeController::class, 'edit'])->name('admin_annee_edit');
      Route::post('/annees/update/{id}', [App\Http\Controllers\Admin\AnneeController::class, 'update'])->name('admin_annee_update');
      Route::post('/annees/delete/{id}', [App\Http\Controllers\Admin\AnneeController::class, 'delete'])->name('admin_annee_delete');


      //----------------- mouvements

      Route::get('/mouvements/index', [App\Http\Controllers\Admin\MouvementController::class, 'index'])->name('admin_mouvement_index');
      Route::get('/mouvements/add', [App\Http\Controllers\Admin\MouvementController::class, 'add'])->name('admin_mouvement_add');
      Route::post('/mouvements/save', [App\Http\Controllers\Admin\MouvementController::class, 'store'])->name('admin_mouvement_store');
      Route::get('/mouvements/modifier/{id}', [App\Http\Controllers\Admin\MouvementController::class, 'edit'])->name('admin_mouvement_edit');
      Route::post('/mouvements/update/{id}', [App\Http\Controllers\Admin\MouvementController::class, 'update'])->name('admin_mouvement_update');
      Route::post('/mouvements/delete/{id}', [App\Http\Controllers\Admin\MouvementController::class, 'delete'])->name('admin_mouvement_delete');

//----------------- Mouvements boutiques

Route::get('/boutiques/mouvements/index', [App\Http\Controllers\Admin\MouvementBoutiqueController::class, 'index'])->name('admin_mouvement_boutique_index');
Route::get('/boutiques/mouvements/add', [App\Http\Controllers\Admin\MouvementBoutiqueController::class, 'add'])->name('admin_mouvement_boutique_add');
Route::post('/boutiques/mouvements/save', [App\Http\Controllers\Admin\MouvementBoutiqueController::class, 'store'])->name('admin_mouvement_boutique_store');
Route::get('/boutiques/mouvements/modifier/{id}', [App\Http\Controllers\Admin\MouvementBoutiqueController::class, 'edit'])->name('admin_mouvement_boutique_edit');
Route::post('/boutiques/mouvements/update/{id}', [App\Http\Controllers\Admin\MouvementBoutiqueController::class, 'update'])->name('admin_mouvement_boutique_update');
Route::post('/boutiques/mouvements/delete/{id}', [App\Http\Controllers\Admin\MouvementBoutiqueController::class, 'delete'])->name('admin_mouvement_boutique_delete');





      //----------------- utilisateurs

      Route::get('/utilisateurs/index', [App\Http\Controllers\Admin\UtilisateurController::class, 'index'])->name('admin_utilisateur_index');
      Route::get('/utilisateurs/add', [App\Http\Controllers\Admin\UtilisateurController::class, 'add'])->name('admin_utilisateur_add');
      Route::post('/utilisateurs/save', [App\Http\Controllers\Admin\UtilisateurController::class, 'store'])->name('admin_utilisateur_store');
      Route::get('/utilisateurs/modifier/{id}', [App\Http\Controllers\Admin\UtilisateurController::class, 'edit'])->name('admin_utilisateur_edit');
      Route::post('/utilisateurs/update/{id}', [App\Http\Controllers\Admin\UtilisateurController::class, 'update'])->name('admin_utilisateur_update');
      Route::post('/utilisateurs/delete/{id}', [App\Http\Controllers\Admin\UtilisateurController::class, 'delete'])->name('admin_utilisateur_delete');




       //----------------- Menus

       Route::get('/menus/index', [App\Http\Controllers\Admin\MenuController::class, 'index'])->name('admin_menu_index');
       Route::get('/menus/add', [App\Http\Controllers\Admin\MenuController::class, 'add'])->name('admin_menu_add');
       Route::post('/menus/save', [App\Http\Controllers\Admin\MenuController::class, 'store'])->name('admin_menu_store');
       Route::get('/menus/modifier/{id}', [App\Http\Controllers\Admin\MenuController::class, 'edit'])->name('admin_menu_edit');
       Route::post('/menus/update/{id}', [App\Http\Controllers\Admin\MenuController::class, 'update'])->name('admin_menu_update');
       Route::post('/menus/delete/{id}', [App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('admin_menu_delete');



         //----------------- Stocks cantine

         Route::get('/stocks/index', [App\Http\Controllers\Admin\StockController::class, 'index'])->name('admin_stock_index');



         //----------------- Stocks boutiques

         Route::get('/boutiques/stocks/index', [App\Http\Controllers\Admin\BoutiqueStockController::class, 'index'])->name('admin_boutique_index');





});
