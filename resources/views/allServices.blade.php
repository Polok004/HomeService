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
            <h1>All Services </h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>All Services </li>
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
                                        All Service 
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('add AllService') }}" class="btn btn-info pull-right">Add new</a>
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
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Featured</th>
                                            <th>Category</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td><img src="{{ asset('images/services/thumbnails/' . $service->thumbnail) }}" width="60"/></td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->price }}</td>
                                            <td>
                                                @if($service->status)
                                                       Active
                                                @else
                                                       Inactive
                                                @endif
                                            </td>
                                            <td>
                                            @if($service->featured)
                                                Yes
                                            @else
                                                No
                                            @endif
                                            </td>
                                            <td>{{ $service->category_name }}</td>
                                            <td>{{ $service->created_at }}</td>
                                            <td>
                                                <a href="{{ route('editAllService', ['service_id' => $service->id]) }}"><i class="fa fa-edit fa-2x text-info"></i></a>
                                                <a href="#" onclick="confirmDelete({{ $service->id }})"><i class="fa fa-times fa-2x text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $services->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function confirmDelete(serviceId) {
        if (confirm('Are you sure you want to delete this service?')) {
            window.location.href = "{{ route('deleteService', ['service_id' => ':service_id']) }}".replace(':service_id', serviceId);
        }
    }
</script>

@endsection
