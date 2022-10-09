<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="text-uppercase">Produtos Importados</h3>
                        <ul>
                            <li><a href="{{url('/')}}">Início</a></li>
                            <li>Todos Produtos Importados</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-main-area shop-fullwidth">
        <div class="container container-default custom-area">
            <div class="row flex-row-reverse">
                <div class="col-12 col-custom widget-mt">
    <div class="col-lg-7 col-custom">
        <div class="product-summery position-relative">
            <form>
                <div class="col-xs-6 col-sm-12 col-md-12 mb-4">
                    <div class="col-xs-6 col-sm-12 col-md-12 mb-2">
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
                    <div class="col-xs-6 col-sm-12 col-md-12 mb-2">
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
                    <div class="col-xs-6 col-sm-12 col-md-12 mb-2">
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
            </form>
        </div>
    </div>

    @if($Mode === true)
    <div class="row shop_wrapper grid_4">
        @foreach($produto as $p)
        <div class="col-lg-3 col-md-6 col-sm-6 col-custom product-area mb-20">
            <div class="single-product position-relative" style="border: 2px solid #0E6A3A; border-radius: 15px">
                <div class="product-image">
                    <a class="d-block" href="{{Route('item',$p->produtos->id)}}">
                        <img src="assets/images/produto/{{$p->produtos->icon}}" alt="" class="product-image-1 w-100">
                    </a>
                </div>
                <div class="product-content">
                    <div class="product-title">
                        <h4 class="title-2"> <a href="{{Route('item',$p->produtos->id)}}">{{$p->produtos->nome}}</a></h4>
                    </div>
                    <div class="price-box">
                        <span class="regular-price ">{{$p->produtos->preco_retalho}} MZN</span>
                    </div>
                </div>
                <div class="add-action d-flex position-absolute">
                    <a href={{url("detalhes/$p->id")}} title="Adicionar na Carrinha">
                        <i class="ion-bag"></i>
                    </a>
                    <!-- <a href="#" title="Add To Wishlist">
                        <i class="ion-ios-heart-outline"></i>
                    </a> -->
                    <a href="#{{$p->produtos->nome}}" data-toggle="modal" title="Visão Rápida">
                        <i class="ion-eye"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        @include('livewire.importados.index')
    @endif

                </div>
            </div>
        </div>
    </div>
</div>
