<?php

use App\Http\Controllers\FirstController;
use App\Http\Controllers\NewsPippoController;
use App\Http\Controllers\RubricaController;
use App\Http\Controllers\SecondController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Service\TradingFinance\Market;
use Service\TradingFinance\TradingFinanceInfoFacade;

// Standard home root
Route::get('/', fn () => view('welcome'));

// Semplice esempio di utilizzo delle route con view
Route::post('/about', fn() => view('contact'));
Route::get('/about', fn() => "Simple about");

Route::get('/about/{pippo}', fn ($pippo) => "Hello $pippo")->whereAlpha('pippo');

// Gruppo di route sotto il prefisso posts
Route::prefix('posts')->group(function(){
    Route::get('/', fn(Request $request) => view('post.list'));
    Route::get('/{post}/comments/{comment}',
        function (Request $request, $post, $comment) {
            return view( 'post.comment', [
                "postid"    => $post,
                "commentid" => $comment
            ] );
        } );

    Route::get('/posts/{post}', fn(Post $post) => dd($post));
});


Route::prefix('news')->group(function(){
    Route::get('/', [ NewsPippoController::class, 'index' ] );
    Route::get('/{id}', [ NewsPippoController::class, 'get' ] );
    Route::get('/{filter}', [ NewsPippoController::class, 'filter' ] )->name('newsfiltered');
});

// Shortcut per ottenere news filtrate per finance
Route::get('/finance', fn() => redirect()->route('newsfiltered', ['filter' => 'finance']));

// Route Model Binding
Route::prefix('users')->group(function(){
    Route::get('/', [ UserController::class, 'index' ] );
    Route::post('/', [ UserController::class, 'store' ] );
    Route::post('/create', [ UserController::class, 'create' ] );
    Route::get('/{user}', [ UserController::class, 'show' ] );
    Route::get('/{user}/edit', [ UserController::class, 'edit' ] );
    Route::patch('/{user}', [ UserController::class, 'update' ] );
    Route::get('/{user}', [ UserController::class, 'destroy' ] );
});

// Il nostro esercizio rubrica (Esplorare RubricaController)
Route::prefix('rubrica')->group(function(){
    Route::get('/', [ RubricaController::class, 'index' ] );
    Route::post('/', [ RubricaController::class, 'store' ] );
    Route::post('/create', [ RubricaController::class, 'create' ] );
    Route::get('/{contact}', [ RubricaController::class, 'show' ] );
    Route::get('/{contact}/edit', [ RubricaController::class, 'edit' ] );
    Route::patch('/{contact}', [ RubricaController::class, 'update' ] );
    Route::get('/{contact}', [ RubricaController::class, 'destroy' ] );
});

// Dependency injection -- test
Route::get("/a", [FirstController::class, "do"]);
Route::get("/b", [SecondController::class, "do"]);


Route::get('/trading/gainers/{market}', fn( Market $market ) => view('trading.gainers', [ 'market' => TradingFinanceInfoFacade::getDailyGainers( $market ) ] ) );
