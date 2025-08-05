{{-- breadcrumb --}}
@if (!empty($breadcrumbs) && count($breadcrumbs))
<section class="py-1 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ gp247_route_front('front.home') }}">
                        {{ gp247_language_render('front.home') }}
                    </a>
                </li>
                @foreach ($breadcrumbs as $key => $item)
                    @if (($key + 1) == count($breadcrumbs))
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $item['title'] }}
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</section>
@endif
{{-- //breadcrumb --}}
