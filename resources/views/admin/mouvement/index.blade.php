
@extends('layout.app')

@section('title')

    Cantine | Mouvements de stocks

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
                                        <button type="button" class="btn btn-primary" id="lancerMouvement">
                                         + Mouvement de stocks
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

                                                <th>Magasin </th>
                                                <th>Type  </th>



                                                <th class="text-end" style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        @foreach( $data as $mouvement )


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

                                                        <h4>{{ $mouvement['reference'] }}</h4>
                                                    </div>
                                                </td>


                                                <td><h6 class="mb-0">{{ $mouvement['date_mouvement'] }} </h6></td>
                                                <td><h6 class="mb-0">{{ $mouvement['produit'] }} </h6></td>
                                                <td><h6 class="mb-0">{{ $mouvement['quantite'] }} </h6></td>

                                                <td><h6 class="mb-0">{{ $mouvement['magasin'] }} </h6></td>
                                                <td><h6 class="mb-0">{{ $mouvement['type_mouvement'] }} </h6></td>







                                                <td>
                                                    <div class="d-flex">


                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 modifierMouvement" style="background-color: #1EA1F3; border: #1EA1F3" data-id="{{$mouvement['id']}}" title="Modifier " data-id="{{$mouvement['id']}}"><i class="fa fa-pencil"></i></a>


                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp supprimerMouvement" data-id="{{$mouvement['id']}}"  title="Supprimer "><i class="fa fa-trash"></i></a>




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

@include('admin.mouvement.modal')

@endsection



@section('js')


    <script src="{{asset('admin')}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/js/plugins-init/datatables.init.js"></script>


    <script src="{{asset('admin')}}/vendor/wow-master/dist/wow.min.js"></script>

    <script src="{{asset('admin/js/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {




            $("#lancerMouvement").click(function(event) {
                event.preventDefault();

                lancerMouvement()
            });

            $("#annulerMouvement").click(function(event) {
                event.preventDefault();

                annulerMouvement()
            });
            $(document).on('click', '#ajouterMouvement', function(event) {

                event.preventDefault();
                let id = $(this).data('id');

                event.preventDefault();
                validerMouvement()

            });




            //------------------------ Modification de la zone
            $(document).on('click', '.modifierMouvement', function() {

                let id = $(this).data('id');
                let url = "/mouvements/modifier/" + id;


                $.get(url, function(data) {

                    console.log(data.result);

                    $('#defaultModalLabel').text('Modifier une Mouvement    ');

                    let mouvement_modal = $('#addMouvement');

                    $(mouvement_modal).find('form').find('input[name="reference"]').val(data.mouvement.reference);
                    $(mouvement_modal).find('form').find('input[name="date_mouvement"]').val(data.mouvement.date_mouvement);
                    $(mouvement_modal).find('form').find('input[name="quantite"]').val(data.mouvement.quantite);
                    $(mouvement_modal).find('form').find('select[name="produit_id"]').val(data.mouvement.produit_id);
                    $(mouvement_modal).find('form').find('select[name="magasin_id"]').val(data.mouvement.magasin_id);
                    $(mouvement_modal).find('form').find('select[name="type_mouvement"]').val(data.mouvement.type_mouvement);




                    $('#idMouvement').val(data.mouvement.id);

                    $("#ajouterMouvement").hide();
                    $("#updateMouvement").show();

                    $(mouvement_modal).modal('toggle');

                }, 'json')



            });


            $(document).on('click', '.supprimerMouvement', function(event) {

                event.preventDefault();
                let id = $(this).data('id');

                deleteConfirmation(id)

            });




            $("#updateMouvement").click(function(event) {
                event.preventDefault();

                updateMouvement()
            });


            clearData();

        });



        function clearData() {

            $('#date_mouvement').val('');
            $('#quantite').val('');
            $('#prix_unitaire').val('');
            $('#produit_id').val('');
            $('#type_mouvement').val('');
            $('#magasin_id').val('');





            let form = document.getElementById('form');
            $(form).find('span.error-text').text('');

            $("#ajouterMouvement").show();
            $("#updateMouvement").hide();

        }

        //------------------------ Valider la catégorie

        function validerMouvement() {

            let allValid = true;

            let quantite = parseInt($("#quantite").val(), 10);
            let produit_id = parseInt($("#produit_id").val(), 10);
            let magasin_id = parseInt($("#magasin_id").val(), 10);
            let type_mouvement = parseInt($("#type_mouvement").val(), 10);
           let date_mouvement = $('#date_mouvement').val().trim();


            if (isNaN(quantite) || quantite === 0) {
                $('.quantite_error').text("La quantité    est obligatoire ");
                allValid = false;

            }


            if (isNaN(produit_id) || produit_id === 0) {
                $('.produit_id_error').text("Le choix du produit   est obligatoire ");
                allValid = false;

            }

            if (isNaN(magasin_id) || magasin_id === 0) {
                $('.magasin_id_error').text("Le choix du magasin   est obligatoire ");
                allValid = false;

            }


            if (isNaN(type_mouvement) || type_mouvement === 0) {
                $('.type_mouvement_error').text("Le type de mouvement    est obligatoire ");
                allValid = false;

            }


            if (date_mouvement === '') {
                $('.date_mouvement_error').text("La date de la  Mouvement      est obligatoire ");
                allValid = false;

            }


            if (allValid) {



                let form = document.getElementById('form');
                let formData = new FormData(form);


                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: "/mouvements/save",
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
        function lancerMouvement() {

            clearData();

            $('#defaultModalLabel').text('Ajouter  un mouvement de stocks   ');

            $('#addMouvement').modal('toggle');
        }


        //------------------------ Fermer  le popup d' ajout
        function annulerMouvement() {

            clearData();



            $('#addMouvement').modal('toggle');
        }

        //------------------------ Update de Mouvement
        function updateMouvement() {



            let allValid = true;

            let quantite = parseInt($("#quantite").val(), 10);
            let produit_id = parseInt($("#produit_id").val(), 10);
            let magasin_id = parseInt($("#magasin_id").val(), 10);
            let type_mouvement = parseInt($("#type_mouvement").val(), 10);
           let date_mouvement = $('#date_mouvement').val().trim();


            if (isNaN(quantite) || quantite === 0) {
                $('.quantite_error').text("La quantité    est obligatoire ");
                allValid = false;

            }


            if (isNaN(produit_id) || produit_id === 0) {
                $('.produit_id_error').text("Le choix du produit   est obligatoire ");
                allValid = false;

            }

            if (isNaN(magasin_id) || magasin_id === 0) {
                $('.magasin_id_error').text("Le choix du magasin   est obligatoire ");
                allValid = false;

            }


            if (isNaN(type_mouvement) || type_mouvement === 0) {
                $('.type_mouvement_error').text("Le type de mouvement    est obligatoire ");
                allValid = false;

            }


            if (date_mouvement === '') {
                $('.date_mouvement_error').text("La date de la  Mouvement      est obligatoire ");
                allValid = false;

            }


            let id = $('#idMouvement').val();


            if (allValid) {

                let form = document.getElementById('form');
                let formData = new FormData(form);


            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: "/mouvements/update/" + id,
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



        //------------------------ fonction de suppression de Mouvement

        function deleteConfirmation(id) {
            Swal.fire({
                title: "Voulez vous supprimer cette Mouvement   ?",
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
                        url: "/mouvements/delete/" + id,
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
