@extends('gp247-core::layout')

@section('main')
<div class="container">
    <h1>Testimonials</h1>
    <a href="{{ url('admin/testimonial/create') }}" class="btn btn-primary mb-3">Add Testimonial</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($testimonials as $t)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($t->image)
                <img src="{{ url($t->image) }}" style=" width:50px; height:50px;"  class="card-img-top" alt="{{ $t->author_name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $t->author_name }}</h5>
                    <h6 class="card-subtitle text-muted">{{ $t->designation }}</h6>
                    <p class="card-text mt-2">{{ $t->message }}</p>
                    <a href="{{ url('admin/testimonial/edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ url('admin/testimonial/destroy', $t->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this testimonial?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
