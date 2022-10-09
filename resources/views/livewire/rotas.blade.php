<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Rota</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Rota</li>
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
                        @include('livewire.rotas.update')
                    @else
                        @include('livewire.rotas.create')
                    @endif

                    {{-- <div class="container">
                        <div class="row">
                            <div class="form-group col-6">
                                    <label for="exampleFormControlInput1">Utilizador:</label>
                                    <select class="form-control" wire:model="selectedUsers">
                                        <option>Seleccione o User</option>
                                        @foreach($user as $r)
                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedUsers') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput1">Pesquisar:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Rota" wire:model="search">
                                @error('search') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div> --}}
                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Criação</th>
                                <th width="250">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rota as $post)
                            <tr>
                                <td>{{ $post->nome }}</td>
                                <td>{{ $post->created_at->diffForhumans() }}</td>
                                <td>
                                <button wire:click="edit('{{ $post->id }}')" class="btn btn-primary btn-sm">Alterar</button>
                                <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($rota))
                    {{ $rota->links('livewire.livewire-pagination-links') }}
                    @endif
                </div>
                @include('livewire.menu')
            </div>
        </div>
    </div>
</div>
