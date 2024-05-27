@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Add Service</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Add Service</li>
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
                                        Add New Service
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('allServices') }}" class="btn btn-info pull-right">All Services</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form class="form-horizontal" method="POST" action="{{ route('newService') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Service Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" id="name"/>
                                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug" class="control-label col-sm-3">Service Slug:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="slug" id="slug" readonly/>
                                            @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tagline" class="control-label col-sm-3">Tagline:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="tagline" id="tagline"/>
                                            @error('tagline') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
    <label for="category" class="control-label col-sm-3">Category:</label>
    <div class="col-sm-9">
        <select name="category" id="category" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>
                                    <div class="form-group">
                                        <label for="price" class="control-label col-sm-3">Price:</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="price" id="price"/>
                                            @error('price') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount" class="control-label col-sm-3">Discount:</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="discount" id="discount"/>
                                            @error('discount') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_type" class="control-label col-sm-3">Discount Type:</label>
                                        <div class="col-sm-9">
                                            <select name="discount_type" id="discount_type" class="form-control">
                                                <option value="fixed">Fixed</option>
                                                <option value="percent">Percent</option>
                                            </select>
                                            @error('discount_type') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="control-label col-sm-3">Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control-file" name="image" id="image"/>
                                            @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnail" class="control-label col-sm-3">Thumbnail:</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control-file" name="thumbnail" id="thumbnail"/>
                                            @error('thumbnail') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="control-label col-sm-3">Description:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" id="description"></textarea>
                                            @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inclusion" class="control-label col-sm-3">Inclusion:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="inclusion" id="inclusion"></textarea>
                                            @error('inclusion') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exclusion" class="control-label col-sm-3">Exclusion:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="exclusion" id="exclusion"></textarea>
                                            @error('exclusion') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="control-label col-sm-3">Status:</label>
                                        <div class="col-sm-9">
                                            <input type="checkbox" class="form-control" name="status" id="status" value="1" checked>
                                            @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">Add Service</button>
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
   
    document.getElementById('name').addEventListener('input', function() {
        var name = this.value;
        var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });
</script>

@endsection
