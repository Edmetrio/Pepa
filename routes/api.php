<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarteiraController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\DistritoController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\EncomendaController;
use App\Http\Controllers\Api\EnderecoController;
use App\Http\Controllers\Api\Formapagamento;
use App\Http\Controllers\Api\FormapagamentoController;
use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\ItemCarrinhaController;
use App\Http\Controllers\Api\ItemEstoqueController;
use App\Http\Controllers\Api\PaisController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\ProvinciaController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TelefoneController;
use App\Models\Models\Distrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum','verified')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('users', [AuthController::class, 'users']);

Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('endereco', EnderecoController::class)->middleware('verified');
    Route::apiResource('telefone', TelefoneController::class);
    Route::apiResource('itemestoque', ItemEstoqueController::class);
    Route::apiResource('itemcarrinha', ItemCarrinhaController::class);
    Route::apiResource('encomenda', EncomendaController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
Route::apiResource('fornecedor', FornecedorController::class);

});
Route::apiResource('formapagamento', FormapagamentoController::class);


    Route::apiResource('role', RoleController::class);
    Route::apiResource('categoria', CategoriaController::class);
    Route::apiResource('produto', ProdutoController::class);
    Route::apiResource('pais', PaisController::class);
    Route::apiResource('provincia', ProvinciaController::class);
    Route::apiResource('distrito', DistritoController::class);
    Route::get('pesquisa/{nome}', [ProdutoController::class, 'pesquisa']);

Route::apiResource('carteira', CarteiraController::class);
