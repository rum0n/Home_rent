@extends('admin.master')

@section('content')


    <section id="main-content">

        <section class="wrapper">
            <!-- row -->
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <section class="content">

                            <form role="form" class="form-horizontal style-form" action="{{url('admin/category/update')}}" method="post">
                                            @csrf
                                            <div class="form-group has-success">
                                                <div class="col-lg-offset-1 col-lg-10">
                                                    <input type="text" class="form-control" value="{{$single_category->category_name}}" name="category_name">
                                                </div>
                                            </div>
                                            <input type="hidden"  value="{{$single_category->id}}" name="category_id">
                                            <div class="form-group">
                                                <div class="col-lg-offset-1 col-lg-10">
                                                    <button type="submit" class="btn btn-theme">Update category</button>
                                                </div>
                                            </div>
                                        </form>

                        </section>
                    </div>
                    {{--</section>--}}
                            <!-- /.content -->
                </div>
            </div>
        </section>

    </section>


@endsection