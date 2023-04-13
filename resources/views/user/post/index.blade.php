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

                        <div class="row">
                            <div class="col-md-12 col-lg-12">

                                <div class="content-panel">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active">
                                                <a data-toggle="tab" href="#total_post">Total Post</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#approved_post">Accepted Post</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#pending_post">Pending Post</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#rejected_post">Rejected Post</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <!-- /panel-heading -->
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="total_post" class="tab-pane active">
                                                <!-- row -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                @if(session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{session('success')}}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <table class="table table-striped table-advance table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>S.I</th>
                                                                <th class="hidden-phone">Title</th>
                                                                <th class="hidden-phone">Category</th>
                                                                <th class="hidden-phone">Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse( $posts as $post )
                                                                <tr>
                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                    <td>
                                                                        {{ $post->post_title }}
                                                                    </td>
                                                                    <td>{{ $post->category->category_name }}</td>
                                                                    <td>
                                                                        {{--<span class="btn-{{($post->is_approved==1)?'success':'danger'}} btn-sm">{{ ($post->is_approved==1)?'Approved':'Not Approved' }}</span>--}}
                                                                        @if($post->is_approved==0)
                                                                            <span class="btn btn-danger">Rejected</span>
                                                                        @elseif($post->is_approved==1)
                                                                            <span class="btn btn-warning">Pending</span>
                                                                        @else
                                                                            <span class="btn-success btn-sm">Accepted</span>
                                                                        @endif

                                                                    </td>

                                                                    <td>

                                                                        <a href="{{ route('user.post.show',$post->id )}}" class="btn task-config-btn btn-lg"><i class="fa fa-eye" title="View"></i></a>
                                                                        <a href="{{ route('user.post.edit',$post->id )}}" class="btn btn-clear-g btn-lg"><i class="fa fa-pencil" title="Edit"></i></a>

                                                                        <button onclick="deletePost({{ $post->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></button>

                                                                        <form id="delete-form-{{ $post->id }}" class="form-horizontal" action="{{ route('user.post.destroy',$post->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    </td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="text-center" colspan="5"><h3 class="text-danger">You have no Post</h3></td>
                                                                </tr>
                                                            @endforelse

                                                            </tbody>
                                                        </table>
                                                        <center>{{ $posts->links() }}</center>
                                                    </div>
                                                    <!-- /col-md-12 -->
                                                </div>
                                                <!-- /row -->
                                                <!-- /OVERVIEW -->
                                            </div>
                                            <!-- /tab-pane -->
                                            <div id="approved_post" class="tab-pane">
                                                <!-- row -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                @if(session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{session('success')}}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <table class="table table-striped table-advance table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>S.I</th>
                                                                <th class="hidden-phone">Title</th>
                                                                <th class="hidden-phone">Category</th>
                                                                <th class="hidden-phone">Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse( $post_approve as $post )
                                                                <tr>
                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                    <td>
                                                                        {{ $post->post_title }}
                                                                    </td>
                                                                    <td>{{ $post->category->category_name }}</td>
                                                                    <td>
                                                                        <span class="btn-success btn-sm">Accepted</span>
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{ route('user.post.show',$post->id )}}" class="btn task-config-btn btn-lg"><i class="fa fa-eye" title="View"></i></a>
                                                                        <a href="{{ route('user.post.edit',$post->id )}}" class="btn btn-clear-g btn-lg"><i class="fa fa-pencil" title="Edit"></i></a>

                                                                        <button onclick="deletePost({{ $post->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></button>

                                                                        <form id="delete-form-{{ $post->id }}" class="form-horizontal" action="{{ route('user.post.destroy',$post->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>

                                                                    </td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="text-center" colspan="5"><h3 class="text-danger">You have no Post</h3></td>
                                                                </tr>
                                                            @endforelse

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <!-- /col-md-12 -->
                                                </div>
                                                <!-- /row -->
                                                <!-- /OVERVIEW -->
                                            </div>
                                            <!-- /tab-pane -->
                                            <div id="pending_post" class="tab-pane">
                                                <!-- row -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                @if(session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{session('success')}}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <table class="table table-striped table-advance table-hover table-responsive">
                                                            <thead>
                                                            <tr>
                                                                <th>S.I</th>
                                                                <th class="hidden-phone">Title</th>
                                                                <th class="hidden-phone">Category</th>
                                                                <th class="hidden-phone">Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse( $pending_post as $post )
                                                                <tr>
                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                    <td>
                                                                        {{ $post->post_title }}
                                                                    </td>
                                                                    <td>{{ $post->category->category_name }}</td>
                                                                    <td>
                                                                        <span class="btn btn-warning btn-sm">Pending</span>
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{ route('user.post.show',$post->id )}}" class="btn task-config-btn btn-lg"><i class="fa fa-eye" title="View"></i></a>
                                                                        <a href="{{ route('user.post.edit',$post->id )}}" class="btn btn-clear-g btn-lg"><i class="fa fa-pencil" title="Edit"></i></a>

                                                                        <button onclick="deletePost({{ $post->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></button>

                                                                        <form id="delete-form-{{ $post->id }}" class="form-horizontal" action="{{ route('user.post.destroy',$post->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>

                                                                    </td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="text-center" colspan="5"><h3 class="text-danger">You have no Post</h3></td>
                                                                </tr>
                                                            @endforelse

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <!-- /col-md-12 -->
                                                </div>
                                                <!-- /row -->
                                                <!-- /OVERVIEW -->
                                            </div>
                                            <!-- /tab-pane -->
                                            <!-- /tab-pane -->
                                            <div id="rejected_post" class="tab-pane">
                                                <!-- row -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                @if(session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{session('success')}}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <table class="table table-striped table-advance table-hover table-responsive">
                                                            <thead>
                                                            <tr>
                                                                <th>S.I</th>
                                                                <th class="hidden-phone">Title</th>
                                                                <th class="hidden-phone">Category</th>
                                                                <th class="hidden-phone">Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse( $rejected_post as $post )
                                                                <tr>
                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                    <td>
                                                                        {{ $post->post_title }}
                                                                    </td>
                                                                    <td>{{ $post->category->category_name }}</td>

                                                                    <td>
                                                                        <span class="btn btn-danger btn-sm">Rejected</span>
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{ route('user.post.show',$post->id )}}" class="btn task-config-btn btn-lg"><i class="fa fa-eye" title="View"></i></a>
                                                                        <a href="{{ route('user.post.edit',$post->id )}}" class="btn btn-clear-g btn-lg"><i class="fa fa-pencil" title="Edit"></i></a>

                                                                        <button onclick="deletePost({{ $post->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></button>

                                                                        <form id="delete-form-{{ $post->id }}" class="form-horizontal" action="{{ route('user.post.destroy',$post->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>

                                                                    </td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="text-center" colspan="5"><h3 class="text-danger">You have no Post</h3></td>
                                                                </tr>
                                                            @endforelse

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <!-- /col-md-12 -->
                                                </div>
                                                <!-- /row -->
                                                <!-- /OVERVIEW -->
                                            </div>
                                            <!-- /tab-pane -->

                                        </div>
                                        <!-- /tab-content -->
                                    </div>
                                    <!-- /panel-body -->
                                </div>
                                <!-- /col-lg-12 -->

                            </div>
                            <!-- /col-md-6 -->
                        </div>
                        <!-- /row -->

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