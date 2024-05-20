@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Edit Service Category</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Edit Service Category</li>
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
                                        Edit Service Category
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('dashboard') }}" class="btn btn-info pull-right">All Categories</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form class="form-horizontal" method="POST" action="{{ route('updateCategory') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Category Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug" class="control-label col-sm-3">Category Slug:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $category->slug }}">
                                            @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="control-label col-sm-3">Category Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control-file" name="image">
                                            @if($category->image)
                                                <img src="{{ asset('images/categories/' . $category->image) }}" alt="Category Image" style="max-width: 100px;">
                                            @endif
                                            @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="control-label col-sm-3">Category Image:</label>
                                        <div class="col-sm-9">
                                        <select name="featured" id="featured" class="form-control">
            <option value="0" {{ $category->featured == '0' ? 'selected' : '' }}>No</option>
            <option value="1" {{ $category->featured == '1' ? 'selected' : '' }}>Yes</option>
        </select>
        @error('featured') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">Update Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // JavaScript to auto-generate slug
    document.getElementById('name').addEventListener('input', function() {
        var name = this.value;
        var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });
</script>

@endsection
