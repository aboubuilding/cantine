<!-- Modal -->
<div class="modal fade" id="addMouvement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog modal-dialog-center" method="post" action="#" enctype="multipart/form-data" id="form">

        @csrf


        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="defaultModalLabel">New Student Deatils</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">




                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Date Mouvement  </label>
                            <input type="date" class="form-control" id="date_Mouvement" name="date_Mouvement" ><br>




                        </div>

                        <span class="text-danger error-text date_Mouvement_error"> </span>

                    </div>

                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Fournisseur   </label>
                            <select class="form-control bottom15" name="produit_id" id="produit_id">
                                <option>Choisir un produit    </option>
                                @php

                                            $produits = App\Models\Produit::getListe();

                                            @endphp

                                            @foreach( $produits  as $produit )

                                                <option value="{{$produit->id}}" >{{$produit->libelle}}</option>


                                            @endforeach
                              </select>

                        </div>

                        <span class="text-danger error-text produit_error"> </span>

                    </div>

                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"> Mouvement    </label>
                            <select class="form-control bottom15" name="magasin_id" id="magasin_id">
                                <option>Choisir un magasin     </option>
                                @php

                                            $magasins = App\Models\Magasin::getListe();

                                            @endphp

                                            @foreach( $magasins  as $magasin )

                                                <option value="{{$magasin->id}}" >{{$magasin->libelle}}</option>


                                            @endforeach
                              </select>

                        </div>

                        <span class="text-danger error-text magasin_id_error"> </span>

                    </div>


                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Quantite  </label>
                            <input type="number" class="form-control" id="quantite" name="quantite" ><br>


                        </div>

                        <span class="text-danger error-text quantite_error"> </span>

                    </div>


                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Type mouvement </label>

                            <select class="form-control bottom15" name="type_mouvement" id="type_mouvement">
                                <option value=0>Choisir un  type de mouvement   </option>
                                <option value=1>Entrée de stocks    </option>
                                <option value=2>Sortie de stock  </option>

                              </select>

                        </div>

                        <span class="text-danger error-text type_mouvement_error"> </span>

                    </div>












                </div>
            </div>

            <input type="hidden" id="idMouvement">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" id="annulerMouvement" >Annuler </button>
                <button type="button" class="btn btn-primary" id="ajouterMouvement">Ajouter  </button>
                <button type="button" class="btn btn-primary" id="updateMouvement">Valider </button>
            </div>
        </div>


    </form>
</div>
