@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Add Service Provider</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Add Service Provider</li>
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
                                        Add New Service Provider
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('SproviderDetails') }}" class="btn btn-info pull-right">All Service Providers</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form class="form-horizontal" method="POST" action="{{ route('storeSprovider') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3"> Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" id="name"/>
                                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
    <label for="phone" class="control-label col-sm-3">Phone:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="phone" id="phone"/>
        @error('phone') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>
<div class="form-group">
    <label for="email" class="control-label col-sm-3">Email:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="email" id="email"/>
        @error('email') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>
<div class="form-group">
    <label for="location" class="control-label col-sm-3">Location:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="location" id="location"/>
        @error('location') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>
<div class="form-group">
    <label for="salary" class="control-label col-sm-3">Salary:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="salary" id="salary"/>
        @error('salary') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>

                                    <div class="form-group">
    <label for="category" class="control-label col-sm-3">Category:</label>
    <div class="col-sm-9">
        <select name="category" id="category" class="form-control">
            <option value="">Select a category</option> <!-- Add an empty default option -->
            @foreach($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>

                                    <div class="form-group">
                                        <label for="image" class="control-label col-sm-3"> Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control-file" name="image"/>
                                            @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">Add Service Provider</button>
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
