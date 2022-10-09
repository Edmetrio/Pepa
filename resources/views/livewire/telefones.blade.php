<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Telefone</h3>
                        <ul>
                            <li><a href="{{ Route('/') }}">Início</a></li>
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

                    @if ($updateMode)
                        @include('livewire.telefones.update')
                    @else
                        @include('livewire.telefones.create')
                    @endif

                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Carteira</th>
                                <th>Número</th>
                                <th width="170">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($telefone as $post)
                                <tr>
                                    <td>{{ $post->carteiras->nome }}</td>
                                    <td>{{ $post->numero }}</td>
                                    <td>
                                        <button wire:click="edit('{{ $post->id }}')"
                                            class="btn btn-primary btn-sm">Alterar</button>
                                        <button wire:click="delete('{{ $post->id }}')"
                                            class="btn btn-danger btn-sm">Deletar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
