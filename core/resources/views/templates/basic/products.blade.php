@extends($activeTemplate . 'layouts.frontend')

@section('content')
<!-- slider -->
<div id="slider" class="body_margin">
    <figure>
        <a style="overflow: hidden; width: 20%; float: left;" target="_blank" href="https://chat.whatsapp.com/FRpgvu0hiKbG72SOD1pNqf">
            <img style="width: 500%;" src="https://rexsociallogs.com/assets/images/frontend/about/slide_1.png" alt="Join Whatsapp Group">
        </a>
        <img src="https://rexsociallogs.com/assets/images/frontend/about/slide_2.png" alt="Use VPN">
        <img src="https://rexsociallogs.com/assets/images/frontend/about/slide_3.png" alt="Join Telegram Group">
        <img src="https://rexsociallogs.com/assets/images/frontend/about/slide_4.png" alt="Join Telegram Group">
    </figure>
</div>
<style>
    @keyframes slidy {
        0% { left: 0%; }
        20% { left: 0%; }
        25% { left: -100%; }
        45% { left: -100%; }
        50% { left: -200%; }
        70% { left: -200%; }
        75% { left: -300%; }
        95% { left: -300%; }
        100% { left: -400%; }
    }
    
    /*@keyframes slidy {*/
    /*    0% { left: 0%; }*/
    /*    50% { left: 0%; }*/
    /*    75% { left: -100%; }*/
    /*    100% { left: -100%; }*/
    /*}*/
    
    .body_margin { margin: 40px; } 
    div#slider { overflow: hidden; }
    div#slider figure img { width: 20%; float: left; }
    div#slider figure { 
      position: relative;
      width: 500%;
      margin: 0;
      left: 0;
      text-align: left;
      font-size: 0;
      animation: 8s slidy infinite; 
    }
</style>
<!-- slide -->
<section class="catalog-section section-bg py-{{ @$categories->count() ? 120 : 60 }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-xl-11">
                @forelse($categories as $category)
                    @php
                        $products = $category->products;
                    @endphp
                    <div class="catalog-item-wrapper">
                        <div class="catalog-item-wrapper__header d-flex align-items-center justify-content-between">
                            <h5 class="title mb-0">{{ __($category->name) }}</h5>
                            <a href="{{ route('category.products', ['search'=>request()->search, 'slug'=>slug($category->name), 'id'=>$category->id]) }}"
                                class="btn btn--base btn-outline--base btn--sm">
                                @lang('View All')
                            </a>
                        </div>
                        @foreach($products->take(5) as $product)
                            @include($activeTemplate.'partials/products')
                        @endforeach
                    </div>
                @empty
                <div class="empty-data text-center">
                    <div class="thumb">
                        <img src="{{ asset($activeTemplateTrue . 'images/not-found.png') }}">
                    </div>
                    <h4 class="title">@lang('No result found for "'.request()->search.'"')</h4>
                </div>
                @endforelse
                {{ paginateLinks($categories) }}
            </div>
        </div>
    </div>
</section>

@if ($sections->secs != null)
    @foreach (json_decode($sections->secs) as $sec)
        @include($activeTemplate . 'sections.' . $sec)
    @endforeach
@endif

<x-purchase-modal :wallet="$userWallet" />
@endsection



