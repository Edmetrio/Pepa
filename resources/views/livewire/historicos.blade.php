<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">{{ Route::currentRouteName()}}</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Telefone</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-main-area">
        <div class="container container-default custom-area">
            <div class="row">
                    <div class="col-lg-9 col-12 col-custom widget-mt">
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="table table-bordered mt-5">
                        <thead>
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
                            @foreach($encomenda as $post)
                                @foreach($post->produtos as $item)
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
                    {{-- @if(count($encomenda))
                    {{ $encomenda->links('livewire.livewire-pagination-links') }}
                    @endif --}}
                </div>
                <div class="col-lg-3 col-12 col-custom">
                    <!-- Sidebar Widget Start -->
                    <aside class="sidebar_widget widget-mt">
                        <div class="widget_inner">
                            <div class="widget-list widget-mb-1">
                                <h3 class="widget-title">Lista das Funcionalidades</h3>
                                <!-- Widget Menu Start -->
                                <nav>
                                    <ul class="mobile-menu p-0 m-0">
                                        <li class="menu-item-has-children"><a href="#">Breads</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Skateboard (02)</a></li>
                                                <li><a href="#">Surfboard (4)</a></li>
                                                <li><a href="#">Accessories (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Fruits</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Samsome</a></li>
                                                <li><a href="#">GL Stylus (4)</a></li>
                                                <li><a href="#">Uawei (3)</a></li>
                                                <li><a href="#">Avocado (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Vagetables</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Power Bank</a></li>
                                                <li><a href="#">Data Cable (4)</a></li>
                                                <li><a href="#">Avocado (3)</a></li>
                                                <li><a href="#">Brocoly (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Organic Food</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Vagetables</a></li>
                                                <li><a href="#">Green Food (4)</a></li>
                                                <li><a href="#">Coconut (3)</a></li>
                                                <li><a href="#">Cabage (3)</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
