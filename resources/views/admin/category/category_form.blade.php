@extends('admin.master')

@section('content')

<section id="main-content">

  <section class="wrapper">
    <!-- row -->
    <div class="row mt">
      <div class="col-md-12">

        <div class="content-panel">

          <form role="form" class="form-horizontal style-form" method="post" action="{{route('admin.cat_category')}}">
            @csrf
            <div class="form-group has-success">
              <div class="col-lg-offset-1 col-lg-10">
                <input type="text" placeholder="Add New Category" id="f-name" class="form-control" name="category_name" required>

              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-offset-1 col-lg-10">
                <button class="btn btn-theme" type="submit"><i class="fa fa-plus"> Add Category</i></button>
              </div>
            </div>
          </form>



          <table class="table table-striped table-advance table-hover">

            <h4><i class="fa fa-angle-right"></i> All Category</h4>
            <hr>
            <thead>
            <tr>
              <th>S.I</th>
              <th class="hidden-phone">Category Name</th>
              {{-- <th><i class=" fa fa-edit"></i> Status</th> --}}
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_category as $cat)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>
                  <a href="">{{$cat->category_name}}</a>
                </td>

                <td>
                  {{--<a href="{{ route('admin.category_edit',$cat->id )}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>--}}

                  <a href="{{ route('admin.category_edit',$cat->id )}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

                  <button onclick="deletePost({{ $cat->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>


                  {{--<form id="delete-form-{{ $cat->id }}" class="form-horizontal" action="{{ route('admin.category_delete',$cat->id )}}" method="POST">--}}
                  <form id="delete-form-{{ $cat->id }}" class="form-horizontal" action="{{ route('admin.category_delete',$cat->id )}}">
                    @csrf
                    {{--@method('DELETE')--}}
                  </form>

                </td>

              </tr>
            @endforeach

            </tbody>
          </table>
        </div>
        <!-- /content-panel -->
      </div>
    </div>
  </section>

</section>


@endsection

@push('js')
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