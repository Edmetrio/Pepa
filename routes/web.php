<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Livewire\Carrinhas;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Contas;
use App\Http\Livewire\Distritos;
use App\Http\Livewire\Enderecos;
use App\Http\Livewire\Entradas;
use App\Http\Livewire\Envios;
use App\Http\Livewire\Estoques;
use App\Http\Livewire\Extensionistas;
use App\Http\Livewire\FormCategorias;
use App\Http\Livewire\Fornecedor;
use App\Http\Livewire\Fornecedores;
use App\Http\Livewire\Historicos;
use App\Http\Livewire\Importados;
use App\Http\Livewire\Inicios;
use App\Http\Livewire\Itemcarrinhas;
use App\Http\Livewire\Itemcomentarios;
use App\Http\Livewire\Itemestoques;
use App\Http\Livewire\Items;
use App\Http\Livewire\ItemsImportados;
use App\Http\Livewire\Noticia;
use App\Http\Livewire\Noticias;
use App\Http\Livewire\Pagamentos;
use App\Http\Livewire\Pais;
use App\Http\Livewire\Permissaos;
use App\Http\Livewire\Politicas;
use App\Http\Livewire\Produtos;
use App\Http\Livewire\Provincias;
use App\Http\Livewire\Retornos;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Rotas;
use App\Http\Livewire\Telefones;
use App\Http\Livewire\Transportadoras;
use App\Http\Livewire\Transportadors;
use App\Http\Livewire\Users;
use App\Models\Models\Estoque;
use App\Models\Models\Itemestoque;
use App\Models\Models\Provincia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





require __DIR__ . '/auth.php';


Route::group(['middleware' => [
    'auth:sanctum',
    'verified',
    'accessrole'
]], function () {

    Route::get('role', Roles::class)->name('role');
    Route::get('user', Users::class)->name('user');
    Route::get('rota', Rotas::class)->name('rota');
    Route::get('permissao', Permissaos::class)->name('permissao');

    Route::get('extensionista', Extensionistas::class)->name('extensionista');
    Route::get('estoque', Estoques::class)->name('estoque');
    Route::get('entrada', Entradas::class)->name('entrada');
    Route::get('transportador', Transportadors::class)->name('transportador');
    Route::get('pais', Pais::class)->name('pais');
    Route::get('provincia', Provincias::class)->name('provincia');
    Route::get('distrito', Distritos::class)->name('distrito');
    Route::get('itemcarrinha', Itemcarrinhas::class)->name('itemcarrinha');
    Route::get('itemestoque', Itemestoques::class)->name('itemestoque');
    /* Route::get('noticia', Noticia::class)->name('noticia'); */
});


Route::group(['middleware' => [
    'auth:sanctum',
    'verified',
]], function () {
    Route::get('carrinha', Carrinhas::class)->name('carrinha');
    Route::get('item/{id}', Items::class)->name('item');
    /* Route::get('itemimportado/{id}', ItemsImportados::class)->name('itemimportado'); */
    Route::get('pagamento', Pagamentos::class)->name('pagamento');
    Route::get('conta', Contas::class)->name('conta');
    Route::get('telefones', Telefones::class)->name('telefones');
    Route::get('transportadora', Transportadoras::class)->name('transportadora');
    Route::get('endereco', Enderecos::class)->name('endereco');
    Route::get('historico', Historicos::class)->name('historico');
});

Route::get('/', Inicios::class)->name('/');
Route::get('inicio', Inicios::class)->name('inicio')->middleware('verified', 'guest');
Route::get('produto', Produtos::class)->name('produto');
Route::get('dashboard', Inicios::class)->name('dashboard')->middleware('verified');
Route::get('categoria/{id}', Categorias::class)->name('categoria');
Route::get('noticias', Noticias::class)->name('noticias');
Route::get('itemcomentario/{id}', Itemcomentarios::class)->name('itemcomentario');
Route::get('fornecedor', Fornecedores::class)->name('fornecedor');
Route::get('importados', Importados::class)->name('importados');
Route::get('envio', Envios::class)->name('envio');
Route::get('retorno', Retornos::class)->name('retorno');
Route::get('politica', Politicas::class)->name('politica');

//Resources
Route::resource('categorias', CategoriasController::class);
Route::resource('noticia', NoticiaController::class);
Route::resource('avatar', AvatarController::class);
Route::resource('produtos', ProdutoController::class);
?>