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
            <h1>All Services Providers </h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>All Services Providers </li>
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
                                        All Service Provider
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('addSproviders') }}" class="btn btn-info pull-right">Add new </a>
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
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Loaction</th>
                                            <th>Category</th>
                                            <th>Salary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sproviders as $sprovider)
                                        <tr>
                                            <td>{{ $sprovider->id }}</td>
                                            <td><img src="{{ asset('images/Sproviders')}}/{{ $sprovider->image }}" width="60"/></td>
                                            <td>{{ $sprovider->name }}</td>
                                            <td>{{ $sprovider->email }}</td>
                                            <td>{{ $sprovider->phone }}</td>
                                            
                                            <td>{{ $sprovider->location }}</td>
                                            <td>{{ $sprovider->Service_Catagory}}</td>
                                            <td>{{ $sprovider->Salary }}</td>
                                            <td>
                                            <a href="{{ route('Sproviderprofile', ['id' => $sprovider->id]) }}">
    <i class="fa fa-user fa-2x text-primary"></i>
</a>
    

                                            <a href="{{ route('editSproviders', ['id' => $sprovider->id]) }}"><i class="fa fa-edit fa-2x text-info"></i></a>

                                            <a href="#" onclick="confirmDelete({{ $sprovider->id }})"><i class="fa fa-times fa-2x text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $sproviders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function confirmDelete(sproviderId) {
        if (confirm('Are you sure you want to delete this slider?')) {
            window.location.href = "{{ route('deleteSprovider', ['id' => ':sprovider_id']) }}".replace(':sprovider_id', sproviderId);
        }
    }
</script>

@endsection
