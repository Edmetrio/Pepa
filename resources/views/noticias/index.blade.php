@extends('layout')
     
@section('content')

<div class="breadcrumbs-area position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content position-relative section-content">
                    <h3 class="title-3">Notícias</h3>
                    <ul>
                        <li><a href="{{ Route('/')}}">Início</a></li>
                        <li>Notícias</li>
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
            
                <div class="row" style="margin: 2%">
                    <div class="col-lg-12">
                        <div class="pull-left">
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('noticia.create')}}"> Adicionar </a>
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
                        <th>Nr.</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th class="text-center" width="200px">Acções</th>
                    </tr>
                    @foreach ($noticia as $product)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><img src="{{asset('assets/images/noticia/'.$product->icon)}}" width="100px"></td>
                        <td>{{ $product->nome }}</td>
                        <td>{{ $product->descricao }}</td>
                        <td>
                            <form action="{{ route('noticia.destroy',$product->id) }}" method="POST">
                 
                
                                <a class="btn btn-primary" href="{{ route('noticia.edit',$product->id) }}">Alterar</a>
                 
                                @csrf
                                @method('DELETE')
                    
                                <button type="submit" class="btn btn-danger">Apagar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {!! $noticia->links() !!}
            </div>
            @include('menu');
        </div>
    </div>
</div>

@endsection