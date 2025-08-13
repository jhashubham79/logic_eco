@extends('gp247-core::layout')


@section('main')

  <div class="col-md-7">
    <h1>Add Testimonial</h1>
    <form action="{{ url('admin/testimonial/store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-main">
        @csrf
        <div class="mb-3">
            <label>Author Name</label>
            <input type="text" name="author_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control">
        </div>
        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>



@endsection

@push('styles')
{!! $css ?? '' !!}
@endpush