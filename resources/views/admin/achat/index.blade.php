
@extends('layout.app')

@section('title')

    Cantine | Achats

@endsection

@section('css')



    <link href="{{asset('admin/css/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection

@section('nav')
    @include('admin.aside')
@endsection



@section('contenu')


<div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title flex-wrap">
                                    <div class="input-group search-area mb-md-0 mb-3">

                                    </div>
                                    <div>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" id="lancerAchat">
                                         + Achat
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 wow fadeInUp" data-wow-delay="1.5s">
                                <div class="table-responsive full-data">
                                    <table class="table-responsive-lg table display dataTablesCard student-tab dataTable no-footer" id="example-student">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                                </th>
                                                <th>Reference </th>
                                                <th> Fournisseur</th>
                                                <th> Produit </th>
                                                <th>Date  Achat </th>
                                                <th>Montant </th>
                                                <th>Statut </th>



                                                <th class="text-end" style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        @foreach( $data as $achat )


                                            <tr>
                                                <td>
                                                    <div class="checkbox me-0 align-self-center">
                                                        <div class="custom-control custom-checkbox ">
                                                            <input type="checkbox" class="form-check-input" id="check8" required="">
                                                            <label class="custom-control-label" for="check8"></label>
                                                        </div>
                                                    </div>
                                                </td>


                                                <td>
                                                    <div class="trans-list">

                                                        <h4>{{ $achat['reference'] }}</h4>
                                                    </div>
                                                </td>


                                                <td><h6 class="mb-0">{{ $achat['fournisseur'] }} </h6></td>
                                                <td><h6 class="mb-0">{{ $achat['date_achat'] }} </h6></td>

                                                <td><h6 class="mb-0">{{ $achat['montant'] }} </h6></td>


                                                <td>


                                                    @if($achat ['statut_livraison'] == 1)

                                                    <span class="badge badge-primary light badge-sm"> Pas en stock</span>

                                                @endif


                                                @if($achat ['statut_livraison'] == 2)

                                                <span class="badge badge-primary light badge-sm">En stock  </span>

                                                @endif






                                                </td>




                                                <td>
                                                    <div class="d-flex">

                                                        @if($achat ['statut_livraison'] == 1)
                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 modifierAchat" style="background-color: #1EA1F3; border: #1EA1F3" data-id="{{$achat['id']}}" title="Modifier " data-id="{{$achat['id']}}"><i class="fa fa-pencil"></i></a>


                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp supprimerAchat" data-id="{{$achat['id']}}"  title="Supprimer "><i class="fa fa-trash"></i></a>

                                                        @endif


                                                    </div>
                                                </td>
                                            </tr>


                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </div>
        </div>

@include('admin.achat.modal')

@endsection



