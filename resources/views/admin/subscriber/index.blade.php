@extends('admin.master')


@section('title','')


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
                        <table id="example1" class="table table-bordered table-striped">

                            <h4><i class="fa fa-angle-right"></i>Subscribers</h4>
                            <hr>
                            <thead>
                            <tr>
                                <th>S.I</th>
                                <th class="hidden-phone">Subscriber Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$subscriber->email}}</td>

                                    <td>
                                        {{--<a href="{{ route('admin.subscriber',$subscriber->id )}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>--}}

                                        <button onclick="deletePost({{ $subscriber->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                        <form id="delete-form-{{ $subscriber->id }}" class="form-horizontal" action="{{ route('admin.subscriber.destroy',$subscriber->id )}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
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

    @endpush