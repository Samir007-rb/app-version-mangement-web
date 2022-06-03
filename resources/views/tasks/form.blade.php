<div class="form-group row">
    <input type="hidden" name="project_url_Id" value="{{$projectId}}">
    <div class="col-6">
        <label for="title">Title *</label>
        <input type="text" id="title" required class="form-control" name="title" value="{{ old('title',$item->title) }}"
               placeholder="Enter Title">
    </div>
    <div class="col-6">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            <option value="feature" {{old('type', $item->type)== 'feature' ? 'selected' : ''}}>Feature</option>
            <option value="bug" {{old('type', $item->type)== 'bug' ? 'selected' : ''}}>Bug</option>
            <option value="critical" {{old('type', $item->type)== 'critical' ? 'selected' : ''}}>Critical</option>
            <option value="enhancement" {{old('type', $item->type)== 'enhancement' ? 'selected' : ''}}>Enhancement
            </option>
        </select>
    </div>
    <div class="col-6 my-3">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{old('type', $item->type)== 'pending' ? 'selected' : ''}}>Pending</option>
            <option value="backlog" {{old('type', $item->type)== 'backlog' ? 'selected' : ''}}>Backlog</option>
            <option value="on-progress" {{old('type', $item->type)== 'on-progress' ? 'selected' : ''}}>On progress
            </option>
            <option value="completed" {{old('type', $item->type)== 'completed' ? 'selected' : ''}}>Completed</option>
            <option value="cancelled" {{old('type', $item->type)== 'cancelled' ? 'selected' : ''}}>Cancelled</option>
        </select>
    </div>
    <div class="col-6 my-3">
        <label for="completed_at">Completed At</label>
        <input type="text" id="completed_at" class="form-control" name="completed_at"
               onfocus="(this.type='datetime-local')" value="{{ old('completed_at',$item->completed_at) }}"
               placeholder="Completed At">
    </div>
    <div class="col-6 my-3">
        <label for="cancelled_at">Cancelled At</label>
        <input type="text" id="cancelled_at" class="form-control" name="cancelled_at"
               onfocus="(this.type='datetime-local')" value="{{ old('cancelled_at',$item->cancelled_at) }}"
               placeholder="Cancelled At">
    </div>
    <div class="col-6 my-3">
        <label for="deadline">Deadline</label>
        <input type="text" id="deadline" class="form-control" name="deadline" onfocus="(this.type='date')"
               value="{{ old('deadline',$item->deadline) }}"
               placeholder="Deadline">
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <label for="summernote">Content</label>
        <textarea name="content" id="summernote"
                  class="form-control">{!! old('content', $item->content) ?? '' !!}</textarea>
    </div>
</div>
