<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">{{ Route::currentRouteName()}}</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Distrito</li>
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
                        @include('livewire.distritos.update')
                    @else
                        @include('livewire.distritos.create')
                    @endif

                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Distrito</th>
                                <th>Província</th>
                                <th>País</th>
                                <th width="170">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($distrito as $post)
                            <tr>
                                <td>{{ $post->nome }}</td>
                                <td>{{ $post->provincias->nome ?? ''}}</td>
                                <td>{{ $post->provincias->pais->nome ?? ''}}</td>
                                <td>
                                <button wire:click="edit('{{ $post->id }}')" class="btn btn-primary btn-sm">Alterar</button>
                                <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>   
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('livewire.menu');
            </div>
        </div>
    </div>
     </div>
</div>
