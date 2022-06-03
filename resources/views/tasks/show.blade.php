@extends('templates.show')
@push('styles')
@endpush
@section('form_content')
        <div class="row my-4">
            <div class="col-md-6">
                <label for=""><span class="show-text">Title:</span></label> {{ $item->title }}<br>
            </div>
            <div class="col-md-6">
                <label for=""><span class="show-text">Project:</span></label> {{ $item->project->name }}<br>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-6">
                <label for=""><span class="show-text">Type:</span></label> {{ $item->type }}<br>
            </div>
            <div class="col-md-6">
                <label for=""><span class="show-text">Status:</span></label> {{ $item->status }}<br>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-6">
                <label for=""><span class="show-text">Completed At:</span></label> {{ $item->completed_at ?? '---' }}<br>
            </div>
            <div class="col-md-6">
                <label for=""><span class="show-text">Cancelled At:</span></label> {{ $item->cancelled_at ?? '---' }}<br>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-6">
                <label for=""><span class="show-text">Deadline:</span></label> {{ $item->deadline ?? '---' }}<br>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <label for=""><span class="show-text">Content:</span></label>
                <hr>
                {!! $item->content ?? '' !!}
            </div>
        </div>
@endsection
