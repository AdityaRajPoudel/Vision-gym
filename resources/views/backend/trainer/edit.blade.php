@extends('backend.layouts.master')
@section('stylesheet')

@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Trainer Update</h4>
            <form action="{{ route('trainer.update',$trainer->id) }}" id="trainer_form" class="forms-sample" method="Post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="card col-md-12">
                        {{-- <div class="card-header">
                            <label for="">Trainer Personal Detail</label>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-2">
                                    <label for="">Trainer Code</label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="trainer_code" value="{{ $trainer->trainer_code }}" readonly placeholder="">
                                </div>
                                <div class="form-group col-md-9">
                                    <img src="{{ $trainer->trainer_image }}" alt="Trainer Image" class="rounded" id="trainer_image" width="200px">
                                </div>
                                <div class="form-group col-md-9">
                                    <input type="file" name="trainer_image" onchange="document.getElementById('trainer_image').src = window.URL.createObjectURL(this.files[0])" accept="image/*" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="name" value="{{ $trainer->user->name }}" placeholder="Name">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm border-dark" id="" name="email" value="{{ $trainer->user->email }}"  placeholder="Email">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Change Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-sm border-dark" id="" name="password" placeholder="Password">
                                </div>
                                <div class="form-group col-4">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <div class="rounded ">
                                        <div class="d-flex row ml-1 mt-1">
                                            <div class="col">
                                                <input type="radio" id="male" name="gender" {{ $trainer->gender == 1 ? 'checked':'' }} value="1">
                                                <label for="single">Male</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" id="female" name="gender" {{ $trainer->gender == 0 ? 'checked':'' }} value="0">
                                                <label for="gender">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Contact <span class="text-danger">*</span></label>
                                    <input type="text" name="contact" value="{{ $trainer->contact }}" class="form-control form-control-sm border-dark" id="" placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{ $trainer->address }}" class="form-control form-control-sm border-dark" id="" placeholder="Location">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Join Date <span class="text-danger">*</span></label>
                                    <input type="date" name="join_date" value="{{ $trainer->join_date }}" class="form-control form-control-sm border-dark" id="" placeholder="Location">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Basic Salary<span class="text-danger">*</span></label>
                                    <input type="number" name="basic_salary" value="{{ $trainer->basic_salary }}" class="form-control form-control-sm border-dark" id="nepali-datepier" placeholder="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control form-control-sm border-dark">
                                        <option value="1" {{ $trainer->status == 1 ? 'selected':''}}>Active</option>
                                        <option value="0" {{ $trainer->status == 0 ? 'selected':''}}>InActive</option>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="exampleTextarea1">Discription</label>
                                    <textarea class="form-control border-dark" name="description" id="exampleTextarea1" rows="4">{{ $trainer->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
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
                    // digits: true // Only digits
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
                // password: {
                //     required: "Please enter a password",
                //     minlength: "Password must be at least 6 characters long"
                // },
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

