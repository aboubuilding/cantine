
@extends('layout.app')

@section('title')

    Cantine | Ventes

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
                                        <button type="button" class="btn btn-primary" id="lancerVente">
                                         + Vente
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

                                                <th>Date  </th>

                                                <th> Produit </th>
                                                <th> Quantite </th>

                                                <th>Montant </th>
                                                <th>Benefice </th>



                                                <th class="text-end" style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        @foreach( $data as $vente )


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

                                                        <h4>{{ $vente['reference'] }}</h4>
                                                    </div>
                                                </td>


                                                <td><h6 class="mb-0">{{ $vente['date_vente'] }} </h6></td>
                                                <td><h6 class="mb-0">{{ $vente['produit'] }} </h6></td>
                                                <td><h6 class="mb-0">{{ $vente['quantite'] }} </h6></td>

                                                <td><h6 class="mb-0">{{ $vente['montant'] }} </h6></td>
                                                <td><h6 class="mb-0">{{ $vente['benefice'] }} </h6></td>







                                                <td>
                                                    <div class="d-flex">


                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 modifierVente" style="background-color: #1EA1F3; border: #1EA1F3" data-id="{{$vente['id']}}" title="Modifier " data-id="{{$vente['id']}}"><i class="fa fa-pencil"></i></a>


                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp supprimerVente" data-id="{{$vente['id']}}"  title="Supprimer "><i class="fa fa-trash"></i></a>




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

@include('admin.vente.modal')

@endsection



@section('js')


    <script src="{{asset('admin')}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/js/plugins-init/datatables.init.js"></script>


    <script src="{{asset('admin')}}/vendor/wow-master/dist/wow.min.js"></script>

    <script src="{{asset('admin/js/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {




            $("#lancerVente").click(function(event) {
                event.preventDefault();

                lancerVente()
            });

            $("#annulerVente").click(function(event) {
                event.preventDefault();

                annulerVente()
            });
            $(document).on('click', '#ajouterVente', function(event) {

                event.preventDefault();
                let id = $(this).data('id');

                event.preventDefault();
                validerVente()

            });




            //------------------------ Modification de la zone
            $(document).on('click', '.modifierVente', function() {

                let id = $(this).data('id');
                let url = "/ventes/modifier/" + id;


                $.get(url, function(data) {

                    console.log(data.result);

                    $('#defaultModalLabel').text('Modifier une vente    ');

                    let vente_modal = $('#addVente');

                    $(vente_modal).find('form').find('input[name="reference"]').val(data.vente.reference);
                    $(vente_modal).find('form').find('input[name="date_vente"]').val(data.vente.date_vente);
                    $(vente_modal).find('form').find('input[name="quantite"]').val(data.vente.quantite);
                    $(vente_modal).find('form').find('input[name="prix_unitaire"]').val(data.vente.prix_unitaire);
                    $(vente_modal).find('form').find('select[name="produit_id"]').val(data.vente.produit_id);




                    $('#idVente').val(data.vente.id);

                    $("#ajouterVente").hide();
                    $("#updateVente").show();

                    $(vente_modal).modal('toggle');

                }, 'json')



            });


            $(document).on('click', '.supprimerVente', function(event) {

                event.preventDefault();
                let id = $(this).data('id');

                deleteConfirmation(id)

            });




            $("#updateVente").click(function(event) {
                event.preventDefault();

                updateVente()
            });


            clearData();

        });



        function clearData() {

            $('#date_vente').val('');
            $('#quantite').val('');
            $('#prix_unitaire').val('');
            $('#produit_id').val('');





            let form = document.getElementById('form');
            $(form).find('span.error-text').text('');

            $("#ajouterVente").show();
            $("#updateVente").hide();

        }

        //------------------------ Valider la catégorie

        function validerVente() {

            let allValid = true;
            let quantite = parseInt($("#prix_unitaire_Vente").val(), 10);
            let produit_id = parseInt($("#prix_unitaire_Vente").val(), 10);
           let date_vente = $('#date_vente').val().trim();


            if (isNaN(quantite) || quantite === 0) {
                $('.quantite_error').text("La quantité    est obligatoire ");
                allValid = false;

            }


            if (isNaN(produit_id) || produit_id === 0) {
                $('.type_Vente_error').text("Le choix du produit   est obligatoire ");
                allValid = false;

            }


            if (date_vente === '') {
                $('.date_vente_error').text("La date de la  Vente      est obligatoire ");
                allValid = false;

            }


            if (allValid) {



                let form = document.getElementById('form');
                let formData = new FormData(form);


                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: "/ventes/save",
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
        function lancerVente() {

            clearData();

            $('#defaultModalLabel').text('Ajouter  une Vente   ');

            $('#addVente').modal('toggle');
        }


        //------------------------ Fermer  le popup d' ajout
        function annulerVente() {

            clearData();



            $('#addVente').modal('toggle');
        }

        //------------------------ Update de Vente
        function updateVente() {



            let allValid = true;

            let quantite = parseInt($("#prix_unitaire_Vente").val(), 10);
            let produit_id = parseInt($("#prix_unitaire_Vente").val(), 10);

            let date_vente = $('#date_vente').val().trim();



            if (isNaN(quantite) || quantite === 0) {
                $('.quantite_error').text("La quantité    est obligatoire ");
                allValid = false;

            }


            if (isNaN(produit_id) || produit_id === 0) {
                $('.type_Vente_error').text("Le choix du produit   est obligatoire ");
                allValid = false;

            }





            if (date_vente === '') {
                $('.date_vente_error').text("La date d Vente      est obligatoire ");
                allValid = false;

            }

            let id = $('#idVente').val();


            if (allValid) {

                let form = document.getElementById('form');
                let formData = new FormData(form);


            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: "/ventes/update/" + id,
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



        //------------------------ fonction de suppression de Vente

        function deleteConfirmation(id) {
            Swal.fire({
                title: "Voulez vous supprimer cette vente   ?",
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
                        url: "/ventes/delete/" + id,
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
