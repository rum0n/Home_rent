@extends('frontEnd.master')

@section('mainContent')
<section id="main-content">

    <section class="wrapper">
        <!-- row -->
        <div class="row mt">

            <div class="col-md-10 col-md-offset-1">
                <!-- sidebar -->
                <div class="col-md-2">
                    <aside>
                        <!-- sidebar menu start-->
                        <ul class="sidebar">
                            <div class="center"><a href="{{ route('user.user_profile') }}"><img src="{{asset('frontEnd/user_picture')}}/{{Auth::user()->pic}}" class="img-circle" width="80"></a></div>
                            <h2 class="">{{ Auth::user()->name }}</h2>
                            <li class="">
                                <a href="{{ route('user.dashboard') }}">
                                <i class="fa fa-user-o"></i><span> Dashboard</span>
                            </a>
                            </li>

                            <li class="">
                            <a href="{{ route('user.post.index') }}">
                                <i class="fa fa-user-o"></i><span> My Houses</span>
                            </a>
                            </li>
                            <li class="">
                            <a href="{{ route('user.user_profile') }}">
                                <i class="fa fa-edit"></i><span> Edit profile</span>
                            </a>
                            </li>


                        </ul>
                        <!-- sidebar menu end-->
                    </aside>
                </div>
                <!-- sidebar ends -->

                <!-- main-content -->
                <div class="col-md-10">
                    <div id="contact" class="tab-pane">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 ">

                                <div class="col-md-8 col-md-offset-2 user-profile"><h3><u>User information</u></h3><br></div>
                                <div class="col-md-8 col-md-offset-2 user-profile-body">

                                    <p>Username : {{Auth::user()->username}}</p>
                                    <p>Email: {{Auth::user()->email}}</p>
                                    <p>About: {{Auth::user()->about}}</p>
                                    <p>Address: N/A</p>
                                    <p>Mobile: N/A</p>

                                </div>

                            </div>
                            <!-- /col-md-6 -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
                <!-- main-content ends -->

            </div>

        </div>
    </section>

</section>

@endsection

@push('js')

    <!-- Script for Deleting -->
    <script type="text/javascript">
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-2',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                    // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                )
            }
        })
        }

    </script>

@endpush