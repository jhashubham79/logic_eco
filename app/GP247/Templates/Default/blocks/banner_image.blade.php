@php
$banners = $modelBanner->start()->setType('banner')->getData();
$enableLoop = $banners->count() >= 3 ? 'true' : 'false';
@endphp

