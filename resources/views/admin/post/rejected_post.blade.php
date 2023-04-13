@extends('admin.master')

@section('title','Admin Panel')

@push('css')
{{--<link rel="stylesheet" href="{{asset('admin')}}/css/dataTables.bootstrap4.css">--}}
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
                                    <h2>Rejected Posts</h2>

                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>
                                        <tr>
                                            <th>S.I</th>
                                            <th class="hidden-phone">Title</th>
                                            <th class="hidden-phone">Category</th>
                                            <th class="hidden-phone">Bedrooms</th>
                                            <th class="hidden-phone">Batherooms</th>
                                            <th class="hidden-phone">Balconies</th>
                                            <th class="hidden-phone">Monthly Rent</th>
                                            <th class="hidden-phone">Address</th>
                                            <th class="hidden-phone">Email</th>
                                            <th class="hidden-phone">Mobile</th>
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
                                                <td>{{ $post->bedrooms }}</td>
                                                <td>{{ $post->batherooms }}</td>
                                                <td>{{ $post->balconies }}</td>
                                                <td>{{ $post->monthly_rent }}</td>
                                                {{--<td>{{ $post->description }}</td>--}}
                                                <td>{{ $post->address }}</td>
                                                <td>{{ $post->email }}</td>
                                                <td>{{ $post->mobile_no }}</td>


                                                <td>
                                                    <button onclick="deletePost({{ $post->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></button>
                                                    <form id="delete-form-{{ $post->id }}" class="form-horizontal" action="{{ route('admin.permanent_delete',$post->id) }}" method="POST">
                                                        @csrf
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
                                            <th class="hidden-phone">Batherooms</th>
                                            <th class="hidden-phone">Balconies</th>
                                            <th class="hidden-phone">Monthly Rent</th>
                                            <th class="hidden-phone">Address</th>
                                            <th class="hidden-phone">Email</th>
                                            <th class="hidden-phone">Mobile</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    {{--<center>{{ $deleted_post->links() }}</center>--}}
                                </div>
                                <center>{{ $rejected_post->links() }}</center>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                    </div>
                    <!-- /.content -->

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