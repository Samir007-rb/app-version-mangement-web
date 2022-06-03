@extends('templates.show')
@push('styles')
@endpush
@section('form_content')
    <div class="tab-content">
        <div class="active tab-pane" id="project">
            <div class="row my-4">
                <div class="col-md-6">
                    <label for=""><span class="show-text">Name:</span></label> {{ $item->name }}<br>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <label for=""><span class="show-text">Content:</span></label>
                    <hr>
                    {!! $item->content ?? '' !!}
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <label for=""><span class="show-text">Notes:</span></label>
                    <hr>
                    {!! $item->notes ?? '' !!}
                </div>
            </div>
        </div>

        <div class="tab-pane" id="archive">
            @if (session('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('success') }}
                </div>
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Archive</h3>
                                    <a href="{{route('archives.create', ['project_id'=>$item->id])}}"
                                       class="btn btn-primary float-right">
                                        <i class="fa fa-plus"></i>
                                        <span class="kt-hidden-mobile">Add new</span>
                                    </a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table w-100" id="archive-table">
                                            <thead>
                                            <tr class="text-left text-capitalize">
                                                <th>#id</th>
                                                <th>name</th>
                                                <th>version</th>
                                                <th>action</th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>

        </div>

        <div class="tab-pane" id="task">
            @if (session('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('success') }}
                </div>
            @endif
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Task</h3>
                                    <a href="{{route('tasks.create', ['project_id'=>$item->id])}}"
                                       class="btn btn-primary float-right">
                                        <i class="fa fa-plus"></i>
                                        <span class="kt-hidden-mobile">Add new</span>
                                    </a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table w-100" id="task-table">
                                            <thead>
                                            <tr class="text-left text-capitalize">
                                                <th>#id</th>
                                                <th>title</th>
                                                <th>type</th>
                                                <th>completed at</th>
                                                <th>cancelled at</th>
                                                <th>status</th>
                                                <th>deadline</th>
                                                <th>action</th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>
    </div>
    {{--    </div>--}}
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#archive-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('archives-index', $item->id) }}",
                columns: [
                    {data: 'id', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'version', name: 'version'},
                    {data: 'action', name: 'action'},
                ],
            });
        });
    </script>
    <script>
        $(function () {
            $('#task-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tasks-index', $item->id) }}",
                columns: [
                    {data: 'id', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type'},
                    {data: 'completed_at', name: 'completed_at'},
                    {data: 'cancelled_at', name: 'cancelled_at'},
                    {data: 'status', name: 'status'},
                    {data: 'deadline', name: 'deadline'},
                    {data: 'action', name: 'action'},
                ],
            });
        });
    </script>
@endpush
