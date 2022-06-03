@extends('templates.show')
@push('styles')
@endpush
@section('form_content')
    <div class="row my-4">
        <div class="col-md-6">
            <label for=""><span class="show-text">Name:</span></label> {{ $item->name }}<br>
        </div>
        <div class="col-md-6">
            <label for=""><span class="show-text">Project:</span></label> {{ $item->project->name }}<br>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-6">
            <label for=""><span class="show-text">Version:</span></label> {{ $item->version ?? '' }}<br>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12">
            <label for=""><span class="show-text">Changelog:</span></label>
            <hr>
            {!! $item->changelog ?? '' !!}
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12"><label for=""><span class="show-text">Files:</span></label>
            @if($item->getMedia('archives') != NULL)
                <div class="d-flex align-items-center flex-wrap">
                    <table class="table table-separate table-head-custom table-checkable"
                           id="kt_datatable_2">
                        <tbody>
                        @php
                            $mimeArray = ['image/jpeg','image/jpg','image/png','image/gif'];
                        @endphp
                        @if($item->getMedia('archives') != NULL)
                            @foreach($item->getMedia('archives') as $key=>$document)
                                <tr class="file-row">
                                    <td class="text-muted">File {{$key+1}}</td>
                                    <td class="">
                                        @if( in_array($document->mime_type,$mimeArray))
                                            <div class="text-center">
                                                <img src="{{$document->getFullUrl()}}" alt="DOC"
                                                     class="img w-25 h-25 img-fluid">
                                            </div>
                                        @else
                                            <a target="_blank" class=""
                                               href="{{$document->getFullUrl()}}">{{$document->getFullUrl()}}</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </td>
                                </tr>

                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-info-circle mr-2 text-white"></i>There are no files for this project.
                </div>
            @endif
        </div>
    </div>
@endsection