@section('js')


    <script src="{{asset('admin')}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/js/plugins-init/datatables.init.js"></script>


    <script src="{{asset('admin')}}/vendor/wow-master/dist/wow.min.js"></script>

    <script src="{{asset('admin/js/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {




            $("#lancerAchat").click(function(event) {
                event.preventDefault();

                lancerAchat()
            });

            $("#annulerAchat").click(function(event) {
                event.preventDefault();

                annulerAchat()
            });
            $(document).on('click', '#ajouterAchat', function(event) {

                event.preventDefault();
                let id = $(this).data('id');

                event.preventDefault();
                validerAchat()

            });




            //------------------------ Modification de la zone
            $(document).on('click', '.modifierAchat', function() {

                let id = $(this).data('id');
                let url = "/achats/modifier/" + id;


                $.get(url, function(data) {

                    console.log(data.result);

                    $('#defaultModalLabel').text('Modifier un achat   ');

                    let achat_modal = $('#addAchat');

                    $(achat_modal).find('form').find('input[name="reference"]').val(data.achat.reference);
                    $(achat_modal).find('form').find('input[name="date_achat"]').val(data.achat.date_achat);
                    $(achat_modal).find('form').find('input[name="quantite"]').val(data.achat.quantite);
                    $(achat_modal).find('form').find('input[name="prix_unitaire"]').val(data.achat.prix_unitaire);
                    $(achat_modal).find('form').find('select[name="produit_id"]').val(data.achat.produit_id);
                    $(achat_modal).find('form').find('select[name="fournisseur_id"]').val(data.achat.fournisseur_id);




                    $('#idAchat').val(data.achat.id);

                    $("#ajouterAchat").hide();
                    $("#updateAchat").show();

                    $(achat_modal).modal('toggle');

                }, 'json')



            });


            $(document).on('click', '.supprimerAchat', function(event) {

                event.preventDefault();
                let id = $(this).data('id');

                deleteConfirmation(id)

            });




            $("#updateAchat").click(function(event) {
                event.preventDefault();

                updateAchat()
            });


            clearData();

        });



        function clearData() {

            $('#date_achat').val('');
            $('#quantite').val('');
            $('#prix_unitaire').val('');
            $('#produit_id').val('');
            $('#fournisseur_id').val('');




            let form = document.getElementById('form');
            $(form).find('span.error-text').text('');

            $("#ajouterAchat").show();
            $("#updateAchat").hide();

        }

        //------------------------ Valider la catégorie

        function validerAchat() {

            let allValid = true;
            let quantite = parseInt($("#prix_unitaire_achat").val(), 10);
            let produit_id = parseInt($("#prix_unitaire_Achat").val(), 10);
            let fournisseur_id = parseInt($("#type_Achat").val(), 10);

            let date_achat = $('#date_achat').val().trim();


            if (isNaN(quantite) || quantite === 0) {
                $('.quantite_error').text("La quantité    est obligatoire ");
                allValid = false;

            }


            if (isNaN(produit_id) || produit_id === 0) {
                $('.type_Achat_error').text("Le choix du produit   est obligatoire ");
                allValid = false;

            }


            if (isNaN(fournisseur_id) || fournisseur_id === 0) {
                $('.fournisseur_id_error').text("Le choix du fournisseur    est obligatoire ");
                allValid = false;

            }



            if (date_achat === '') {
                $('.date_achat_error').text("La date d achat      est obligatoire ");
                allValid = false;

            }


            if (allValid) {



                let form = document.getElementById('form');
                let formData = new FormData(form);


                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: "/achats/save",
                    method: $(form).attr('method'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // setting a timeout
                        $(form).find('span.error-text').text('');

                    },

                    success: function(data) {
                        console.log(data)

                        if (data.code === 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {


                            Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: data.msg,
                                    showConfirmButton: false,


                                },

                                setTimeout(function() {
                                    location.reload();
                                }, 2000));
                        }





                    },

                    error: function(data) {

                        console.log(data);



                    }



                });



            }
        }




        //------------------------ Ouvrir le popup d' ajout
        function lancerAchat() {

            clearData();

            $('#defaultModalLabel').text('Ajouter  un achat   ');

            $('#addAchat').modal('toggle');
        }


        //------------------------ Fermer  le popup d' ajout
        function annulerAchat() {

            clearData();



            $('#addAchat').modal('toggle');
        }

        //------------------------ Update de Achat
        function updateAchat() {



            let allValid = true;

            let quantite = parseInt($("#prix_unitaire_achat").val(), 10);
            let produit_id = parseInt($("#prix_unitaire_Achat").val(), 10);
            let fournisseur_id = parseInt($("#type_Achat").val(), 10);

            let date_achat = $('#date_achat').val().trim();



            if (isNaN(quantite) || quantite === 0) {
                $('.quantite_error').text("La quantité    est obligatoire ");
                allValid = false;

            }


            if (isNaN(produit_id) || produit_id === 0) {
                $('.type_Achat_error').text("Le choix du produit   est obligatoire ");
                allValid = false;

            }


            if (isNaN(fournisseur_id) || fournisseur_id === 0) {
                $('.fournisseur_id_error').text("Le choix du fournisseur    est obligatoire ");
                allValid = false;

            }



            if (date_achat === '') {
                $('.date_achat_error').text("La date d achat      est obligatoire ");
                allValid = false;

            }

            let id = $('#idAchat').val();


            if (allValid) {

                let form = document.getElementById('form');
                let formData = new FormData(form);


            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: "/achats/update/" + id,
                method: $(form).attr('method'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // setting a timeout
                    $(form).find('span.error-text').text('');

                },

                success: function(data) {


                    console.log(data.code)

                    if(data.code == 1 ){

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.msg,
                            showConfirmButton: false,


                        },

                        setTimeout(function() {
                            location.reload();
                        }, 2000));

                    }




                },

                error: function(data) {

                    console.log(data);



                }



            });

            }


        }



        //------------------------ fonction de suppression de Achat

        function deleteConfirmation(id) {
            Swal.fire({
                title: "Voulez vous supprimer cet achat  ?",
                icon: 'question',
                text: "",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Valider",
                cancelButtonText: "Annuler",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "/achats/delete/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {

                            console.log(results)
                            if (results.success === true) {
                                Swal.fire("Succès", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                Swal.fire("Erreur!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>


@endsection
