<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses' => 'WackerController@index', 'as' => 'wacker']);


Route::get('/test', function() {
  phpinfo();
});

Route::get('/wam/catalog/', ['uses' => 'WackerController@catalogStatic', 'as' => 'wam-catalog']);
Route::get('/wam/detail/', ['uses' => 'WackerController@details', 'as' => 'wam-detail']);


Route::get('/wacker/catalog/{id}', ['uses' => 'WackerController@catalog', 'as' => 'wacker-catalog']);
Route::get('/catalog/{slug}', ['uses' => 'WackerController@detail', 'as' => 'wacker-detail']);

Route::post('/upload', ['before' => 'csrf', 'uses' => 'UploadController@uploadHandl', 'as' => 'upload']);
// Получение файлов
Route::get('/getFiles/{id}', ['uses' => 'UploadController@getFiles', 'as' => 'get-files']);
// Удаление изображения товара
Route::get('/deleteFile/{id}', ['uses' => 'UploadController@deleteFile', 'as' => 'delete-file']);

Route::get('/news/', ['uses' => 'News\NewsController@index', 'as' => 'news']);
Route::get('/news/{slug}', ['uses' => 'News\NewsController@show', 'as' => 'show-news']);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/exit', function() {
    Auth::logout();
    return redirect()->route('wacker');
});

Route::get('/product-line/{id}', ['uses' => 'Product\ProductController@elementsLine', 'as' => 'product-elements-line']);
Route::get('/special-product/', ['uses' => 'Product\ProductController@special', 'as' => 'special']);
// Изображения продукта
Route::get('product-images/{id}', ['uses' => 'Product\ProductController@images', 'as' => 'product-images']);
// Список типов продуктов
Route::get('/type-product/', ['uses' => 'Product\ProductController@typeProduct', 'as' => 'type-product']);


// Корзина
Route::get('/add-cart/{id}', ['uses' => 'Cart\CartController@add', 'as' => 'add-cart']);
Route::get('/current-cart', ['uses' => 'Cart\CartController@current', 'as' => 'current-cart']);
Route::get('/cart', ['uses' => 'Cart\CartController@index', 'as' => 'cart']);
Route::post('/cart-delete',
  [
    'before' => 'csrf',
    'uses' => 'Cart\CartController@delete',
    'as' => 'cart-delete'
  ]);
Route::get('/cart-qty-up/{id}/{qty}', ['uses' => 'Cart\CartController@upQty', 'as' => 'cart-qty-up']);
Route::get('/cart-qty-down/{id}/{qty}', ['uses' => 'Cart\CartController@downQty', 'as' => 'cart-qty-down']);
Route::get('/update-qty/{id}/{qty}', ['uses' => 'Cart\CartController@updateQty', 'as' => 'update-qty']);

//Оформление заказа
Route::get('/order', ['uses' => 'Order\OrderController@index', 'as' => 'order']);
Route::post('/order',
  [
    'before' => 'csrf',
    'uses' => 'Order\OrderController@handler',
    'as' => 'order'
  ]);

