@extends('backend.layouts.master')
@section('stylesheet')

@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Trainer Create</h4>
            <form action="{{ route('trainer.store') }}" id="trainer_form" class="forms-sample" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="card col-md-12">
                        {{-- <div class="card-header">
                            <label for="">Trainer Personal Detail</label>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-2">
                                    <label for="">Trainer Code</label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="trainer_code" value="{{ $trainerCode }}" readonly placeholder="">
                                </div>
                               
                                <div class="form-group col-6">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="name" placeholder="Name">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm border-dark" id="" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-sm border-dark" id="" name="password" placeholder="Password">
                                </div>
                                <div class="form-group col-4">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <div class="rounded ">
                                        <div class="d-flex row ml-1 mt-1">
                                            <div class="col">
                                                <input type="radio" id="male" name="gender" checked value="1">
                                                <label for="single">Male</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" id="female" name="gender" value="0">
                                                <label for="gender">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Contact <span class="text-danger">*</span></label>
                                    <input type="text" name="contact" class="form-control form-control-sm border-dark" id="" placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control form-control-sm border-dark" id="" placeholder="Location">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Join Date <span class="text-danger">*</span></label>
                                    <input type="date" name="join_date" value="{{ date('Y-m-d') }}" class="form-control form-control-sm border-dark" id="" placeholder="Location">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Basic Salary<span class="text-danger">*</span></label>
                                    <input type="number" name="basic_salary" class="form-control form-control-sm border-dark" id="nepali-datepier" placeholder="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control form-control-sm border-dark">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div> 
                                <div class="form-group col-4">
                                    <div class="form-group col-md-4">
                                        <label for="trainer_image">Image</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <img src="{{ asset('images/fallback-logo.png') }}" alt="Trainer Image" class="rounded" id="trainer_image" width="200px">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="file" name="trainer_image" onchange="document.getElementById('trainer_image').src = window.URL.createObjectURL(this.files[0])" accept="image/*" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Discription</label>
                                    <textarea class="form-control border-dark" name="description" id="exampleTextarea1" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="{{ route('trainer.index') }}" class="btn btn-danger ">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')   
<script>
    $(document).ready(function() {
        $('#trainer_form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6 // Example minimum password length
                },
                gender: {
                    required: true
                },
                contact: {
                    required: true,
                    digits: true // All digits
                },
                address: {
                    required: true
                },
                basic_salary: {
                    required: true,
                    digits: true // Only digits
                },
                // description: {
                //     required: true
                // },
                join_date: {
                    required: true,
                    date: true // Validate as date
                }

            },
            messages: {
                name: {
                    required: "Please enter your name"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 6 characters long"
                },
                gender: {
                    required: "Please select your gender"
                },
                contact: {
                    required: "Please enter your contact number",
                    digits: "Please enter only digits"
                },
                address: {
                    required: "Please enter your address"
                },
                basic_salary: {
                    required: "Please enter basic salary",
                    digits: "Please enter only digits"
                },
                // description: {
                //     required: "Please enter a description"
                // },
                join_date: {
                    required: "Please enter the join date",
                    date: "Please enter a valid date"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection

