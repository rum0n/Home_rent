@extends('admin.master')

@section('content')

<section id="main-content">
    <section class="wrapper">
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <tr>
                            <th>Title</th><td>{{ $post->post_title }}</td>
                        </tr>
                        <tr>
                            <th>Category</th><td>{{ $post->category->category_name}}</td>
                        </tr>
                        <tr>
                            <th>Bedrooms</th><td>{{ $post->bedrooms }}</td>
                        </tr>
                        <tr>
                            <th>Batherooms</th><td>{{ $post->batherooms }}</td>
                        </tr>
                        <tr>
                            <th>Balconies</th><td>{{ $post->balconies }}</td>
                        </tr>
                        <tr>
                            <th>Monthly Rent</th><td>{{ $post->monthly_rent }}</td>
                        </tr>

                        <tr>
                            <th>Pictures</th>
                            @if ($post->post_picture != "")
                                <td>
                                    @foreach(explode('|', $post->post_picture) as $x)

                                        <img src="{{ asset('frontEnd/postPic/'.$x)}}" alt="" class="img img-responsive img-thumbnail" width="100">

                                    @endforeach
                                </td>
                            @endif
                        </tr>

                        <tr>
                            <th>Description</th><td>{{ $post->description }}</td>
                        </tr>
                        <tr>
                            <th>Address</th><td>{{ $post->address }}</td>
                        </tr>
                        <tr>
                            <th>Email</th><td>{{ $post->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th><td>{{ $post->mobile_no }}</td>
                        </tr>
                        <tr>
                            <th>Status</th><td>{{ ($post->is_approved==1)?'Approved':'Not Approve' }}</td>
                        </tr>

                    </table>

                    <center>

                        {{--<form class="form-horizontal style-form" action="{{ route('admin.post.destroy',$post->id) }}" method="POST">--}}
                            {{--<a href="{{ route('admin.post.edit',$post->id )}}" class="btn btn-primary btn-sm">Edit</a>--}}

                            {{--@csrf--}}
                            {{--@method('DELETE')--}}
                            {{--<button class="btn btn-danger btn-sm">Delete</button>--}}
                        {{--</form>--}}

                    </center>

                </div>
                <!-- /content-panel -->
            </div>
        </div>
    </section>
</section>

@endsection