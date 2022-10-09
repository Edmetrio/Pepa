<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Entensionista</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Extensionista</li>
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
                        @include('livewire.extensionistas.update')
                    @else
                       {{--  @include('livewire.rotas.create') --}}
                    @endif

                    <table class="table-responsive-sm table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Nome do Fornecedor</th>
                                <th>E-mail do Fornecedor</th>
                                <th>Telefone</th>
                                <th>Nome do Extensionista</th>
                                <th>Situação</th>
                                <th width="100">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($extensionista as $post)
                            <tr>
                                <td>{{ $post->users->name }}</td>
                                <td>{{ $post->users->email }}</td>
                                <td>
                                @foreach($post->users->telefones as $t)
                                {{ $t->numero }}
                                @endforeach
                                </td>
                                <td>{{ $post->extensionistas->nome }}</td>
                                @if($post->situacaos->nome === 'Por avaliar' || $post->situacaos->nome === 'Reprovado')
                                <td style="color: red">{{ $post->situacaos->nome }}</td>
                                @else
                                <td style="color: green">{{ $post->situacaos->nome }}</td>
                                @endif
                                <td>
                                <button wire:click="edit('{{ $post->id }}')" class="btn btn-primary btn-sm">Alterar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($extensionista))
                    {{ $extensionista->links('livewire.livewire-pagination-links') }}
                    @endif
                </div>
                @include('livewire.menu')
            </div>
        </div>
    </div>
</div>
