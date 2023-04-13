@extends('admin.master')

@section('title','')


@push('css')

@endpush


@section('banner')

@endsection


@section('content')

    <section id="main-content">
        <section class="wrapper">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-panel">

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

                                <form action="{{route('admin.post.update',$post->id)}}" class="form-horizontal style-form" name="edit-form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="post_title" class="col-sm-2 col-sm-2 control-label">Post Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="post_title" name="post_title" value="{{$post->post_title}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-2 col-sm-2 control-label">Category</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" type="text" id="category_id" name="category_id">
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bedrooms" class="col-sm-2 col-sm-2 control-label">Number of Bedrooms</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bedrooms" name="bedrooms" value="{{$post->bedrooms}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="batherooms" class="col-sm-2 col-sm-2 control-label">Number of Batherooms</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="batherooms" name="batherooms" value="{{$post->batherooms}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="balconies" class="col-sm-2 col-sm-2 control-label">Number of Balconies</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="balconies" name="balconies" value="{{$post->balconies}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="monthly_rent" class="col-sm-2 col-sm-2 control-label">Monthly Rent</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="monthly_rent" name="monthly_rent" value="{{$post->monthly_rent}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_no" class="col-sm-2 col-sm-2 control-label">Mobile No.</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{$post->mobile_no}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 col-sm-2 control-label">Contact Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" value="{{$post->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="post_picture" class="col-sm-2 col-sm-2 control-label">Pictues</label>
                                        <div class="col-md-4">
                                            <input type="file" class="default" id="post_picture" name="post_picture[]" multiple />

                                            <div class="mt-2">
                                                @if ($post->post_picture != "")
                                                    @foreach(explode('|', $post->post_picture) as $x)
                                                        <img src="{{ asset('frontEnd/postPic/'.$x)}}" alt="" class="img img-responsive img-thumbnail" width="100">
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 col-sm-2 control-label">Description</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" id="description" name="description">{{$post->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-sm-2 col-sm-2 control-label">Address</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" id="address" name="address">{{$post->address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-theme" type="submit">Save</button>

                                            <a href="{{ route('admin.post.index')  }}" class="btn btn-theme04" type="button" >Cancel</a>
                                        </div>
                                    </div>

                                </form>
                                <script type="text/javascript">
                                    document.forms['edit-form'].elements['category_id'].value = "{{ $post->category_id}}"
                                </script>
                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection


@push('js')

@endpush