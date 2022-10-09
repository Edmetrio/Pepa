<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Item Carrinha</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Item Carrinha</li>
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

                        <div class="container">
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
                                    <label for="exampleFormControlInput1">Produto:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Banana" wire:model="produto">
                                    @error('produto') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                    @if($Mode === true)
                    <table class="table-responsive-sm table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Users</th>
                                <th>Distrito</th>
                                <th>Provincia</th>
                                <th>País</th>
                                <th>Criação</th>
                                <th>Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item as $post)
                            <tr>
                                <td>{{ $post->produtos->nome}}</td>
                                <td>{{ $post->quantidade }}</td>
                                <td>{{ $post->users->name }}</td>
                                <td>{{ $post->distritos->nome }}</td>
                                <td>{{ $post->distritos->provincias->nome }}</td>
                                <td>{{ $post->distritos->provincias->pais->nome }}</td>
                                <td>{{ $post->created_at->diffForhumans() }}</td>
                                <td>
                                    <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($item))
                    {{ $item->links('livewire.livewire-pagination-links') }}
                    @endif
                    @else
                        @include('livewire.itemcarrinhas.user')
                    @endif
                </div>
                @include('livewire.menu')
            </div>
        </div>
    </div>
</div>
