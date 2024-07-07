@if (count($breadcrumbs))


@foreach ($breadcrumbs as $breadcrumb)

@if ($breadcrumb->url && !$loop->last)
<a href="{{ $breadcrumb->url }}" class="kt-subheader__breadcrumbs-link">
    {{ $breadcrumb->title }} </a>
<span class="kt-subheader__breadcrumbs-separator"></span>
@else
<a href="{{ $breadcrumb->url }}" class="kt-subheader__breadcrumbs-link">
    {{ $breadcrumb->title }} </a>
<span class="kt-subheader__breadcrumbs-separator"></span>
@endif

@endforeach


@endif