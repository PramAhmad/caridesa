<div class="container-fluid">
    <div class="page-title">
        <div class="row none">
            <div class="col-6">
                <h3>{{ $page_title }}</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg') }}#stroke-home"></use>
                            </svg>
                        </a>
                    </li>
                    @for ($i = 0; $i < count($breadcrumbs); $i++)
                        @if ($i == (count($breadcrumbs) - 1))
                            <li class="breadcrumb-item active">{{ $breadcrumbs[$i]['text'] }}</li>
                        @else
                            @if ($breadcrumbs[$i]['url'])
                                <li class="breadcrumb-item"><a href="{{ $breadcrumbs[$i]['url'] }}">{{ $breadcrumbs[$i]['text'] }}</a></li>
                            @else
                                <li class="breadcrumb-item">{{ $breadcrumbs[$i]['text'] }}</li>
                            @endif
                        @endif
                    @endfor
                </ol>
            </div>
        </div>
    </div>
</div>