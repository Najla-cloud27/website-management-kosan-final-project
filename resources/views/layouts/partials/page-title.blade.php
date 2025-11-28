@if($title)    
<div class="page-title-head d-flex align-items-center mb-4">
    <div class="flex-grow-1">
        <h4 class="fs-xl fw-bold m-0">{{ $title }}</h4>
    </div>
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">
                    <i data-lucide="home" class="icon-dual icon-xs me-1"></i>
                    Home
                </a>
            </li>
            
            @if(isset($breadcrumbs) && is_array($breadcrumbs))
                @foreach($breadcrumbs as $breadcrumb)
                    @if(isset($breadcrumb['url']) && !$loop->last)
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item active">{{ $breadcrumb['label'] ?? $breadcrumb }}</li>
                    @endif
                @endforeach
            @else
                @if(isset($subtitle))
                <li class="breadcrumb-item">{{ $subtitle }}</li>
                @endif
                <li class="breadcrumb-item active">{{ $title }}</li>
            @endif
        </ol>
    </div>
</div>
@endif
