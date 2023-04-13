@extends('frontEnd.master')


@section('title','Single View')


@push('css')

@endpush


@section('banner')

@endsection


@section('mainContent')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-8 col-md-8 col-md-offset-2">

                <h2>{{ $post->post_title }}</h2>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="property-images">
                            <!-- Slider Starts -->
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators hidden-xs">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                    <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                                </ol>
                                <div class="carousel-inner">

                                    @if ($post->post_picture != "")

                                        @php
                                        $count = 0;
                                        @endphp

                                        @foreach(explode('|', $post->post_picture) as $x)

                                                <!-- Item 1 -->
                                        <div class="item {{($count == 0)?'active':''}}">
                                            <img src="{{ asset('frontEnd/postPic/'.$x)}}" class="properties" alt="properties" />
                                        </div>
                                        <!-- #Item 1 -->
                                        @php
                                        $count = $count + 1;
                                        @endphp

                                        @endforeach
                                    @endif

                                </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <!-- #Slider Ends -->

                        </div>

                        <div class="spacer"><h3><span class="glyphicon glyphicon-th-list"></span> Post Detail</h3>
                            <h4 class="house_details">{{ $post->description }}</h4>

                        </div>

                        <h3>Comments</h3>

                        {{--@include('frontEnd.inc.comments', ['comments' => $post->comments, 'post_id' => $post->id])--}}


                        <div class="display-comment">
                            @foreach($post->comments as $comment)

                                <strong class="text-primary">{{ $comment->user->name }}</strong>
                                <p>{{ $comment->body }}</p>

                                <div class="display-comment" style="margin-left:20px;">
                                    <h4>Replies</h4>
                                    @foreach($comment->replies as $reply)
                                        <strong class="text-primary">{{ $reply->user->name }}</strong>
                                        <p>{{ $reply->body }}</p>
                                    @endforeach

                                    <form method="post" action="{{ route('user.comment.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="body" class="form-control" />
                                            <input type="hidden" name="post_id" value="{{ $comment->post_id }}" />
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-warning" value="Reply" />
                                        </div>
                                    </form>
                                </div>

                            @endforeach
                        </div>

                        <form method="post" action="{{ route('user.comment.store') }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Add Comment" />
                            </div>
                        </form>

                    </div>

                    <div class="col-lg-4">
                        <div class="col-lg-12  col-sm-6">
                            <div class="property-info">
                                <div class="">
                                    <p class="price ">৳ {{ $post->monthly_rent }}</p>
                                    <h3 class="area "><span class="glyphicon glyphicon-map-marker"></span>Address</h3>
                                    <div class="house_details">
                                        <h4>{{$post->address}}</h4>
                                    </div>

                                    <div class="profile ">

                                        <h3><span class="glyphicon glyphicon-user"></span> Owner Details</h3>
                                        <h4 class="house_details">{{ $post->user->name }}</h4>
                                        <h4 class="house_details">Mobile: {{ $post->mobile_no }}</h4>
                                    </div>
                                </div>
                            </div>

                            <h3><span class="glyphicon glyphicon-home"></span> Availabilty</h3>
                            <div class="">
                                <div class="house_details">
                                    <h4>Bedrooms: <span>{{ $post->bedrooms }}</span></h4>
                                    <h4>Balconies: <span>{{ $post->balconies }}</span></h4>
                                    <h4>Bathrooms: <span>{{ $post->batherooms }}</span></h4>
                                    <h4>Kitchen: <span>1</span></h4>


                                    {{--<span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">{{ $post->bedrooms }}</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bathe Room">{{ $post->batherooms }}</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Balconies">{{ $post->balconies }}</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span>--}}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')

@endpush