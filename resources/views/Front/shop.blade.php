@extends('Front.master')
@section('css')
<link rel="stylesheet" href="{{asset('asset/Front/css/ion.rangeSlider.min.css')}}">
@endsection
@section('content')
<div class="shop-main">
    <div class="filter-button-container">
        <button id="Toggle-Filter">
            <span>Filters</span>
        </button>
    </div>
    <div class="shop-left-site">
        <div class="prdouct-left-cart">
            <h2 class="nav-nigth">Cart</h2>
            <div class="product-left-underllne"></div>
            <p>

                <a href="" class="nav-nigth"> Product in Cart</a>
            </p>
        </div>
        <div class="product-left-filter">
            <h2 class="nav-nigth">Categories</h2>
            <div class="product-left-underllne"></div>
            @if($categories->isNotEmpty())
            @foreach($categories as $category)
            <p><a href="{{route('Front.shop',$category->slug)}}"
                    class="{{($categoryID == $category->id ? 'active' : '')}} nav-nigth">{{$category->name}}</a></p>
            @endforeach
            @else
            <p><a href="">Categories Not Found </a></p>
            @endif
        </div>
        <div class="product-left-price">
            <h2 class="nav-nigth">Price (Rs)</h2>
            <div class="product-left-underllne"></div>
            <input type="text" class="js-range-slider" name="my_range" value="" />
        </div>


        <div class="reset-filter">
            <a href="{{route('Front.shop')}}" class="nav-nigth">Reset Filter</a>
        </div>
    </div>

    <div class="shop-rigth-site">
        <!-- banner section  -->

        <!-- banner section  -->
        <!-- product section  -->
        <div class="product-section two-container">
            <h1 class="nav-nigth">Best Plants</h1>
            <div class="sort-section">
                <h2 class="nav-nigth">{{ $productsCount}} Plants</h2>
                <div class="sort-sub">
                    <span class="nav-nigth">Sort By:</span>
                    <select class="sort" name="sort" aria-label="Default select example">
                        <option selected value="">Sorting</option>
                        <option value="latest" {{ ($sort == 'latest') ? 'selected' : '' }}>Latest</option>
                        <option value="price_desc" {{ ($sort == 'price_desc') ? 'selected' : '' }}>Price High</option>
                        <option value="price_asc" {{ ($sort == 'price_asc') ? 'selected' : '' }}>price Low</option>
                    </select>

                </div>
            </div>
            <div class="row">
                <!-- Single Product Area -->
                @if(!empty($products))

                @foreach($products as $product)
                @php
                $img = $product->image->first()
                @endphp
                <!-- Single Product Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-product-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Product Image -->
                        <div class="product-img">
                            <a href="shop-details.html"><img src="{{ asset('uploads/product/small/'.$img->image) }}"
                                    alt="" /></a>
                            <!-- Product Tag -->

                            <div class="product-meta d-flex">
                                <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                <a href="{{route('Front.product-detail',$product->slug)}}" class="add-to-cart-btn">View
                                    More</a>
                                <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                            </div>
                        </div>
                        <!-- Product Info -->
                        <div class="product-info mt-15 text-center">
                            <a href="shop-details.html">
                                <p>{{ $product->title }}</p>
                            </a>
                            <h6>${{ $product->price }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
                @else

                <h1>Product Not Found</h1>

                @endif


            </div>
            <div class="card-footer clearfix pagination">
            </div>
        </div>
        <!-- product section  -->
    </div>
</div>
@endsection

@section('js')
<!-- javascript link  -->
<script src="{{asset('asset/Front/js/ion.rangeSlider.min.js')}}"></script>
<script type="text/javascript">
//product filter function
rangeSlider = $(".js-range-slider").ionRangeSlider({
    type: "double",
    min: 0,
    max: 10000,
    from: {{ $pricemin }},
    step: 10,
    to:  {{ $pricemax }},
    skin: "round",
    max_postfix: "+",
    prefix: "$",
    onFinish: function() {
        applyfilter()
    }
})


var slider = $(".js-range-slider").data("ionRangeSlider")

$('.sort').change(function() {
    applyfilter()
})

function applyfilter() {
  
    var url = '{{url()->current()}}?';


    
    // brand filter

   

    // Price filter

    url += "&price_min=" + slider.result.from + "&price_max=" + slider.result.to;

    // Price filter

    // Sort filter
    if ($(".sort").val() != "") {
        url += "&sort=" + $(".sort").val();
    }

    // Sort filter


    window.location.href = url
}
</script>
<!-- javascript link  -->
@endsection