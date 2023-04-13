@extends('admin.master')

@section('content')

<section id="main-content">

    <section class="wrapper">
        <!-- row -->
        <div class="row mt">
            <div class="col-md-12">
            	 <section class="site-min-height">
                   
                    <div class="content-panel">
            	        <div id="edit" class="tab-pane">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 detailed">
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            @if(session('profile'))
                                                <div class="alert alert-success">
                                                    {{session('profile')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <h4 class="mb">Personal Information</h4>
                                    @if(Auth::user()->role_id == 1)
                                    <form role="form" class="form-horizontal" method="post" action="{{route('admin.Profile_edit')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Profile picture</label>
                                            <div class="col-lg-6">
                                                <input type="file" name="pic" id="exampleInputFile" class="file-pos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Name</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="name" id="c-name" class="form-control" value="{{ Auth::user()->name}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">User Name</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="username" id="lives-in" class="form-control" value="{{ Auth::user()->username}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">About</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="about" id="country" class="form-control" value="{{Auth::user()->about}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-6">
                                                <input type="email" name="email"  id="email" class="form-control" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-8 col-lg-offset-2 detailed">
                                                <button type="submit" class="btn btn-theme">Update Profile</button>
                                            </div>

                                        </div>

                                    </form>
                                    @else

                                @endif
                                </div>
                                <!-- /col-lg-8 -->
                            </div>
                            <!-- /row -->
                        </div>
                 </section>
            </div>
        </div>
    </section>

</section>



@endsection

@push('js')