<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Categoria</h3>
                        <ul>
                            <li><a href="{{ Route('/')}}">Início</a></li>
                            <li>Categoria</li>
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
                        @include('livewire.categorias.update')
                    @else
                        @include('livewire.categorias.create')
                    @endif

                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Image</th>
                                <th>Descrição</th>
                                <th>Criação</th>
                                <th width="250">Acções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoria as $post)
                            <tr>
                                <td>{{ $post->nome }}</td>
                                <td><img class="img-fluid" src="{{asset('assets/images/categoria/'.$post->icon)}}" width="75" /></td>
                                <td>{{ $post->descricao }}</td>
                                <td>{{ $post->created_at->diffForhumans() }}</td>
                                <td>
                                <button wire:click="edit('{{ $post->id }}')" class="btn btn-primary btn-sm">Alterar</button>
                                <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3 col-12 col-custom">
                    <!-- Sidebar Widget Start -->
                    <aside class="sidebar_widget widget-mt">
                        <div class="widget_inner">
                            <div class="widget-list widget-mb-1">
                                <h3 class="widget-title">Lista das Funcionalidades</h3>
                                <!-- Widget Menu Start -->
                                <nav>
                                    <ul class="mobile-menu p-0 m-0">
                                        <li class="menu-item-has-children"><a href="#">Breads</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Skateboard (02)</a></li>
                                                <li><a href="#">Surfboard (4)</a></li>
                                                <li><a href="#">Accessories (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Fruits</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Samsome</a></li>
                                                <li><a href="#">GL Stylus (4)</a></li>
                                                <li><a href="#">Uawei (3)</a></li>
                                                <li><a href="#">Avocado (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Vagetables</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Power Bank</a></li>
                                                <li><a href="#">Data Cable (4)</a></li>
                                                <li><a href="#">Avocado (3)</a></li>
                                                <li><a href="#">Brocoly (3)</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Organic Food</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Vagetables</a></li>
                                                <li><a href="#">Green Food (4)</a></li>
                                                <li><a href="#">Coconut (3)</a></li>
                                                <li><a href="#">Cabage (3)</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
