@extends('backend.layouts.master')
@section('stylesheet')
@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Banner Create</h4>
            <form action="{{ route('banners.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Banner</h3>
                            </div>
                            <div class="card-body row">
                                <div class="form-group col-md-9">
                                    <label for="banner_title">Title</label>
                                    <input type="text" id="banner_title" class="form-control form-control-sm border-dark" name="banner_title" value="{{ old('banner_title')?old('banner_title'):'' }}">
                                    {{-- @if($errors->has('banner_title'))
                                    <span class="text-danger">
                                        {{ $errors->first('banner_title') }}
                                    </span>
                                    @endif --}}
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="banner_order">Order</label>
                                    <input type="number" id="banner_order" class="form-control form-control-sm border-dark" name="banner_order" value="{{ old('banner_order')?old('banner_order'):'' }}">
                                    {{-- @if($errors->has('banner_order'))
                                    <span class="text-danger">
                                        {{ $errors->first('banner_order') }}
                                    </span>
                                    @endif --}}
                                </div>
                                {{-- <div class="form-group col-md-9 ">
                                    <label for="banner_description">Description</label>
                                    <textarea class="form-control" name="banner_description" rows="5" style="resize: none;" id="banner_description">{{ old('banner_description') ? old('banner_description') : '' }}</textarea>
                                    @if($errors->has('banner_description'))
                                    <span class="text-danger">
                                        {{ $errors->first('banner_description') }}
                                    </span>
                                    @endif
                                </div> --}}

                                <div class="form-group col-md-9">
                                    <label for="banner_image">Image</label>
                                </div>
                                <div class="form-group col-md-9">
                                    <img src="{{ asset('assets/backend/images/logo.png') }}" alt="Banner Image" class="rounded" id="banner_image" width="80px">
                                </div>
                                <div class="form-group col-md-9">
                                    <input type="file" name="banner_image" onchange="document.getElementById('banner_image').src = window.URL.createObjectURL(this.files[0])" accept="image/*" class="form-control">
                                    {{-- @if($errors->has('banner_image'))
                                    <span class="text-danger">
                                        {{ $errors->first('banner_image') }}
                                    </span>
                                    @endif --}}
                                </div>

                                {{-- <div class="form-group col-md-9">
                                    <label for="banner_btn_text">Button Text</label>
                                    <input type="text" id="banner_btn_text" class="form-control" name="banner_btn_text" value="{{ old('banner_btn_text')?old('banner_btn_text'):'' }}">
                                    @if($errors->has('banner_btn_text'))
                                    <span class="text-danger">
                                        {{ $errors->first('banner_btn_text') }}
                                    </span>
                                    @endif
                                </div> --}}

                                {{-- <div class="form-group col-md-9">
                                    <label for="banner_btn_link">Button Link</label>
                                    <input type="text" id="banner_btn_link" class="form-control" name="banner_btn_link" value="{{ old('banner_btn_link')?old('banner_btn_link'):'' }}">
                                    @if($errors->has('banner_btn_link'))
                                    <span class="text-danger">
                                        {{ $errors->first('banner_btn_link') }}
                                    </span>
                                    @endif
                                </div> --}}
                            </div>

                            <div class="card-footer">
                                <div class="form-group col-md-9">
                                    <input type="submit" class="btn btn-primary" value="save">
                                    <a href="{{ route('banners.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>

                            <!-- /.card -->
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
                }
                , description: {
                    required: true
                }
            }
            , messages: {
                title: {
                    required: "Please enter a title"
                }
                , description: {
                    required: "Please enter a description"
                }
            }
            , errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

</script>

@endsection
