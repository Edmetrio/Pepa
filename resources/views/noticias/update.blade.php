@extends('layout')
     
@section('content')

<div class="breadcrumbs-area position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content position-relative section-content">
                    <h3 class="title-3">Notícia</h3>
                    <ul>
                        <li><a href="{{ Route('/')}}">Início</a></li>
                        <li>Notícia</li>
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
            <h2>Alterar Notícia</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('noticia.index') }}"> Voltar</a>
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

<form action="{{ route('noticia.update',$noticias->id) }}" method="POST" enctype="multipart/form-data"> 
    @csrf
    @method('PUT')
 
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                <input type="text" name="nome" value="{{ $noticias->nome }}" class="form-control" placeholder="Nome">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descrição:</strong>
                <textarea class="form-control" style="height:150px" name="descricao" placeholder="Descricao">{{ $noticias->descricao }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Imagem:</strong>
                <input type="file" name="icon" class="form-control" placeholder="icon">
                <img src="{{asset('assets/images/noticia/'.$noticias->icon)}}" width="300px">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Símbolo:</strong>
                <input type="file" name="simbolo" class="form-control" placeholder="simbolo">
                <img src="{{asset('assets/images/noticia/'.$noticias->simbolo)}}" width="300px">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Link:</strong>
                <input type="text" name="link" value="{{ $noticias->link }}" class="form-control" placeholder="Link...">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin: 2%">
          <button type="submit" class="btn btn-primary">Alterar</button>
        </div>
    </div>
 
</form>

</div>
@include('menu');
</div>
</div>
</div>
@endsection