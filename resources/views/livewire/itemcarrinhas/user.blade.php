 <table class="table-responsive-sm table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Estado</th>
                            <th>Users</th>
                            <th>Distrito</th>
                            <th>Provincia</th>
                            <th>País</th>
                            <th>Criação</th>
                            <th>Acções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $post)
                        <tr>
                            <td>{{ $post->produtos->nome}}</td>
                            <td>{{ $post->quantidade }}</td>
                            <td>{{ $post->estado }}</td>
                            <td>{{ $post->users->name }}</td>
                            <td>{{ $post->distritos->nome }}</td>
                            <td>{{ $post->distritos->provincias->nome }}</td>
                            <td>{{ $post->distritos->provincias->pais->nome }}</td>
                            <td>{{ $post->created_at->diffForhumans() }}</td>
                            <td>
                                <button wire:click="delete('{{ $post->id }}')" class="btn btn-danger btn-sm">Deletar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>