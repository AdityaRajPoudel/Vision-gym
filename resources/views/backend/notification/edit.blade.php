@extends('backend.layouts.master')
@section('stylesheet')
@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Announcement Update</h4>
            <form action="{{ route('announcement.update',$announcement->id) }}" id="announcement_form" class="forms-sample" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-header">
                            <label for="">Announcement Detail</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="" >Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="title" value="{{ $announcement->title }}"  placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Discription <span class="text-danger">*</span></label>
                                    <textarea class="form-control border-dark" name="description" id="exampleTextarea1" rows="4">{{ $announcement->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="justify-content-around">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ route('announcement.index') }}" class="btn btn-danger ">Cancel</a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#announcement_form').validate({
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter a title"
                },
                description: {
                    required: "Please enter a description"
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
