@extends('backend.layouts.master')
@section('stylesheet')
<style>
  
</style>
@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Registration Create</h4>
            <form action="{{ route('user.register.store') }}" id="member_form" class="forms-sample" method="post">
                @csrf
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-header">
                            <label for="">User Personal Detail</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-2">
                                    <label for="">Regerstation Code</label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="reg_code" value="{{ $regCode }}" readonly placeholder="">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="name" placeholder="Name">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm border-dark" id="" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-sm border-dark" id="" name="password" placeholder="Password">
                                </div>
                                <div class="form-group col-3">
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
                                <div class="form-group col-md-3">
                                    <label for="">Contact <span class="text-danger">*</span></label>
                                    <input type="text" name="contact" class="form-control form-control-sm border-dark" id="" placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control form-control-sm border-dark" id="" placeholder="Location">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Age (min 15 yrs) <span class="text-danger">*</span></label>
                                    <input type="number" name="age" class="form-control form-control-sm border-dark" value="15" min="15" id="nepali-datepicker" placeholder="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Current Weight (kg) </label>
                                    <div class="input-group">
                                        <input type="number" name="current_weight" id="" class="form-control form-control-sm border-dark" value="0" min="0">
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Date Of Registration <span class="text-danger">*</span></label>
                                    <input type="date" name="reg_date" id="date_of_register" value="{{ date('Y-m-d') }}" class="form-control form-control-sm border-dark" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="form-group">
                        <label for="exampleTextarea1">Discription</label>
                        <textarea class="form-control border-dark" name="description" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        // Add form validation rules
        $("#member_form").validate({
            rules: {
                name: "required"
                , email: {
                    required: true
                    , email: true
                }
                , password: "required"
                , gender: "required"
                , contact: "required"
                , address: "required"
                , age: {
                    required: true
                    , min: 15
                }
                , plan_id: "required"
                , gym_time: "required"
                , date_of_register: "required"
                , selected_category: "required"
                , discount: {
                    required: true
                    , min: 0
                }
            }
            , messages: {
                name: "Please enter your name"
                , email: {
                    required: "Please enter your email address"
                    , email: "Please enter a valid email address"
                }
                , password: "Please enter a password"
                , gender: "Please select your gender"
                , contact: "Please enter your contact number"
                , address: "Please enter your address"
                , age: {
                    required: "Please enter your age"
                    , min: "Minimum age must be 15"
                }
                , plan_id: "Please select a plan"
                , gym_time: "Please select gym time"
                , date_of_register: "Please select date of registration"
                , selected_category: "Please select a service"
                , discount: {
                    required: "Please enter discount"
                    , min: "Discount cannot be negative"
                }
            }
            , errorElement: "span"
            , errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            }
        });
    });

</script>
@endsection
