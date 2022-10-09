<div>
    <div class="home-wrapper home-1">


        <div class="slider-area">
            <div class="obrien-slider arrow-style" data-slick-options='{
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "infinite": true,
            "arrows": true,
            "dots": true,
            "autoplay" : true,
            "fade" : true,
            "autoplaySpeed" : 7000,
            "pauseOnHover" : false,
            "pauseOnFocus" : false
            }' data-slick-responsive='[
            {"breakpoint":992, "settings": {
            "slidesToShow": 1,
            "arrows": false,
            "dots": true
            }}
            ]'>
                @foreach($categoria as $c)
                <div class="slide-item slide-1 bg-position slide-bg-1 animation-style-01" style="background-color: aliceblue">
                    <div class="slider-content">
                        <p style="width: 50%; left: 100%; float: right;">
                        <img src="{{asset('assets/images/categoria/'.$c->icon)}}" alt="{{$c->nome}}" width="100px" class="product-image-1 w-100" >
                        </p>
                        <h4 class="slider-small-title">Encontre todo tipo de</h4>
                        <h2 class="slider-large-title">{{$c->nome}}</h2>
                        <div class="slider-btn">
                            <a class="obrien-button black-btn" href={{Route('categoria',$c->id)}}>Visite</a>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    
        <div class="product-area">
        <div class="container container-default custom-area">
        <div class="row">
                    <div class="col-lg-5 m-auto text-center col-custom">
                        <div class="section-content">
                            <h2 class="title-1 text-uppercase"></h2>
                            <div class="desc-content">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>

        <div class="product-area">
            <div class="container container-default custom-area">
                <div class="row">
                    <div class="col-lg-5 m-auto text-center col-custom">
                        <div class="section-content">
                            <h2 class="title-1 text-uppercase">Produtos mais vendidos</h2>
                            <div class="desc-content">
                                <p>A lista dos produtos mais vendidos são os que apresentam maior procura e aquisição</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 product-wrapper col-custom">
                        <div class="product-slider" data-slick-options='{
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "infinite": true,
                            "arrows": false,
                            "dots": false
                            }' data-slick-responsive='[
                            {"breakpoint": 1200, "settings": {
                            "slidesToShow": 3
                            }},
                            {"breakpoint": 992, "settings": {
                            "slidesToShow": 2
                            }},
                            {"breakpoint": 576, "settings": {
                            "slidesToShow": 1
                            }}
                            ]'>
                            @foreach($produto as $p)
                            <div class="single-item">
                                <div class="single-product position-relative" style="border: 2px solid #0E6A3A; border-radius: 15px">
                                    <div class="product-image">
                                        <a class="d-block" href="{{Route('item',$p->id)}}">
                                            <img src="{{asset('assets/images/produto/'.$p->icon)}}" alt="{{$p->nome}}" class="product-image-1 w-100">
                                        </a>
                                    </div>
                                    <div class="product-content"> 
                                    <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="product-title">
                                            <h4 class="title-2"> <a href="{{Route('item',$p->id)}}">{{$p->nome}}</a></h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">{{$p->preco_retalho}} MZN</span>
                                        </div>
                                    </div>
                                    <div class="add-action d-flex position-absolute">
                                        <a href="{{url('carrinha')}}" title="Adicionar a Carrinha">
                                            <i class="ion-bag"></i>
                                        </a>
                                        <!-- <a href="#" title="Adicionar a Favorito">
                                            <i class="ion-ios-heart-outline"></i>
                                        </a> -->
                                        <a href="#{{$p->nome}}" data-toggle="modal" title="Visão Rápida">
                                            <i class="ion-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>
    
        <div class="product-area">
            <div class="container container-default custom-area">
                <div class="row">
                    <div class="col-lg-5 m-auto text-center col-custom">
                        <div class="section-content">
                            <h2 class="title-1 text-uppercase">TODOS PRODUTOS</h2>
                            <div class="desc-content">
                                <p>Uma lista de todos produtos existentes na empresa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row shop_wrapper grid_4">
                        @foreach($produtos as $p)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-custom product-area">
                            <div class="single-product position-relative" style="border: 2px solid #0E6A3A; border-radius: 15px">
                                <div class="product-image">
                                    <a class="d-block" href={{Route('item',$p->id)}}>
                                        <img src="{{asset('assets/images/produto/'.$p->icon)}}" alt="" class="product-image-1 w-100">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="product-title">
                                        <h4 class="title-2"> <a href={{Route('item',$p->id)}}>{{$p->nome}}</a></h4>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price ">{{$p->preco_retalho}} MZN</span>
                                    </div>
                                </div>
                                <div class="add-action d-flex position-absolute">
                                    <a href="{{url('carrinha')}}" title="Adicionar na carrinha">
                                        <i class="ion-bag"></i>
                                    </a>
                                   <!--  <a href="#" title="Favorito">
                                        <i class="ion-ios-heart-outline"></i>
                                    </a> -->
                                    <a href="#{{$p->nome}}" data-toggle="modal" title="Visão Rápida">
                                        <i class="ion-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                        <div class="row">
                            <div class="col-sm-12 col-custom">
                                <div class="toolbar-bottom mt-30">
                                    @if(count($produtos))
                                    {{ $produtos->links('livewire.livewire-pagination-links') }}
                                    @endif
                                </div>
                             </div>
                        </div>
                </div>
            </div>
            <!-- Product Area End Here -->
</div>
