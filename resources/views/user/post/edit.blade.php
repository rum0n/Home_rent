@extends('frontEnd.master')

@section('banner')

@endsection

@section('mainContent')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-md-offset-3">

                @if($errors->all())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif


                {{--<form class="form-group" action="{{route('user.post.store')}}" method="post" enctype="multipart/form-data">--}}


                <form class="form-group" action="{{route('user.post.update',$post->id)}}" name="edit-form" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputTitle1">Title</label>
                        <input type="text" class="form-control" id="exampleInputTitle1" aria-describedby="emailHelp" placeholder="Enter Post Title" name="post_title" value="{{$post->post_title}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputCategory1">Category</label>
                        <select class="form-control" type="text" id="exampleInputCategory1" name="category_id">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputbedrooms1">Number of Bedroms</label>
                        <input type="number" class="form-control" id="exampleInputbedrooms1" aria-describedby="emailHelp" placeholder="Number of Bedroms" name="bedrooms" min="1" max="10" value="{{$post->bedrooms}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputbatherooms1">Number of Batherooms</label>
                        <input type="number" class="form-control" id="exampleInputbatherooms1" aria-describedby="emailHelp" placeholder="Number of Batherooms" name="batherooms" min="1" max="10" value="{{$post->batherooms}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputbalconies1">Number of Balconies</label>
                        <input type="number" class="form-control" id="exampleInputbalconies1" aria-describedby="emailHelp" placeholder="Number of Balconies" name="balconies" min="1" max="10" value="{{$post->balconies}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputrent1">Monthly Rent</label>
                        <input type="number" class="form-control" id="exampleInputrent1" aria-describedby="emailHelp" placeholder="Monthly Rent" name="monthly_rent" min="1000" max="80000" value="{{$post->monthly_rent}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputdes1">Description</label>
                        <textarea type="text" class="form-control" id="exampleInputdes1" aria-describedby="emailHelp" placeholder="Post Description" name="description">{{$post->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="searchmap">Address</label>
                        <input type="text" id="searchmap" class="form-control" name="address" placeholder="Enter Address" value="{{$post->address}}">
                        <div id="map-canvas"></div>
                    </div>

                    <div class="form-group">
                        {{-- <label for="lat">Lat</label> --}}
                        <input type="hidden" id="lat" class="form-control" name="lat" value="{{$post->lat}}">
                    </div>

                    <div class="form-group">
                        {{-- <label for="lng">Long</label> --}}
                        <input type="hidden" id="lng" class="form-control" name="lon" value="{{$post->lon}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputemail1">Email Address</label>
                        <input type="email" class="form-control" id="exampleInputemail1" aria-describedby="emailHelp" placeholder="Type Your Email Address" name="email" value="{{$post->email}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputmob1">Contact No.</label>
                        <input type="number" class="form-control" id="exampleInputmob1" aria-describedby="emailHelp" placeholder="Type Your Mobile Number" name="mobile_no" value="{{$post->mobile_no}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputpic1">Pictures</label>
                        <input type="file" class="default" id="exampleInputpic1" aria-describedby="emailHelp" name="post_picture[]" multiple>

                        <div class="mt-1">
                            @if ($post->post_picture != "")
                                @foreach(explode('|', $post->post_picture) as $x)
                                <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('frontEnd/postPic/'.$x)}}" alt="" class="img img-responsive img-thumbnail" width="100">
                                     <a href="{{ url('user/delete/'.$post->id.'/'.$x )}}" class="btn btn-danger btn-lg">Delete</a>
                                </div>
                               </div>
                                @endforeach
                                   

                                
                            @endif
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script type="text/javascript">
        document.forms['edit-form'].elements['category_id'].value = "{{ $post->category_id}}"
    </script>

    <!--------Js for google map---------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC76IzQwwADIxXY-UahZlMEGFQZLV-fInI&libraries=places" type="text/javascript"></script>

    <script>
        
//        var latitude = document.getElementById('lat').val();
//        var longitude = document.getElementById('lng').val();

        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat:24.8949,
                lng:91.8687
            },
            zoom:10,
            mapTypeId: 'roadmap'

        });
        var marker = new google.maps.Marker({
            position:{
                lat:24.8949,
                lng:91.8687
            },
            map:map,
            draggable:true

        });
        var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
        google.maps.event.addListener(searchBox,'places_changed',function(){
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i , place;
            for(i=0;place=places[i];i++){

                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);

            }
            map.fitBounds(bounds);
            map.setZoom(8);
        });
        google.maps.event.addListener(marker,'position_changed',function(){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();

            $('#lat').val(lat);
            $('#lng').val(lng);

            //        $('#searchmap').val(getPosition(lat,lng));

        });
    </script>

@endpush