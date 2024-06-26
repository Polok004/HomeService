@extends('loggedlayout')

@section('content')
<style>
    nav svg {
        height: 20px;
    }

    nav .hidden {
        display: block !important;
    }
</style>

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Service Categories</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Service Categories</li>
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
                    <div class="col-md-12 profile1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        All Service Category
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('addService')}}" class="btn btn-info pull-right">Add new</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Featured</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($scatagories as $scatagory)
                                        <tr>
                                            <td>{{$scatagory->id}}</td>
                                            <td><img src="{{asset('images/categories')}}/{{$scatagory->image}}" width="60"/></td>
                                            <td>{{$scatagory->name}}</td>
                                            <td>{{$scatagory->slug}}</td>
                                            <td>
                                            @if($scatagory->featured)
                                                Yes
                                            @else
                                                No
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('editService', ['category_id' => $scatagory->id]) }}"><i class="fa fa-edit fa-2x text-info"></i></a>
                                                <a href="#" onclick="confirmDelete({{ $scatagory->id }})"><i class="fa fa-times fa-2x text-danger"></i></a>


                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$scatagories->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            
            window.location.href = "{{ route('deleteCategory', ['category_id' => ':category_id']) }}".replace(':category_id', categoryId);
        }
    }
</script>

@endsection
