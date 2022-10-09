<div>
    @include('livewire.entidade')
    @if($mostrar === true)
    <div class="modal fade" id="documentoModal" data-backdrop="static" data-keyboard="" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="staticBackdropLabel" >Entidade e Referência</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <h3>Dados de pagamento</h3>
                    <div class="row">
                        <div class="col-12 col-md-6">Entidade: </div>
                        <div class="col-6 col-md-6" >909878</div>
                        <div class="col-12 col-md-6">Referência:</div>
                        <div class="col-6 col-md-6" >1099761700</div>
                        <div class="col-12 col-md-6">Montante:</div>
                        <div class="col-6 col-md-6" >{{$item->ttotal}},00 MZN</div>
                    </div>
                    {{-- <ol class="col-sm">
                        <li>Entidade: </li>
                        <li>Referência: </li>
                        <li>Montante: {{$item->total}} MZN</li>
                    </ol> --}}
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Descordo</button> -->
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Entendi</button>
                </div>
            </div>
        </div>
    </div>
    @else
        
    @endif
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Pagamento</h3>
                        <ul>
                            <li><a href="{{url('/')}}">Início</a></li>
                            <li>Tipos de Pagamento</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    
    <div class="checkout-area">
        <div class="container container-default-2 custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        <h3>Pagammento Via Cartão de Crédito/Débito <span id="showlogin">Clica aqui</span></h3>
                        {{-- <div id="checkout-login" class="coupon-content"> --}}
                            <div class="coupon-info">
                                <!-- <form method="post" action="{{url('encomenda')}}"> -->
                                @csrf
                                <div class="checkbox-form">
                                    <h3>Detalhes de Pagamento</h3>
                                    <div class="row">
                                        <form>
                                        <div class="col-md-6">
                                            <div class="your-order-table table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="cart-product-name">Produtos</th>
                                                            <th class="cart-product-name">Icon</th>
                                                            <th class="cart-product-total">Quantidade</th>
                                                            <th class="cart-product-total">Preço</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($item as $p)
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name"> {{$p->produtos->nome}}<strong class="product-quantity">
                                                                </strong></td>
                                                            <td><img class="img-fluid" src="assets/images/produto/{{$p->produtos->icon}}" alt="{{$p->produtos->nome}}" style="width: 40px;" /></td>
                                                            <td class="cart-product-total text-center"><span class="amount"><strong class="product-quantity">
                                                                        {{$p->quantidade}}</strong> </span></td>
                                                            <td class="cart-product-total text-center">{{$p->produtos->preco_retalho}} MZN</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="cart-subtotal">
                                                            <th>Subtotal na Carrinha</th>
                                                            <td class="text-center"><span class="amount">{{$item->total}} MZN</span></td>
                                                        </tr>
                                                        <tr class="order-total">
                                                            <th>Transporte</th>
                                                            <td class="text-center"><strong><span class="amount">{{$item->totaltransporte}} MZN</span></strong></td>
                                                        </tr>
                                                        <tr class="order-total">
                                                            <th>Total em Metical</th>
                                                            <td class="text-center"><strong><span class="amount">{{$item->ttotal}} MZN</span></strong></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <p>
                                            Pagamento Entidade e Referencia clica? <a href="" data-toggle="modal" data-target="#documentoModal" class="primary-btn" style="color: green">Aqui</a>
                                            </p>
                                            <div class="different-address">
                                                <div class="col-xs-12 col-sm-12 col-md-6 mb-2">
                                                    <strong>Forma de pagamento</strong>
                                                    <select class="form-select" aria-label="Default select example" wire:model="formapagamento_id">
                                                        <option selected>Seleccione a forma de pagamento</option>
                                                        @foreach($pagamento as $p)
                                                        <option value="{{$p->id}}">{{$p->nome}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pais_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="order-button-payment" style="margin: 2%">
                                                    <button {{-- onclick="visaLightBox('', 'TEST_TR005', 'KM-CLIENT', '222');" --}} wire:click.prevent="store()" 
                                                        class="btn obrien-button primary-btn d-block">Pagar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>  
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
