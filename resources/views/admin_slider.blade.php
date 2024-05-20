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
            <h1>All Slides </h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>All Slides </li>
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
                                        All Slides 
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('addSlider') }}" class="btn btn-info pull-right">Add new</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($slides as $slide)
                                        <tr>
                                            <td>{{ $slide->id }}</td>
                                            <td><img src="{{ asset('images/Sliders')}}/{{ $slide->image }}" width="60"/></td>
                                            <td>{{ $slide->title }}</td>
                                           
                                            <td>
                                                @if($slide->status)
                                                       Active
                                                @else
                                                       Inactive
                                                @endif
                                            </td>
                                           
                                            
                                            <td>
                                            <a href="{{ route('editSlide', ['id' => $slide->id]) }}"><i class="fa fa-edit fa-2x text-info"></i></a>

                                                <a href="#" onclick="confirmDelete({{ $slide->id }})"><i class="fa fa-times fa-2x text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $slides->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function confirmDelete(sliderId) {
        if (confirm('Are you sure you want to delete this slider?')) {
            // If user confirms, redirect to the delete route
            window.location.href = "{{ route('deleteSlider', ['id' => ':slider_id']) }}".replace(':slider_id', sliderId);
        }
    }
</script>


@endsection
