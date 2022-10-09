@extends('layout')
     
@section('content')

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
            
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('categoria.create') }}"> Create New Product</a>
                        </div>
                    </div>
                </div>

                {{-- @if($updateMode)
                @include('livewire.users.update')
                @else
                @include('livewire.users.create')
                @endif --}}

                <table class="table table-bordered" >
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($categoria as $product)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><img src="{{asset('assets/images/categoria/'.$product->icon)}}" width="100px"></td>
                        <td>{{ $product->nome }}</td>
                        <td>{{ $product->descricao }}</td>
                        <td>
                            <form action="{{ route('categoria.destroy',$product->id) }}" method="POST">
                 
                                <a class="btn btn-info" href="{{ route('categoria.show',$product->id) }}">Show</a>
                  
                                <a class="btn btn-primary" href="{{ route('categoria.edit',$product->id) }}">Edit</a>
                 
                                @csrf
                                @method('DELETE')
                    
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                
                {!! $categoria->links() !!}

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
                                    <li class="menu-item-has-children"><a href="#">Utilizadores</a>
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

@endsection