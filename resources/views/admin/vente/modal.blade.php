<!-- Modal -->
<div class="modal fade" id="addAchat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="exampleFormControlInput1" class="form-label">Date dachat  </label>
                            <input type="date" class="form-control" id="date_achat" name="date_achat" ><br>




                        </div>

                        <span class="text-danger error-text date_achat_error"> </span>

                    </div>

                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Fournisseur   </label>
                            <select class="form-control bottom15" name="fournisseur_id" id="fournisseur_id">
                                <option>Choisir un fournisseur   </option>
                                @php

                                            $fournisseurs = App\Models\Fournisseur::getListe();

                                            @endphp

                                            @foreach( $fournisseurs  as $fournisseur )

                                                <option value="{{$fournisseur->id}}" >{{$fournisseur->raison_social}}</option>


                                            @endforeach
                              </select>

                        </div>

                        <span class="text-danger error-text fournisseur_id_error"> </span>

                    </div>

                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"> Achat    </label>
                            <select class="form-control bottom15" name="Achat_id" id="Achat_id">
                                <option>Choisir un Achat    </option>
                                @php

                                            $Achats = App\Models\Achat::getListe();

                                            @endphp

                                            @foreach( $Achats  as $Achat )

                                                <option value="{{$Achat->id}}" >{{$Achat->libelle}}</option>


                                            @endforeach
                              </select>

                        </div>

                        <span class="text-danger error-text Achat_id_error"> </span>

                    </div>


                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prix   unitaire  vente </label>
                            <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" ><br>


                        </div>

                        <span class="text-danger error-text prix_unitaire_error"> </span>

                    </div>


                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Prix   unitaire  vente </label>
                            <input type="number" class="form-control" id="quantite" name="quantite" ><br>


                        </div>

                        <span class="text-danger error-text quantite_error"> </span>

                    </div>












                </div>
            </div>

            <input type="hidden" id="idAchat">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" id="annulerAchat" >Annuler </button>
                <button type="button" class="btn btn-primary" id="ajouterAchat">Ajouter  </button>
                <button type="button" class="btn btn-primary" id="updateAchat">Valider </button>
            </div>
        </div>


    </form>
</div>
