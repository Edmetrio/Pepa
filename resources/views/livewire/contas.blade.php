<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Minha Conta</h3>
                        <ul>
                            <li><a href="{{Route('inicio')}}">Início</a></li>
                            <li>Minha Conta</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-wrapper mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">

                    <div class="myaccount-page-wrapper">

                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-custom">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                        Dashboard</a>
                                    <a href="#orders" data-toggle="tab" {{-- wire:click.prevent="press()" --}}><i class="fa fa-cart-arrow-down"></i>
                                        Histórico de Compras</a>
                                    <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i>
                                        Lista de Contactos</a>
                                   {{-- <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i>
                                                Payment
                                                Method</a> --}}
                                    <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i>
                                        Meus Endereços</a>
                                    <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Adicionar
                                        Endereço</a>
                                    <a href="#account-inf" data-toggle="tab"><i class="fa fa-user"></i> Adicionar
                                        Avatar</a>
                                    <a href="#account" data-toggle="tab"><i class="fa fa-user"></i> Adicionar
                                        Telefone</a>
                                    <a href="login.html"><i class="fa fa-sign-out"></i> Terminar Sessão</a>
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-8 col-custom">
                                <div class="tab-content" id="myaccountContent">

                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Meu Perfil</h3>
                                            <div class="welcome">
                                                <p>Olá, <strong>{{ Auth::user()->name}}</strong> (Se não for <strong>{{ Auth::user()->name}} !</strong><a href="{{Route('logout')}}" class="logout"> Termina a Sessão</a>)</p>
                                            </div>
                                            <p class="mb-0">No painel da sua conta. Você pode ver o seu histórico de compras, os seus endereços e telefones</p>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Histórico de Compras</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Imagem</th>
                                                            <th>Produto</th>
                                                            <th>Preco</th>
                                                            <th>Quantidade</th>
                                                            <th>Subtotal</th>
                                                            <th>Data</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($encomenda as $p)
                                                            @foreach($p->produtos as $item)
                                                                <tr>
                                                                    <td><img style="width: 50px;" src="{{asset('assets/images/produto/'.$item->icon)}}"></td>
                                                                    <td>{{$item->nome}}</td>
                                                                    <td>{{$item->preco_retalho}}</td>
                                                                    <td>{{$item->pivot->quantidade}}</td>
                                                                    <td>{{$item->subtotal}}</a></td>
                                                                    <td>{{$item->created_at->diffForhumans() }}</a></td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="download" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Lista Telefônicas</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Número</th>
                                                            <th>Operadora</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            @foreach($telefone as $t)
                                                            <tr>
                                                            <td>{{$t->numero}}</td>
                                                            <td>{{$t->carteiras->nome ?? ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div> --}}

                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Meus Endereços</h3>
                                            <address>
                                                @foreach($endereco as $e)
                                                <strong>Endereço: </strong>{{$e->nome}} <br>
                                                <strong>Distrito: </strong>{{$e->distritos->nome}} <br>
                                                <strong>Província: </strong>{{$e->distritos->provincias->nome}} <br>
                                                <strong>País: </strong>{{$e->distritos->provincias->pais->nome}} <br><br>
                                                @endforeach
                                            </address>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Endereço</h3>
                                            <div class="account-details-form">
                                                <form>
                                                    <div class="single-input-item single-item-button">
                                                        <a href="{{Route('endereco')}}" class="btn obrien-button primary-btn" >Adicionar</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="tab-pane fade" id="account-inf" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Avatar</h3>
                                            <div class="account-details-form">
                                                <form>
                                                    <div class="single-input-item single-item-button">
                                                        <a href="{{Route('avatar.index')}}" class="btn obrien-button primary-btn" >Adicionar</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
    
                                    {{-- @if($contacto == true) --}}
                                    <div class="tab-pane fade" id="account" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Adicionar Telefone</h3>
                                            <div class="account-details-form">
                                
                                                    <div class="single-input-item single-item-button">
                                                        <a href="{{ Route('telefones')}}" class="btn obrien-button primary-btn">Adicionar</a>
                                                    </div>
                         
                                            </div>
                                        </div>
                                    </div>
                                 
 
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
