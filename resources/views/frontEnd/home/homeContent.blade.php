@extends('frontEnd.master')

@section('title','House Rental Web')

@push('css')
    <!--styles for this page -->

@endpush

@section('banner')
    <div class="">
        <div id="slider" class="sl-slider-wrapper">

            <div class="sl-slider">

                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-1"></div>
                        {{--<h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>--}}
                        {{--<blockquote>--}}
                            {{--<p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>--}}
                            {{--<p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>--}}
                            {{--<cite>$ 20,000,000</cite>--}}
                        {{--</blockquote>--}}
                    </div>
                </div>

                <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-2"></div>
                        {{--<h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>--}}
                        {{--<blockquote>--}}
                            {{--<p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>--}}
                            {{--<p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>--}}
                            {{--<cite>$ 20,000,000</cite>--}}
                        {{--</blockquote>--}}
                    </div>
                </div>

                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-3"></div>
                        {{--<h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>--}}
                        {{--<blockquote>--}}
                            {{--<p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>--}}
                            {{--<p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>--}}
                            {{--<cite>$ 20,000,000</cite>--}}
                        {{--</blockquote>--}}
                    </div>
                </div>

                <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-4"></div>
                        {{--<h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>--}}
                        {{--<blockquote>--}}
                            {{--<p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>--}}
                            {{--<p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>--}}
                            {{--<cite>$ 20,000,000</cite>--}}
                        {{--</blockquote>--}}
                    </div>
                </div>

                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-5"></div>
                        {{--<h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>--}}
                        {{--<blockquote>--}}
                            {{--<p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>--}}
                            {{--<p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>--}}
                            {{--<cite>$ 20,000,000</cite>--}}
                        {{--</blockquote>--}}
                    </div>
                </div>
            </div><!-- /sl-slider -->



            <nav id="nav-dots" class="nav-dots">
                <span class="nav-dot-current"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </nav>

        </div><!-- /slider-wrapper -->
    </div>

    {{--<div class="banner-search">--}}
        {{--<div class="container">--}}
            {{----}}
        {{--</div>--}}
    {{--</div>--}}

@endsection

