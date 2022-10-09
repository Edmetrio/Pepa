<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Aumento no Estoque</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Aumento no Estoque</li>
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
                        @include('livewire.itemestoques.update')
                    @else
                        @include('livewire.itemestoques.create')
                    @endif

                    <table class="table-responsive-sm table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Fornecedor</th>
                                <th>Utilizador</th>
                                <th>País</th>
                                <th>Distrito</th>
                                <th>Montante</th>
                                <th>Criação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemestoque as $post)
                            <tr>
                                <td>{{ $post->estoques->produtos->nome}}</td>
                                <td>{{ $post->quantidade }}</td>
                                <td>{{ $post->userss->name }}</td>
                                <td>{{ $post->usersc->name }}</td>
                                <td>{{ $post->estoques->pais->nome }}</td>
                                <td>{{ $post->estoques->distritos->nome }}</td>
                                <td>{{ $post->valor }}</td>
                                <td>{{ $post->created_at->diffForhumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- @if(count($estoque))
                    {{ $estoque->links('livewire.livewire-pagination-links') }}
                    @endif --}}
                </div>
                @include('livewire.menu')
            </div>
        </div>
    </div>
</div>
