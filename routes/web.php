<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\KategoriteController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\FurnitoretController;
use App\Http\Controllers\admin\BlerjetController;
use App\Http\Controllers\admin\DefaultController;
use App\Http\Controllers\user\FaturatController;
use App\Http\Controllers\UserProfileController;



Route::middleware(['auth', 'status-punonjes:1'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::controller(UserProfileController::class)->group(function (){
        Route::get('all/logout', 'destroy')->name('dmmt.logout');
    });

    Route::middleware(['user-access:0,1'])->group(function(){
        Route::get('user/view', function (){
            echo "user";
        });

    });
    Route::middleware(['user-access:2'])->group(function(){
        Route::get('admin/dashboard', function (){
            return view('admin.admin_dashboard');
        })->name('admin.dashboard');
        Route::get('/', function () {
            return view('dashboard');
        })->name('full.home');
        Route::get('admin/view', function (){
            echo "admin";
        });


        Route::controller(KategoriteController::class)->group(function(){
            Route::get('/shto/kategori', 'shtoKategori')->name('shto.kategori');
            Route::post('/store/kategori', 'storeKategori')->name('store.kategori');
            Route::get('/shiko/kategori', 'shikoKategori')->name('shiko.kategori');
            Route::get('/edit/kategori/{id}', 'editKategori')->name('edit.kategori');
            Route::get('/fshij/kategori/{id}', 'fshijKategori')->name('fshij.kategori');
            Route::post('/update/kategori', 'updateKategori')->name('kategorite.update');
        });

        Route::controller(ProductController::class)->group(function(){
            Route::get('shto/produkt', 'shtoProdukt')->name('shto.produkt');
            Route::post('store/produkt', 'productStore')->name('product.store');
            Route::get('shiko/produkt', 'shikoProduktet')->name('shiko.produktet');
            Route::get('/edit/produkt/{id}', 'editProdukt')->name('edit.produkt');
            Route::get('/fshij/produkt/{id}', 'fshijProdukt')->name('fshij.produkt');
            Route::post('/update/produkt', 'perditesoProduktin')->name('update.product');
            Route::get('edito/cmimet', 'editoCmimet')->name('edit.cmimet');
            Route::POST('perditeso/cmim/sasi', 'perditesoCmimin')->name('perditeso.cmimin');
        });

        Route::controller(FurnitoretController::class)->group(function(){
            Route::get('/shto/furnitor', 'shtoFurnitor')->name('shto.furnitor');
            Route::post('/store/furnitor', 'storeFurnitor')->name('store.furnitor');
            Route::get('/shiko/furnitor', 'shikoFurnitor')->name('shiko.furnitor');
            Route::get('/edit/furnitor/{id}', 'editFurnitor')->name('edit.furnitor');
            Route::get('/fshij/furnitor/{id}', 'fshijFurnitor')->name('fshij.furnitor');
            Route::post('/update/furnitor', 'updateFurnitor')->name('furnitor.update');
        });

        Route::controller(BlerjetController::class)->group(function(){
            Route::get('shiko/blerjet','shikoBlerjet')->name('shiko.blerjet');
            Route::get('shto/blerje','shtoBlerje')->name('shto.blerjet');
            Route::post('store/blerje','storeBlerje')->name('blerjet.store');

        });

        Route::controller(DefaultController::class)->group(function(){
            Route::get('get-category', 'gjejKategorine')->name('get-category');
            Route::get('get/product', 'gjejProduktin')->name('get-product');
        });

        Route::controller(FaturatController::class)->group(function(){
            Route::get('bej/shitje', 'bejShitje')->name('bej.shitje');
            Route::get('gjej/stokun', 'gjejStokun')->name('gjej.stokun');
            Route::get('/search-products', 'search')->name('search-products');
            Route::post('/kryejShitjen', 'kryejShitjen')->name('kryej_shitjen');
            Route::get('/shiko/faturat', 'shikoFaturat')->name('shiko.faturat');
            Route::get('/shiko/faturat/{id}', 'shikoFaturatData')->name('shiko.faturat.data');
            Route::get('/printo/faturen/{id}', 'printoFaturen')->name('printo.faturen');
            Route::get('/fshij/faturen/{id}', 'fshijFaturen')->name('fshi.faturen');
            Route::get('/edito/faturen/{id}', 'editoFaturen')->name('edito.faturen');
            Route::post('/update/faturat', 'perditesoFaturen')->name('update.faturat');
            Route::post('/update/prod', 'updateProdShitur')->name('edito.produktin.e.shitur');
            Route::get('/delete/pr/{id}', 'prodPerTuFshire')->name('delete.prod.sh');
            Route::get('/riprintoFaturen/{id}', 'riprontoFaturen')->name('riprinto.faturen');
            Route::get('/faturat/permbledhje', 'faturatPermbledhje')->name('xhirot.ditore');
            Route::post('/faturat/permbledhje/', 'faturatPermbledhjeData')->name('shiko.permbledhje.data');
            Route::get('/print_conferma/{maxInvoiceNo}', 'printConferma')->name('agent.print_conferma');

        });


    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
