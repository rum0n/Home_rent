@extends('frontEnd.master')

@section('title','House Rental Web')

@push('css')
        <!--styles for this page -->

@endpush

@section('banner')

@endsection

@section('mainContent')
    <section id="main-content">
        <section class="wrapper">
            <div class="container">
                <div class="properties-listing spacer">
                    @if($rows != 0)
                        <h2 class="center text-info">Showing Search results for...{{ $message }}</h2>
                        {{--<h2 class="center text-info">About {{ $rows }} result(s) found</h2>--}}
                    @else
                        <h2 class="center text-warning">Sorry no results found for...{{ $message }}</h2>
                    @endif
                    <div  class="row">
                        {{--  <div class="col-md-3">
                             All Category
                              @foreach($posts as $post)
                              <li><h3>$post->category->category_name</h3></li>
                              @endforeach
                         </div> --}}

                        <div class="col-md-8 col-md-offset-2" id="result">

                            @foreach($posts as $post)
                                <h2>Rent a {{ $post->category->category_name}}</h2>

                                <div class="properties">
                                    <div class="image-holder">

                                        @if ($post->post_picture != "")
                                            <?php $exit = 0; ?>
                                            @foreach(explode('|', $post->post_picture) as $x)
                                                {{--{{ $x }}--}}
                                                {{--<img src="{{ asset('frontEnd/postPic/'.$x)}}" alt="" class="img img-responsive img-thumbnail" width="100">--}}
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

    @endpush