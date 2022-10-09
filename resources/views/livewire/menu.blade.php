<div class="col-lg-3 col-12 col-custom">
    <aside class="sidebar_widget widget-mt">
        <div class="widget_inner">
            <div class="widget-list widget-mb-1">
                <h3 class="widget-title">Lista das Funcionalidades</h3>
                <nav>
                    <ul class="mobile-menu p-0 m-0">
                        <li class="menu-item-has-children"><a href="#">Credenciais</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('user')}}">Utilizadores</a></li>
                                <li><a href="{{ route('rota')}}">Rota</a></li>
                                <li><a href="{{ route('role')}}">Role</a></li>
                                <li><a href="{{ route('permissao')}}">Permissão</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Gerir Artigos</a>
                            <ul class="dropdown">
                                <li><a href="{{ url('categorias')}}">Categoria</a></li>
                                <li><a href="{{ url('produtos')}}">Produto</a></li>
                                <li><a href="{{ route('estoque')}}">Estoque</a></li>
                                <li><a href="{{ route('itemcarrinha')}}">Item Carrinha</a></li>
                                <li><a href="{{ route('itemestoque')}}">Aumento no Estoque</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Transportadora</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('transportadora')}}">Processo Transportadora</a></li>
                                <li><a href="{{ route('transportador')}}">Transportadora</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Extensionista</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('extensionista')}}">Extensionista</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Noticias</a>
                            <ul class="dropdown">
                                <li><a href="{{ url('noticia')}}">Notícia</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Destinos</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('pais')}}">País</a></li>
                                <li><a href="{{ route('provincia')}}">Província</a></li>
                                <li><a href="{{ route('distrito')}}">Distrito</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </aside>
</div>