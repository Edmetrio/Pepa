<div>
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">{{$noticias->nome}}</h3>
                        <ul>
                            <li><a href="{{Route('/')}}">Início</a></li>
                            <li>{{$noticias->nome}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-main-area">
        <div class="container container-default custom-area">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-12 col-custom widget-mt">
                    <!-- Blog Details wrapper Area Start -->
                    <div class="blog-post-details">
                        <figure class="blog-post-thumb mb-5">
                            <img src="{{asset('assets/images/noticia/'.$noticias->icon)}}" alt="{{$noticias->nome}}">
                        </figure>
                        <section class="blog-post-wrapper product-summery">
                            <div class="section-content">
                                <h2 class="title-1 mb-3">{{$noticias->nome}}</h2>
                                <blockquote class="blockquote mb-4">
                                    <p>{{$noticias->descricao}}</p>
                                </blockquote>
                            </div>
                            <div class="">
                                <strong class="text-uppercase">fonte:
                                    <a href="{{$noticias->link}}">
                                        <img src="{{asset('assets/images/noticia/'.$noticias->simbolo)}}" width="100%"  alt="Author">
                                    </a>
                                </strong>    
                            </div>
                            <div class="social-share">
                            </div>
                            <div class="comment-area-wrapper mt-5">
                                <div class="comments-view-area">
                                    <h3 class="mb-5">{{$comentarios->count()}} Comentários</h3>
                                    @foreach($comentarios as $c)
                                    <div class="single-comment-wrap mb-4 d-flex">
                                        <figure class="author-thumb">
                                            <a href="#">
                                                <img src="{{asset('assets/images/user/'. $c->users->icon)}}" alt="avatar">
                                            </a>
                                        </figure>
                                        <div class="comments-info">
                                            <p class="mb-2">{{$c->mensagem}}</p>
                                            <div class="comment-footer d-flex justify-content-between">
                                                <a href="#" class="author"><strong>{{$c->users->name}}</strong> - {{ $c->created_at->diffForhumans() }}</a>
                                                {{-- <a href="#" class="btn-reply"><i class="fa fa-reply"></i> Reply</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-custom">
                                        <div class="toolbar-bottom mt-30">
                                            @if(count($comentarios))
                                            {{ $comentarios->links('livewire.livewire-pagination-links') }}
                                            @endif
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- Blog Details Wrapper Area End -->
                    <!-- Blog Comments Area Start -->
                    <form action="#">
                        <div class="comment-box">
                            <h3>Deixa um comentário</h3>
                            <div class="row">
                                <div class="col-12 col-custom">
                                    <div class="input-item mt-4 mb-4">
                                        <textarea cols="30" rows="5" name="comment" class="border rounded-0 w-100 custom-textarea input-area" placeholder="Mensagem" wire:model="mensagem"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-custom mt-40">
                                    <button type="submit" wire:click.prevent="store()" class="btn obrien-button primary-btn rounded-0 w-100">Comentar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Blog Comments Area End -->
                </div>
                <div class="col-lg-3 col-12 col-custom">
                    <!-- Sidebar Widget Start -->
                    <aside class="sidebar_widget mt-no-text">
                        <div class="widget_inner">
                            <div class="widget-list widget-mb-1">
                                <h3 class="widget-title">Procurar</h3>
                                <div class="search-box">
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model="search" placeholder="Procurar" aria-label="Procurar">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-list widget-mb-4">
                                <h3 class="widget-title">Últimas Notícias</h3>
                                <div class="sidebar-body">
                                    @foreach($ultimas as $u)
                                    <div class="sidebar-product align-items-center">
                                        <a href="product-details.html" class="image">
                                            <img src="{{asset('assets/images/noticia/'.$u->icon)}}" alt="{{$u->nome}}">
                                        </a>
                                        <div class="product-content">
                                            <div class="product-title">
                                                <h4 class="title-2"> <a href="{{Route('itemcomentario',$u->id)}}">{{$u->nome}}</a></h4>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price " style="max-width: 190px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$u->descricao}}</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- Sidebar Widget End -->
                </div>
            </div>
        </div>
    </div>
</div>
