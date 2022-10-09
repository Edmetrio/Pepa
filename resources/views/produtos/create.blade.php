@extends('layout')
     
@section('content')

<div class="breadcrumbs-area position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content position-relative section-content">
                    <h3 class="title-3">Produto</h3>
                    <ul>
                        <li><a href="{{ Route('/')}}">Início</a></li>
                        <li>Produto</li>
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
    <div class="col-lg-12 margin-tb" style="margin: 2%">
        <div class="pull-left">
            <h2>Adicionar Produtos</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('produtos.index') }}"> Voltar</a>
        </div>
    </div>
</div>
     
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     
<form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoria:</strong>
                <select class="form-control" name="categoria_id">
                    <option>Seleccione a categoria</option>
                    @foreach($categoria as $r)
                    <option value="{{ $r->id }}">{{ $r->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                <input type="text" name="nome" class="form-control" placeholder="Nome">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Preco a Retalho:</strong>
                <input type="text" name="preco_retalho" class="form-control" placeholder="Preço à Retalho">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Preço a Grosso:</strong>
                <input type="text" name="preco_grosso" class="form-control" placeholder="Preço a Grosso">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descrição:</strong>
                <textarea class="form-control" style="height:150px" name="descricao" placeholder="Descrição"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Imagem:</strong>
                <input type="file" name="icon" class="form-control" placeholder="icon">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin: 2%">
                <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </div>
     
</form>

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