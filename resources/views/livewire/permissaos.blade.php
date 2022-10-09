<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Permissão</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Permissão</li>
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
                        @include('livewire.permissao.update')
                    @else
                        @include('livewire.permissao.create')
                    @endif

                    <table class="table-responsive-sm table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Rota</th>
                                <th>Criação</th>
                                <th width="250">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissao as $post)
                            <tr>
                                <td>{{ $post->roles->nome }}</td>
                                <td>{{ $post->rotas->nome }}</td>
                                <td>{{ $post->created_at->diffForhumans() }}</td>
                                <td>
                                <button wire:click="edit('{{ $post->id }}')" class="btn btn-primary btn-sm">Alterar</button>
                                <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($permissao))
                    {{ $permissao->links('livewire.livewire-pagination-links') }}
                    @endif
                </div>
                @include('livewire.menu')
            </div>
        </div>
    </div>
</div>
