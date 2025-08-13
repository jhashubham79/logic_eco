@extends('gp247-core::layout')

@section('main')
<div class="container">
    <h1>Edit Testimonial</h1>
    <form action="{{ url('admin/testimonial/update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="mb-3">
            <label>Author Name</label>
            <input type="text" name="author_name" class="form-control" value="{{ $testimonial->author_name }}" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" value="{{ $testimonial->designation }}">
        </div>
        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" required>{{ $testimonial->message }}</textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            @if($testimonial->image)
                <img src="{{ url($testimonial->image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
