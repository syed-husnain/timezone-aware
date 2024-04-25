@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tasks</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Tasks</li>
        </ol>
    </nav>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="taskForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" class="form-control" name="name" type="text">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <input class="btn btn-primary" id="submit" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>

    <script>
        $(function() {
            'use strict';

            $.validator.setDefaults({
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let formData = new FormData(document.getElementById("taskForm"));

                    $("#submit").prop("disabled", true);

                    $.ajax({
                        url: "{{ route('tasks.store') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(response) {

                            // $('#successMsg').show();
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Created Successfully',
                                    confirmButtonText: 'Ok',
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ route('tasks.index') }}";

                                    } else if (result.isDenied) {
                                        Swal.fire('Changes are not saved', '',
                                            'info')
                                    }
                                })

                            }
                        },
                        error: function(response) {
                            $("#submit").prop("disabled", false);

                            errorsGet(response.responseJSON.errors);


                        },
                    });



                }
            });
            $(function() {
                // validate signup form on keyup and submit
                $("#taskForm").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3,
                            maxlength: 150
                        },
                        description: {
                            required: true,
                            minlength: 3,
                            maxlength: 250
                        },
                    },
                    messages: {
                        name: {
                            required: "Name field is required.",
                            minlength: "Name must consist of at least 3 characters"
                        },
                        description: {
                            required: "Description field is required.",
                            minlength: "Description must consist of at least 3 characters"
                        },
                    },
                    errorPlacement: function(error, element) {
                        error.addClass("invalid-feedback");

                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function(element, errorClass) {
                        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') !=
                            'radio') {
                            $(element).addClass("is-invalid").removeClass("is-valid");
                        }
                    },
                    unhighlight: function(element, errorClass) {
                        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') !=
                            'radio') {
                            $(element).addClass("is-valid").removeClass("is-invalid");
                        }
                    }
                });
            });

        });

        function errorsGet(errors) {
            $('span.invalid-feedback').remove();
            for (x in errors) {

                var formGroup = $('.errors[data-id="' + x + '"],input[name="' + x + '"],select[name="' + x +
                    '"],textarea[name="' + x + '"]').parent();

                for (item in errors[x]) {
                    console.log(item);
                    formGroup.append(' <span class="invalid-feedback d-block" role="alert"><strong>' + errors[x][item] +
                        '</strong></span>');
                }
            }
        }
    </script>
@endpush
