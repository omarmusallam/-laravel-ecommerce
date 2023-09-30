<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane show active fade" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="{{ $product->thumb_url }}" alt="#">
                            <div class="button">
                                <a href="{{ route('products.show', $product->slug) }}" class="btn"><i
                                        class="lni lni-cart"></i>
                                    {{ __('Add to Cart') }}</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <span class="category">{{ $product->category->name }}</span>
                            <h4 class="title">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h4>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star"></i></li>
                                <li><span>4.0 {{ __('Review(s)') }}</span></li>
                            </ul>
                            <div class="price">
                                <span>{{ App\Helpers\Currency::format($product->price) }}</span>
                                @if ($product->compare_price)
                                    <span
                                        class="discount-price">{{ App\Helpers\Currency::format($product->compare_price) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                </div>
            @endforeach
        </div>
    </div>
</div>
