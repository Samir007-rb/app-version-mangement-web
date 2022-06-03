<div class="form-group row">
    <input type="hidden" name="project_url_Id" value="{{$projectId}}">
    <div class="col-6">
        <label for="name">Name *</label>
        <input type="text" id="name" required class="form-control" name="name" value="{{ old('name',$item->name) }}"
               placeholder="Enter Name">
    </div>
    <div class="col-6">
        <label for="version">Version</label>
        <input type="text" id="version" class="form-control" name="version" value="{{ old('version',$item->version) }}"
               placeholder="Enter Version">
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <label for="summernote">Changelog</label>
        <textarea name="changelog" id="summernote"
                  class="form-control">{!! old('changelog', $item->changelog) ?? '' !!}</textarea>
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <label class="text-muted" for="file-upload-hidden">Files</label>
        <div class="file-section">
            <button class="btn  btn-outline-primary mr-2 " id="file-upload"><i
                    class="fas fa-upload"></i> Attach File
            </button>
            <input type="file" class="" multiple name="files[]" id="file-upload-hidden" style="display: none">
        </div>
    </div>
</div>
<span id="message"></span>

@if($item->getMedia('archives') != NULL)
    <div class="d-flex align-items-center flex-wrap">
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable_2">
            <tbody>
            @php
                $mimeArray = ['image/jpeg','image/jpg','image/png','image/gif'];
            @endphp
            @if($item->getMedia('archives') != NULL)
                @foreach($item->getMedia('archives') as $key=>$document)
                    <tr class="file-row">
                        <td class="text-primary">File {{$key+1}}</td>
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
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm deleteFile"
                                    data-model-id="{{$item->id}}" data-id="{{$document->id}}"
                                    title="Remove Image"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </td>
                    </tr>

            </tbody>
        </table>
    </div>
    @endif

    @push('scripts')
        <script>
            $('body').on('click', '#file-upload', function (e) {
                e.preventDefault();
                $('#file-upload-hidden').trigger('click');
            })

            $('#file-upload-hidden').on('change', function () {
                var numFiles = $("#file-upload-hidden")[0].files.length;
                $('.file-section > .file-message').html('');
                $('.file-section').append(`<span class=" bg-light h4 file-message">${numFiles} Files Uploaded</span>`);
            })

            $('body').on('click', '.deleteFile', function (e) {
                e.preventDefault();
                let del = confirm('Are You Sure?');
                if (del) {
                    model_id = $(this).attr('data-model-id');
                    id = $(this).attr('data-id');
                    parentDiv = $(this).parents('.file-row');
                    if (model_id && id) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: "{{route('archive.image.delete')}}",
                            data: {
                                model_id: model_id,
                                id: id,
                            },
                            error: function (xhr) {
                                showFailedMessage();
                            }
                        }).done(function (response) {
                            if (response.status) {
                                showSuccessMessage(response.message);
                                $(parentDiv).remove();
                            } else {
                                showFailedMessage();
                            }
                        })
                    } else {
                        showFailedMessage();
                    }
                }
            })

            function showSuccessMessage(message) {
                $('#message').append(`<div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            ${message}
            </div>`)
            }

            function showFailedMessage(error_message) {
                $('#message').append(`<div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            ${message}
            </div>`)
            }
        </script>
    @endpush
