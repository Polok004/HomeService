@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Edit Slider</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Edit Slider</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="content-central">
    <div class="content_info">
        <div class="paddings-mini">
            <div class="container">
                <div class="row portfolioContainer">
                    <div class="col-md-8 col-md-offset-2 profile1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        Edit Slider
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin_slider') }}" class="btn btn-info pull-right">All Slides</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form class="form-horizontal" method="POST" action="{{ route('updateSlider') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                                    <div class="form-group">
                                        <label for="title" class="control-label col-sm-3">Title:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="title" id="title" value="{{ $slider->title }}">
                                            @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="control-label col-sm-3">Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control-file" name="image">
                                            @if($slider->image)
                                                <img src="{{ asset('images/Sliders/' . $slider->image) }}" alt="Slider Image" style="max-width: 100px;">
                                            @endif
                                            @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="control-label col-sm-3">Status:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" {{ $slider->status ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ !$slider->status ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">Update Slider</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
