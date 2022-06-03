<div class="form-group row">
    <div class="col-6">
        <label for="name">Name *</label>
        <input type="text" id="name" required class="form-control" name="name" value="{{ old('name',$item->name) }}"
               placeholder="Enter Name">
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <label for="summernote">Content</label>
        <textarea name="content" id="summernote"
                  class="form-control">{!! old('content', $item->content) ?? '' !!}</textarea>
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <label for="summernote1">Notes</label>
        <textarea name="notes" id="summernote1" class="form-control">{!! old('notes', $item->notes) ?? '' !!}</textarea>
    </div>
</div>
