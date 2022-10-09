<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Utilizadores</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Utilizadores</li>
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
                
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('/') }}"> Início</a>
                            </div>
                        </div>
                    </div>

                    @if($updateMode)
                    @include('livewire.users.update')
                    @else
                    @include('livewire.users.create')
                    @endif
                    
                    
                    <div class="col-8">
                        <div class="form-group" style="margin-top: 10%">
                            <label for="exampleFormControlInput1">Pesquisar</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome do Utilizador" wire:model="search">
                        </div>
                </div>


                    <table class="table-responsive-sm table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Role</th>
                                <th>Criação</th>
                                <th width="160">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $post)
                            <tr>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->email }}</td>
                                <td>{{ $post->roles->nome }}</td>
                                <td>{{ $post->created_at->diffForhumans() }}</td>
                                <td>
                                <button wire:click="edit('{{ $post->id }}')" class="btn btn-primary btn-sm">Alterar</button>
                                <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($users))
                    {{ $users->links('livewire.livewire-pagination-links') }}
                    @endif
                </div>
                @include('livewire.menu')
            </div>
        </div>
    </div>
</div>
