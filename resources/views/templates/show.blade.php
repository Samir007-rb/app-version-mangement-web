@extends('adminlte::page')
@section('css')
    @stack('styles')
@stop
@section('title', 'Show '.$title)
@section('content_header')
    <h1>View {{$title}}</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                @if(!isset($hideTitle))
                                    {{$title}}
                                @else
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#project"
                                                                data-toggle="tab">Project</a>
                                        </li>
                                        <li class="nav-item" id="indexId"><a class="nav-link" href="#archive"
                                                                             data-toggle="tab">Archive</a>
                                        </li>
                                        <li class="nav-item" id="idProject"><a class="nav-link" href="#task" data-toggle="tab">Task</a>
                                        </li>
                                    </ul>
                                @endif
                            </h3>
                            @if(!isset($hideEdit))
                                <a href="{{route($route.'edit', $item->id)}}" class="btn btn-primary float-right">
                                    <i class="fa fa-edit"></i>
                                    <span class="kt-hidden-mobile">Edit</span>
                                </a>
                            @endif
                        </div>

                        <div class="card-body">
                            @yield('form_content')

                        </div>
                        <div class="card-footer">
                            <a href="javascript:history.back();" class="btn btn-default float-right">Cancel</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('js')
    @stack('scripts')
    <script>
        jQuery(document).ready(function () {
            $('#form input').attr('readonly', true);
            $('#form select').attr('disabled', true);
        });
    </script>

    <script>
        var projectId = {{$item->id}};

        $('#indexId').click(function (e) {
            e.preventDefault();

            var getUrl = window.location;
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

            $.ajax({
                url: baseUrl + "/archive/index/" + projectId,
                method: "GET",
            });
        })

        $('#idProject').click(function (e) {
            e.preventDefault();

            var getUrl = window.location;
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

            $.ajax({
                url: baseUrl + "/task/index/" + projectId,
                method: "GET",
            });
        })
    </script>
@stop