///////////////////////////////////PAGE///////////////////////////////////////////////
// Отображение конкретной страницы
Route::get('/{url_key}', ['uses' => 'PageController@indexPage', 'as'=> 'index-page']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    // Добавление новой страницы
    Route::get('/page/add', ['uses' => 'PageController@addPage', 'as' => 'add-page']);

    // Обработка добавления новой страницы
    Route::post('/page/add',
        [
            'before' => 'csrf',
            'uses' => 'PageController@addPageHandler',
            'as' => 'add-page'
        ]);

    // Получение существующей страницы
    Route::get('/page/update/{id}', ['uses' => 'PageController@updatePage', 'as' => 'update-page']);

    // Обновление существующей страницы
    Route::post('/page/update/{id}',
        [
            'before' => 'csrf',
            'uses' => 'PageController@updatePageHandler',
            'as' => 'update-page'
        ]);

    // Список всех страниц
    Route::get('/page/showlist',['uses' => 'PageController@showListPage', 'as' => 'showlist-page']);

    // Удалить страницу
    Route::get('/page/delete/{id}',['uses' => 'PageController@deletePage', 'as' => 'delete-page']);

    // Отображение страницы
    Route::get('/page/show/{id}', ['uses' => 'PageController@showPage', 'as' => 'show-page']);


    // Создание таблицы
    Route::post('/page/createTable', ['uses' => 'PageController@createTable', 'as' => 'create-table']);

    // Autocomplete
    Route::get('/page/autocoplete/{text}', ['uses' => 'PageController@autocomplete', 'as' => 'autocomplete']);


  ////////////////////////////НОВОСТИ//////////////////////////////////////////////////
  // Добавление новости
  Route::get('/news/add', ['uses' => 'News\NewsController@add', 'as' => 'add-news']);
  Route::get('/news/update/{id}',
    [
      'before' => 'csrf',
      'uses' => 'News\NewsController@update',
      'as' => 'update-news'
    ]);
  // Обновление существующей новости
  Route::post('/news/update/{id}',
    [
      'before' => 'csrf',
      'uses' => 'News\NewsController@updateHand',
      'as' => 'update-news'
    ]);
  // Список новостей
  Route::get('/news/showlist', ['uses' => 'News\NewsController@listNews', 'as' => 'list-news']);
  // Удалить новость
  Route::get('/news/delete/{id}',['uses' => 'News\NewsController@delete', 'as' => 'delete-news']);

    //////////////////////////КАТАЛОГ////////////////////////////////////
    // Добавление новой позиции каталога
    Route::get('/category/add', ['uses' => 'Category\CategoryController@add', 'as' => 'add-category']);

    // Получение всех категорий
    Route::get('/category/getAllCategories', ['uses'=>'Category\CategoryController@getAllCategories']);

    // Обработка добавления новой позиции каталога
    Route::post('/category/add',
        [
            'before' => 'csrf',
            'uses' => 'Category\CategoryController@addHandler',
            'as'=>'add-category'
        ]);


    // Отображение существующей позиции каталога
    Route::get('/category/update/{id}',
        [
            'before' => 'csrf',
            'uses' => 'Category\CategoryController@update',
            'as' => 'update-category'
        ]);

    // Обновление существующей позиции каталога
    Route::post('/category/update/{id}',
        [
            'before' => 'csrf',
            'uses' => 'Category\CategoryController@updateHandler',
            'as' => 'update-category'
        ]);

    // Удалить каталог
    Route::get('/category/delete/{id}',['uses' => 'Category\CategoryController@delete', 'as' => 'delete-category']);

    // Список каталогов
    Route::get('/category/list', ['uses' => 'Category\CategoryController@showList', 'as' => 'list-categories']);
    Route::get('/category/list/{id}', ['uses' => 'Category\CategoryController@showList', 'as' => 'list-categories']);

    ///////////////////////////////ПРОДУКЦИЯ/////////////////////////////////////
    // Добавление нового продукта
    Route::get('/product/add', ['uses' => 'Product\ProductController@add', 'as' => 'add-product']);

    // Обработка добавления нового продукта
    Route::post('/product/add',
        [
            'before' => 'csrf',
            'uses' => 'Product\ProductController@addHandler',
            'as'=>'add-product'
        ]);

    // Получение существующего товара
    Route::get('/product/update/{id}', ['uses' => 'Product\ProductController@update', 'as' => 'update-product']);

    // Обновление существующего товара
    Route::post('/product/update/{id}',
        [
            'before' => 'csrf',
            'uses' => 'Product\ProductController@updateHandler',
            'as' => 'update-product'
        ]);

    // Удалить продукт
    Route::get('/product/delete/{id}',['uses' => 'Product\ProductController@delete', 'as' => 'delete-product']);


    Route::get('/product/addAttribute', ['uses' => 'Product\ProductController@addAttribute', 'as' => 'add-attribute']);


    Route::get('/product/uploadCsv', ['uses' => 'Product\ProductController@uploadCsv', 'as' => 'tnved-csv']);
    Route::post('/product/uploadCsvHandl',
        [
            'before' => 'csrf',
            'uses' => 'Product\ProductController@uploadCsvHandler',
            'as'=>'csv-upload'
        ]);

  Route::post('/product/find-product',
    [
      'before' => 'csrf',
      'uses' => 'Product\ProductController@findProduct',
      'as'=>'find-product'
    ]);
  /////////////////////////////////////////////////////АТРИБУТЫ//////////////////////////////////////////////////////////////
  // Получение типов продукции
  Route::get('/product/getTypeProducts', ['uses' => 'TypeProduct\TypeProductController@getAll', 'as' => 'get-all-type-product']);
  // Получение линеек продукции для соотвествующего типа
  Route::get('/product/getLineProduct/{id}', ['uses' => 'LineProduct\LineProductController@get', 'as' => 'get-line-product']);
  // Получение атрибутов заданного типа продукции (в дальнейшем перенести в AttributeController
  Route::get('/product/getAttributesTypeProduct/{id}', ['uses' => 'Product\ProductController@getAttributesTypeProduct', 'as' => 'get-attributes-type-product']);
  Route::get('/product/getNAttributesTypeProduct/{id}', ['uses' => 'Product\ProductController@getNAttributesTypeProduct', 'as' => 'get-nattributes-type-product']);
  // Получение атрибутов заданной линейки продукции
  Route::get('/product/getAttributesLineProduct/{id}', ['uses' => 'Product\ProductController@getAttributesLineProduct', 'as' => 'get-attributes-line-product']);
  Route::get('/product/getNAttributesLineProduct/{id}', ['uses' => 'Product\ProductController@getNAttributesLineProduct', 'as' => 'get-nattributes-line-product']);
  Route::post('/product/remAttrTypeProd', ['before' => 'csrf', 'uses' => 'Product\ProductController@remAttrTypeProd', 'as' => 'rem-attr-type-prod']);
  Route::post('/product/remAttrLineProd', ['before' => 'csrf', 'uses' => 'Product\ProductController@remAttrLineProd', 'as' => 'rem-attr-line-prod']);

  // установка атрибутов для типа продукта
  Route::get('/product/setAttributes', ['uses' => 'Product\ProductController@setAttributes', 'as' => 'set-attributes']);
  Route::get('/product/setProdLineAttributes', ['uses' => 'Product\ProductController@setProdLineAttributes', 'as' => 'set-prodLine-attributes']);
  Route::post('/product/bindAttributes',
    [
      'before' => 'csrf',
      'uses' => 'Product\ProductController@bindAttributes',
      'as' => 'bind-attributes'
    ]);
  Route::post('/product/bindAttributesUpdate', ['before' => 'csrf','uses' => 'Product\ProductController@bindAttributesUpdate', 'as' => 'bind-attributes']);
  Route::post('/product/bindLineProdAttributes/{attributes}', ['uses' => 'Product\ProductController@bindLineProdAttributes', 'as' => 'bind-lineprod-attributes']);
  Route::post('/product/bindLineProdAttributesUpdate', ['before' => 'csrf','uses' => 'Product\ProductController@bindLineProdAttributesUpdate', 'as' => 'bind--lineprod-attributes']);
  // Обработка добавления нового атрибута
  Route::post('/porduct/addAttribute',
      [
          'before' => 'csrf',
          'uses' => 'Product\ProductController@addAttributeHandler',
          'as'=>'add-attribute'
      ]);
  // Получение всех атрибутов
  Route::get('/product/getAllAttributes', ['uses' => 'Product\ProductController@getAllAttributes', 'as' => 'get-all-attributes']);

  Route::get('/product/getProdLineAttributes/{id}', ['uses' => 'Product\ProductController@getProdLineAttributes', 'as' => 'get-prodline-attributes']);
    Route::get('/product/attributes/{idTypeProduct}/{idLineProduct}', ['uses' => 'Product\ProductController@attributes', 'as' => 'attributes']);
  Route::get('/product/attributesType/{id}', ['uses' => 'Product\ProductController@attributesType', 'as' => 'attributes-type']);
    Route::get('/product/existAttributes/{id}', ['uses' => 'Product\ProductController@existAttributes', 'as' => 'exist-attributes']);
    Route::post('/product/saveAttributes', ['before' => 'csrf', 'uses' => 'Product\ProductController@saveAttributes', 'as' => 'save-attributes']);
    Route::post('/product/addAttributeValue/{data}', ['uses' => 'Product\ProductController@addAttributeValue', 'as' => 'add-atribute-value']);
    Route::post('/porduct/updateAttribute',
        [
            'before' => 'csrf',
            'uses' => 'Product\ProductController@updateAttribute',
            'as'=>'upd-attribute'
        ]);


    //Линейка продукции
    Route::get('product/lines', ['uses' => 'Product\ProductController@lines', 'as' => 'lines-product']);
    Route::get('product/line', ['uses' => 'Product\ProductController@line', 'as' => 'line-product']);
    Route::get('/product/getAllTypeProducts', ['uses' => 'Product\ProductController@allTypeProduct', 'as' => 'type-product']);


    ////////////////////////////////////ТИП ПРОДУКЦИИ/////////////////////////////////////////////
    // Добавление типа продукции
    Route::get('product/typeProduct/add', ['uses' => 'TypeProduct\TypeProductController@add', 'as' => 'type-product-add']);
    // Обработка добавления типа продукции
    Route::post('/product/typeProduct/add',
        [
            'before' => 'csrf',
            'uses' => 'TypeProduct\TypeProductController@addHandler',
            'as'=>'type-product-add'
        ]);
    // Обновление типа продукции
    Route::get('product/typeProduct/update/{id}', ['uses' => 'TypeProduct\TypeProductController@update', 'as' => 'type-product-update']);
    // Обработка обновления типа продукции
    Route::post('/product/typeProduct/update/{id}',
        [
            'before' => 'csrf',
            'uses' => 'TypeProduct\TypeProductController@updateHandler',
            'as'=>'type-product-update'
        ]);
    // Список типов продукции
    Route::get('/product/typeProduct/list',['uses' => 'TypeProduct\TypeProductController@showList', 'as' => 'list-type-product']);




    ///////////////////////////////////////АТРИБУТЫ/////////////////////////////////////////////////////
    // Создание нового атрибута
    Route::get('product/attribute/create', ['uses' => 'Product\ProductController@createAttribute', 'as' => 'create-attribute']);
    // Обработка создания нового атрибута
    Route::post('/product/attribute/create',
        [
            'before' => 'csrf',
            'uses' => 'Product\ProductController@createAttributeHandler',
            'as'=>'create-attribute'
        ]);


    // Добавление производителя
    Route::get('product/producer/add', ['uses' => 'Product\ProductController@addProducer', 'as' => 'add-producer']);
    Route::post('/product/producer/add',
        [
            'before' => 'csrf',
            'uses' => 'Product\ProductController@addProducerHandler',
            'as'=>'add-producer'
        ]);


  /////////////////////////ЛИНЕЙКА ПРОДУКЦИИ///////////////////////////////////////
  // Добавление линейки продукции
  Route::get('product/line/add', ['uses' => 'LineProduct\LineProductController@add', 'as' => 'add-line']);
  Route::post('/product/line/add',
      [
          'before' => 'csrf',
          'uses' => 'LineProduct\LineProductController@addHandler',
          'as'=>'add-line'
      ]);
  // Обновление линейки продукции
  Route::get('product/line/update/{id}', ['uses' => 'LineProduct\LineProductController@update', 'as' => 'update-line']);
  // Обработка обновления линейки продукции
  Route::post('/product/line/update/{id}',
    [
      'before' => 'csrf',
      'uses' => 'LineProduct\LineProductController@updateHandler',
      'as'=>'update-line'
    ]);
  // Список линейки продукции
  Route::get('/product/line/list',['uses' => 'LineProduct\LineProductController@showList', 'as' => 'list-line']);

    ////////////////////////////СОЗДАНИЕ ТАБЛИЦ//////////////////////////////
    Route::get('/testAdminLTE', function(){
        return view('test.adminlte');
    });
});






