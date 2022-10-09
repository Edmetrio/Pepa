<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Endereço</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Endereço</li>
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
                        @include('livewire.enderecos.update')
                    @else
                        @include('livewire.enderecos.create')
                    @endif

                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Pais</th>
                                <th>Província</th>
                                <th>Distrito</th>
                                <th>Número</th>
                                <th width="170">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($endereco as $post)
                            <tr>
                                <td>{{ $post->distritos->provincias->pais->nome}}</td>
                                <td>{{ $post->distritos->provincias->nome}}</td>
                                <td>{{ $post->distritos->nome}}</td>
                                <td>{{ $post->nome }}</td>
                                <td>
                                <button wire:click="edit('{{ $post->id }}')" class="btn btn-primary btn-sm">Alterar</button>
                                <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>   
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- @include('menu'); --}}
            </div>
        </div>
    </div>
     </div>
</div>
