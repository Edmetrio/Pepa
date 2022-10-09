<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">{{Route::currentRouteName()}}</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Estoque</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-main-area">
        <div class="container container-default custom-area">
            <div class="row" style="margin-bottom: 5%">
                    <div class="col-lg-9 col-12 col-custom widget-mt">
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                
                        @include('livewire.fornecedores.create')

                    {{-- <table class="table-responsive-sm table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Pais</th>
                                <th>Província</th>
                                <th>Distrito</th>
                                <th>Quantidade</th>
                                <th>Criação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estoque as $post)
                            <tr>
                                <td>{{ $post->produtos->nome}}</td>
                                <td>{{ $post->pais->nome }}</td>
                                <td>{{ $post->provincias->nome }}</td>
                                <td>{{ $post->distritos->nome }}</td>
                                <td>{{ $post->quantidade }}</td>
                                <td>{{ $post->created_at->diffForhumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($estoque))
                    {{ $estoque->links('livewire.livewire-pagination-links') }}
                    @endif --}}
                </div>
                {{-- @include('livewire.menu') --}}
            </div>
        </div>
    </div>
            </div>
</div>
