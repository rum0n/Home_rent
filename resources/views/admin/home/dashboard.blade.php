@extends('admin.master')

@section('title','Admin Panel')

@push('css')
    <link rel="stylesheet" href="{{asset('admin')}}/css/dataTables.bootstrap4.css">
@endpush

@section('content')

    <section id="main-content">

        <section class="wrapper">
            <!-- row -->
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <section class="content">
                            <div class="">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    {{--<table id="example1" class="table table-striped table-advance table-hover">--}}
                                    {{--<input type="text" class="form-check-label" id="search" placeholder="Search" name="search">--}}
                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>
                                        <tr>
                                            <th>S.I</th>
                                            <th class="hidden-phone">Title</th>
                                            <th class="hidden-phone">Category</th>
                                            <th class="hidden-phone" width="2%">Bedrooms</th>
                                            <th class="hidden-phone" width="4%">Monthly Rent</th>
                                            <th class="hidden-phone">Address</th>
                                            <th class="hidden-phone">Email</th>
                                            <th class="hidden-phone">Mobile</th>
                                            <th class="hidden-phone">Status</th>
                                            {{-- <th><i class=" fa fa-edit"></i> Status</th> --}}
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
                                                <td>{{ $post->bedrooms }}</td>
                                                <td>{{ $post->monthly_rent }}</td>
                                                {{--<td>{{ $post->description }}</td>--}}
                                                <td>{{ $post->address }}</td>
                                                <td>{{ $post->email }}</td>
                                                <td>{{ $post->mobile_no }}</td>

                                                <td>
                                                    @if($post->is_approved==1)
                                                        <span class="accept-delete">
                                                            {{--<a href="{{ route('admin.reject_post',$post->id )}}" class="btn btn-warning btn-xs">Reject</a>--}}

                                                            <button onclick="rejectPost({{ $post->id }})" class="btn btn-warning btn-xs">Reject</button>
                                                            <form id="reject-form-{{ $post->id }}" class="form-horizontal" action="{{ route('admin.reject_post',$post->id) }}" method="post">
                                                                @csrf
                                                            </form>
                                                            {{--<a href="{{ route('admin.reject_post',$post->id )}}" class="btn btn-warning btn-xs">Reject</a>--}}

                                                            <button onclick="approvePost({{ $post->id }})" class="btn btn-primary btn-xs">Accept</button>
                                                            <form id="approve-form-{{ $post->id }}" class="form-horizontal" action="{{ route('admin.accept_post',$post->id) }}" method="post">
                                                                @csrf
                                                            </form>
                                                        </span>
                                                    @else
                                                        @if($post->is_approved==2)
                                                            <button class="btn btn-success btn-block btn-xs">Accepted</button>
                                                        @elseif($post->is_approved==0)
                                                            <button class="btn btn-danger btn-block btn-xs">Rejected</button>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.post.show',$post->id )}}" class="btn btn-success btn-xs"><i class="fa fa-eye" title="View"></i></a>
                                                    {{--<a href="{{ route('admin.post.edit',$post->id )}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" title="Edit"></i></a>--}}

                                                    <button onclick="deletePost({{ $post->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></button>

                                                    <form id="delete-form-{{ $post->id }}" class="form-horizontal" action="{{ route('admin.post.destroy',$post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="12"><h3 class="text-danger">No Post available</h3></td>
                                            </tr>
                                        @endforelse

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>S.I</th>
                                            <th class="hidden-phone">Title</th>
                                            <th class="hidden-phone">Category</th>
                                            <th class="hidden-phone">Bedrooms</th>
                                            <th class="hidden-phone">Monthly Rent</th>
                                            <th class="hidden-phone">Address</th>
                                            <th class="hidden-phone">Email</th>
                                            <th class="hidden-phone">Mobile</th>
                                            <th class="hidden-phone">Status</th>
                                            {{-- <th><i class=" fa fa-edit"></i> Status</th> --}}
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                    </div>
                    <!-- /.content -->
                    <center>{{ $posts->links() }}</center>
                </div>
            </div>
        </section>

    </section>

@endsection

@push('js')
        <!-- DataTables -->
    <script src="{{asset('admin/js')}}/jquery.dataTables.js"></script>
    <script src="{{asset('admin/js')}}/dataTables.bootstrap4.js"></script>

    <script type="text/javascript">
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>


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

    <!-- Script for Approving -->
    <script type="text/javascript">
        function approvePost(id) {
            swal({
                title: 'Are you sure?',
//                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-2',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('approve-form-'+id).submit();
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

    <script type="text/javascript">
        function rejectPost(id) {
            swal({
                title: 'Are you sure?',
//                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-2',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('reject-form-'+id).submit();
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

    <!-- /.Js for Ajax Search -->
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>--}}
    {{--<script type="text/javascript">--}}

{{--//         $(document).on('keyup', '#search', function(){--}}
        {{--$('#search').on('keyup',function(){--}}
            {{--$value=$(this).val();--}}
            {{--$.ajax({--}}
                {{--type : 'get',--}}
                {{--url : '{{Route('admin.search')}}',--}}
                {{--data:{'search':$value},--}}
                {{--success:function(data){--}}
                    {{--$('tbody').html(data);--}}
                {{--}--}}
            {{--});--}}

        {{--})--}}

    {{--</script>--}}

    {{--<script type="text/javascript">--}}
        {{--$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });--}}
    {{--</script>--}}

@endpush