@extends('admin.master')

@section('title','All User')

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
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">

                        <h4><i class="fa fa-angle-right"></i> All User</h4>
                        <hr>
                        <thead>
                        <tr>
                            <th>S.I</th>
                            <th class="hidden-phone">Name</th>
                            <th class="hidden-phone">Username</th>
                            <th class="hidden-phone">Email</th>
                            <th class="hidden-phone">Picture</th>
                            <th class="hidden-phone">Promote/Demote</th>
                            <th class="hidden-phone">Status</th>
                            {{--<th class="hidden-phone">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user )
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <img src="{{ asset('frontEnd/user_picture/'.$user->pic)}}" alt="" class="img img-responsive img-thumbnail" width="100">
                                </td>
                                <td>
                                    <button onclick="promoteUser({{ $user->id }})" class="btn btn-{{($user->role_id==1)?'success':'info'}} btn-xs">{{ ($user->role_id==1)?'Admin':'User' }}</button>
                                    <form id="promote-form-{{ $user->id }}" class="form-horizontal" action="{{ route('admin.promote_demote',$user->id)  }}" method="get">
                                        @csrf
                                    </form>
                                </td>

                                <td>
                                    <button onclick="approveUser({{ $user->id }})" class="btn btn-{{($user->is_approved==1)?'success':'danger'}} btn-xs">{{ ($user->is_approved==1)?'Block':'Unblock' }}</button>
                                    <form id="approve-form-{{ $user->id }}" class="form-horizontal" action="{{ route('admin.block_unblock',$user->id)  }}" method="get">
                                        @csrf
                                    </form>
                                </td>

                                {{--<td>--}}
                                    {{--<button onclick="deletePost({{ $user->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></button>--}}
                                    {{--<form id="delete-form-{{ $user->id }}" class="form-horizontal" action="{{ route('admin.users.destroy',$user->id) }}" method="POST">--}}
                                        {{--@csrf--}}
                                        {{--@method('DELETE')--}}
                                    {{--</form>--}}
                                {{--</td>--}}

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <center>{{ $users->links() }}</center>
                <!-- /content-panel -->
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
    <!--script for this pages-->
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

    <script type="text/javascript">
        function approveUser(id) {
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
        function promoteUser(id) {
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
                document.getElementById('promote-form-'+id).submit();
            } else if (
                    // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                        'Cancelled',
                        'Action Cancelled :)',
                        'error'
                )
            }
        })
        }
    </script>
@endpush