@section('mainContent')
<section id="main-content">
    <section class="wrapper">
        <div class="container">
            <div class="properties-listing spacer">

               <h2 class="center">Featured Properties</h2>

                @if(Session::has('no_match'))
                    <div class="alert alert-info"><span class=""></span><em>{{ Session::get('no_match') }}</em></div>
                @endif

                <div  class="row">
                       {{--  <div class="col-md-3">
                            All Category
                             @foreach($posts as $post)
                             <li><h3>$post->category->category_name</h3></li>
                             @endforeach
                        </div> --}}

                    <div class="col-md-8" id="result">

                        @foreach($posts as $post)
                            <h2>Rent a {{ $post->category->category_name}}</h2>
                            <h4 style="color: blue;">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</h4>

                            <div class="properties">
                                <div class="image-holder">

                                    @if ($post->post_picture != "")
                                        <?php $exit = 0; ?>
                                        @foreach(explode('|', $post->post_picture) as $x)

                                            <img src="{{ asset('frontEnd/postPic/'.$x)}}" class="img img-responsive" alt="" width="700" height="300" />
                                            <?php $exit = $exit+1; ?>

                                            @if($exit == 1)
                                                @break
                                            @endif

                                        @endforeach
                                    @endif

                                    {{-- <div class="status sold">Sold</div> --}}
                                </div>
                                <span><a href="{{ route('single_post',$post->id) }}">{{ $post->post_title }}</a></span>
                                <p class=""><h3>Monthly Rent: ৳ {{ $post->monthly_rent }}</h3></p>
                                <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">{{ $post->bedrooms }}</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bath Room">{{ $post->batherooms }}</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Balconies">{{ $post->balconies }}</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span></div>
                                <a class="btn btn-primary" href="{{ route('single_post',$post->id) }}">View Details</a>
                            </div>
                        @endforeach
                            <center>{{ $posts->links() }}</center>
                    </div>


                    <div class="col-md-4 search">
                        <h3>Search</h3>
                        <form action="{{ route('search') }}" method="get">
                            @csrf
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                            <button class="btn btn-success">Search</button>
                        </form>

                        <div class="search-form"><h4></h4>
                            <div class="row">
                                <form action="{{ route('filter') }}" method="get">
                                    <div class="col-lg-5">
                                        <select class="form-control" name="address">
                                            <option>Select Address</option>
                                            <option value="Tilagor">Tilagor</option>
                                            <option value="Shibgonj">Shibgonj</option>
                                            <option value="Uposhohor">Uposhohor</option>
                                            <option value="Bondhor">Bondhor</option>
                                            <option value="Zindabazar">Zindabazar</option>
                                            <option value="Lamabazar">Lamabazar</option>
                                            <option value="Amborkhana">Amborkhana</option>
                                            <option value="Shahi Eidgah">Shahi Eidgah</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-7">
                                        <select class="form-control" name="monthly_rent">
                                            <option>Monthly Rent TK</option>
                                            <option value="5000">5000</option>
                                            <option value="10000">10000</option>
                                            <option value="15000">15000</option>
                                            <option value="20000">20000</option>
                                            <option value="25000">25000</option>
                                            <option value="30000">30000</option>
                                            <option value="35000">35000</option>
                                            <option value="40000">40000</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Find Now</button>
                                </form>
                            </div>


                        </div>

                        <div class="spacer">

                            <div class="recommended">
                                <h3>Recent Houses</h3>

                                <div id="myCarousel" class="carousel slide">
                                    {{--<span class="col-md-6 col-md-offset-3">--}}
                                    <ol class="carousel-indicators">

                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>

                                    </ol>
                                    {{--</span>--}}
                                            <!-- Carousel items -->

                                    <div class="carousel-inner">
                                        @php
                                        $count = 0;
                                        @endphp

                                        @foreach($recent_posts as $r_post)
                                            <div class="item {{($count == 0)?'active':''}}">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        @if ($r_post->post_picture != "")
                                                            <?php $exit = 0; ?>
                                                            @foreach(explode('|', $r_post->post_picture) as $x)

                                                                <img src="{{ asset('frontEnd/postPic/'.$x)}}" class="img-responsive" alt="Post Picture"/>
                                                                <?php $exit = $exit+1; ?>

                                                                @if($exit == 1)
                                                                    @break
                                                                @endif

                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h5><a href="{{ route('single_post',$r_post->id) }}">{{ $r_post->post_title }}</a></h5>
                                                        <p class="price"><h3> ৳ {{ $post->monthly_rent }}</h3></p>
                                                        <a class="more" href="{{ route('single_post',$post->id) }}">More Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                            $count = $count + 1;
                                            @endphp
                                        @endforeach
                                        {{--<div class="item">--}}
                                        {{--<div class="row">--}}
                                        {{--<div class="col-lg-4"><img src="{{ asset('frontEnd/images') }}/properties/2.jpg" class="img-responsive" alt="properties"/></div>--}}
                                        {{--<div class="col-lg-8">--}}
                                        {{--<h5><a href="property-detail.php">Integer sed porta quam</a></h5>--}}
                                        {{--<p class="price">$300,000</p>--}}
                                        {{--<a href="property-detail.php" class="more">More Detail</a> </div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
            </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('js')
    <!--js for this page -->
    <script>
        window.onscroll = function() {myFunction()};

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>

    {{--<!--Js for Ajax search -->--}}
    {{--<script type="text/javascript">--}}

        {{--$('#search').on('keyup',function(){--}}

            {{--$value=$(this).val();--}}

            {{--$.ajax({--}}
                {{--type : 'get',--}}
                {{--url : 'search',--}}
                {{--data:{'search':$value},--}}
                {{--success:function(data){--}}
                    {{--$('#result').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--})--}}
    {{--</script>--}}

    {{--<script type="text/javascript">--}}
        {{--$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });--}}
    {{--</script>--}}


@endpush