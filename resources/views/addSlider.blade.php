@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Add Slider</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Add Slider</li>
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
                                        Add New Slider
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
                                <form class="form-horizontal" method="POST" action="{{ route('newSlider') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
    <label for="title" class="control-label col-sm-3">Title:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="title" id="title"/>
        @error('title') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>

                                   
                                    <div class="form-group">
                                        <label for="image" class="control-label col-sm-3"> Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control-file" name="image"/>
                                            @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="control-label col-sm-3">Status:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select> 
                                            @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">Add Slide</button>
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
