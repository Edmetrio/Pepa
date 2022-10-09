<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Detalhes de {{$itens->nome}}</h3>
                        <ul>
                            <li><a href="{{url('/')}}">Ínicio</a></li>
                            <li>Detalhes de {{$itens->nome}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    
    <div class="single-product-main-area">
        <div class="container container-default custom-area mb-20">
            {{-- @if ($message = Session::get('status'))
            <div>
                <p class="alert alert-success" class="table p-field p-col-12 p-md-6 table-striped" style="text-align: center;">{{ $message }}</p>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Opss!</strong> Algum problema com seu formulário<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <div class="row">
                <div class="col-lg-5 col-custom">
                    <div class="product-details-img horizontal-tab">
                        <div class="product-slider popup-gallery product-details_slider" data-slick-options='{
                            "slidesToShow": 1,
                            "arrows": false,
                            "fade": true,
                            "draggable": false,
                            "swipe": false,
                            "asNavFor": ".pd-slider-nav"
                            }'>
                            <div class="single-image border">
                                <a href="{{asset('assets/images/produto/'.$itens->icon)}}">
                                    <img src="{{asset('assets/images/produto/'.$itens->icon)}}" alt="{{$itens->nome}}">
                                </a>
                            </div>
                           {{--  @foreach($produtos as $p)
                            <div class="single-image border">
                                <a href="{{asset('assets/images/produto/'.$p->icon)}}">
                                    <img src="{{asset('assets/images/produto/'.$p->icon)}}" alt="{{$p->nome}}">
                                </a>
                            </div>
                            @endforeach --}}
                        </div>
                        <div class="pd-slider-nav product-slider" data-slick-options='{
                            "slidesToShow": 4,
                            "asNavFor": ".product-details_slider",
                            "focusOnSelect": true,
                            "arrows" : false,
                            "spaceBetween": 30,
                            "vertical" : false
                            }' data-slick-responsive='[
                                {"breakpoint":1501, "settings": {"slidesToShow": 4}},
                                {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                                {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                {"breakpoint":575, "settings": {"slidesToShow": 3}}
                            ]'>
                            {{-- @foreach($produtos as $p)
                            <div class="single-image border">
                                <a href="{{asset('assets/images/produto/'.$p->icon)}}">
                                    <img src="{{asset('assets/images/produto/'.$p->icon)}}" alt="{{$p->nome}}">
                                </a>
                            </div>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-7 col-custom">
                    <div class="product-summery position-relative">
                        <div class="product-head mb-3">
                            <h2 class="product-title">{{$itens->nome}}</h2>
                        </div>
                        <div class="price-box mb-2">
                            <span class="regular-price">{{$itens->preco_retalho}} MZN</span>
                        </div>
                        {{-- <div class="price-box" style="margin-top: -2%"> --}}
                            @if (!is_null($selectedDistrito))
                            <span class="regular-price">
                                <p>Quantidade: {{$quantidades->quantidade ?? 'Sem Estoque'}}</p>
                            @endif
                        </span>
                        {{-- </div> --}}
                        <p class="desc-content mb-2">{{$itens->descricao}}</p>
                        <form>
                            <div class="col-xs-6 col-sm-12 col-md-12 mb-4">
                                <div class="col-xs-6 col-sm-12 col-md-6 mb-2">
                                    <strong>País</strong>
                                    <select class="form-select" aria-label="Default select example" wire:model="selectedPais">
                                        <option selected>Seleccione o país</option>
                                        @foreach($pais as $p)
                                        <option value="{{$p->pais->id}}">{{$p->pais->nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('pais_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                
                                @if (!is_null($selectedPais))
                                <div class="col-xs-6 col-sm-12 col-md-6 mb-2">
                                    <strong>Província</strong>
                                    <select class="form-select" aria-label="Default select example" wire:model="selectedProvincia">
                                        <option selected>Seleccione a província</option>
                                        @foreach($provincias as $p)
                                        <option value="{{$p->provincias->id}}">{{$p->provincias->nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('provincia_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                @endif
    
                                @if (!is_null($selectedProvincia))
                                <div class="col-xs-6 col-sm-12 col-md-6 mb-2">
                                    <strong>Distrito</strong>
                                    <select class="form-select" aria-label="Default select example" wire:model="selectedDistrito">
                                        <option selected>Seleccione o distrito</option>
                                        @foreach($distritos as $d)
                                        <option value="{{$d->distritos->id}}">{{$d->distritos->nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('distrito_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                @endif
                            </div>
    
                            

                            @if ($show === true)
                                <div class="col-sm-12 col-md-6 form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="transporte" id="flexCheckDefault" checked wire:click="transporte({{('false')}})">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Incluir Transporte
                                    </label>
                                </div>
                                <div class="col-xs-6 col-sm-12 col-md-6 mb-2">
                                    <strong>Endereço</strong>
                                    <select class="form-select" aria-label="Default select example" wire:model="endereco_id">
                                        <option selected>Seleccione o Endereço</option>
                                        @foreach($endereco as $d)
                                        <option value="{{$d->id}}">{{$d->nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('distrito_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @else
                            <div class="col-sm-12 col-md-6 form-check">
                                <input class="form-check-input" type="checkbox" wire:model="transporte" id="flexCheckDefault" wire:click="transporte({{('true')}})">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Incluir Transporte
                                </label>
                            </div>
                            @endif
                            
                           <div class="quantity-with_btn mt-4 mb-2">
                                <div class="quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" value="1" wire:model="quantidade">
                                        <div class="dec qtybutton">-</div>
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                    @error('quantidade') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button class="btn obrien-button primary-btn" wire:click.prevent="store()">Adicionar</button>
                            </div>
                        </form>
                    </div>
                    <div class="buy-button mb-5">
                        <a href={{url("pagamento")}} class="btn obrien-button-3 black-button"><strong> Comprar Agora</strong></a>
                    </div>
                    <div class="social-share mb-4">
                        <span>Mostrar :</span>
                        <a href="https://firsteducation.edu.mz/"><i class="fa fa-facebook-square facebook-color"></i></a>
                        <a href="https://firsteducation.edu.mz/"><i class="fa fa-twitter-square twitter-color"></i></a>
                        <a href="https://firsteducation.edu.mz/"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                        <a href="https://firsteducation.edu.mz/"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                    </div>
                    <div class="payment">
                        <a href="#"><img class="border" src="{{asset('assets/images/payment/pagamentos.png')}}" alt="Payment"></a>
                    </div>
                </div>
            </div>
        </div>
       {{--  <div class="row mt-no-text">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-itens">
                        <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Descrição</a>
                    </li>
                    <li class="nav-itens">
                        <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#connect-2" role="tab" aria-selected="false">Avaliações</a>
                    </li>
                    <li class="nav-itens">
                        <a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Política de Envio</a>
                    </li>
                    <li class="nav-itens">
                        <a class="nav-link text-uppercase" id="review-tab" data-toggle="tab" href="#connect-4" role="tab" aria-selected="false">Tamanhos</a>
                    </li>
                </ul>
                <div class="tab-content mb-text" id="myTabContent">
                    <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="desc-content">
                            <p class="mb-3">Descrição</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Start Single Content -->
    
                        <!-- End Single Content -->
                    </div>
                    <div class="tab-pane fade" id="conn ect-3" role="tabpanel" aria-labelledby="contact-tab">
    
                    </div>
                    <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    </div>
</div>
