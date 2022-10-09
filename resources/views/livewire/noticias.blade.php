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
                @foreach($noticias as $c)
                <div class="slide-item slide-1 bg-position slide-bg-1 animation-style-01" style="background-color: aliceblue">
                    <div class="slider-content">
                        <p style="width: 50%; left: 100%; float: right;">
                        <img src="{{asset('assets/images/noticia/'.$c->icon)}}" alt="{{$c->nome}}" width="100px" class="product-image-1 w-100" >
                        </p>
                        <h4 class="slider-small-title">Informa-te de</h4>
                        <h2 class="slider-large-title">{{$c->nome}}</h2>
                        <div class="slider-btn">
                            <a class="obrien-button black-btn" href="{{Route('itemcomentario',$c->id)}}">Visite</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="blog-main-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-12 col-custom mt-no-text">
                    <div class="row">
                        @foreach($noticia as $c)
                        <div class="col-lg-4 col-md-6 col-custom mb-4">
                            <div class="single-blog">
                                <div class="single-blog-thumb">
                                    <a href="{{Route('itemcomentario',$c->id)}}">
                                        <img src="{{asset('assets/images/noticia/'.$c->icon)}}" alt="Blog Image">
                                    </a>
                                </div>
                                <div class="single-blog-content position-relative">
                                    <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                        <span>{{ $c->created_at->format('d') }}</span>
                                        <span>{{ $c->created_at->format('m') }}</span>
                                    </div>
                                    {{-- <div class="post-meta">
                                        <span class="author">Author: Obrien Demo Admin</span>
                                    </div> --}}
                                    <h2 class="post-title">
                                        <a href="{{Route('itemcomentario',$c->id)}}">{{$c->nome}}</a>
                                    </h2>
                                    <p style="max-width: 30ch;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    white-space: nowrap;" class="desc-content">{{$c->descricao}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-custom">
                            <div class="toolbar-bottom mt-30">
                                @if(count($noticia))
                                {{ $noticia->links('livewire.livewire-pagination-links') }}
                                @endif
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
