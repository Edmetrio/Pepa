<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">{{ Route::currentRouteName()}}</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Entrada no Estoque</li>
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
                
                    @if($updateMode)
                    @else
                        @include('livewire.entradas.create')
                    @endif

                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Users</th>
                                <th>Distrito</th>
                                <th>Provincia</th>
                                <th>País</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item as $post)
                            <tr>
                                <td>{{ $post->estoques->produtos->nome}}</td>
                                <td>{{ $post->quantidade}}</td>
                                <td>{{ $post->valor}}</td>
                                <td>{{ $post->users->name}}</td>
                                <td>{{ $post->estoques->distritos->nome}}</td>
                                <td>{{ $post->estoques->provincias->nome}}</td>
                                <td>{{ $post->estoques->pais->nome}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('livewire.menu')
            </div>
        </div>
    </div>
            </div>
</div>
