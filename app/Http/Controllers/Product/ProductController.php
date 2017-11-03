<?php
namespace App\Http\Controllers\Product;

use App\AttributeProducerTypeProduct;
use App\AttributeTypeProduct;
use App\Product;
use App\ProductPhoto;
use App\Attribute;
use App\ProductAttributeValue;
use App\Category;
use App\TypeProduct;
use App\Producer;
use App\File;
use App\ProducerTypeProduct;
use App\Tnved;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\StoreTypeProductRequest;
use App\Http\Requests\Product\StoreProducerRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\CsvRequest;
use App\Http\Requests\Product\AttributeRequest;
use App\Http\Requests\Product\StoreProductLineRequest;
use App\Http\Requests\Product\StoreAttributeRequest;
use App\Http\Requests\Product\UpdateTypeProductRequest;
use Mockery\Matcher\Type;
use Illuminate\Support\Facades\DB;
use App\FileHandler;

class ProductController extends Controller
{
  /**
   *
   * Add Product
   *
   * @return \Illuminate\Http\Response
   */
  public function add()
  {
    $category_all = Category::all()->pluck('title','id');
    //$category_all = Category::All();
    /*$typeProductAll = TypeProduct::all()->pluck('title','id');
    $typeProducts = TypeProduct::all();
    $productLine = array();
    foreach($typeProducts as $typeProduct) {
        foreach ($typeProduct->producers as $producer) {
            $tempArr = [];
            $tempArr['id'] = $producer->pivot->id;
            $tempArr['title'] = $producer->pivot->name_line;
            $productLine[] = $tempArr;
        }
    }
    $productLine = json_encode($productLine);*/
    $resultArr = [];
    $type_products = TypeProduct::All();
    $typeProduArr = [];
    foreach ($type_products as $type_product) {
      $typeProdArr["id"] = $type_product->id;
      $typeProdArr["title"] = $type_product->title;
      $typeProdArr["sort"] = $type_product->sort;
      $producerResult = [];
      $producerTypeProductResult = [];
      foreach ($type_product->producers as $producer)
      {
        $producerArr["id"] = $producer->id;
        $producerArr["title"] = $producer->title;
        $producerArr["sort"] = $producer->sort;
        $producerTypeProductArr["id"] = $producer->pivot->id;
        $producerTypeProductArr["title"] = $producer->pivot->name_line;
        $producerTypeProductArr["sort"] = $producer->pivot->sort;
        if(!in_array($producerArr, $producerResult))
        {
          $producerResult[] = $producerArr;
        }
        $producerTypeProductResult[] = $producerTypeProductArr;
      }
      $typeProdArr['producer_id'] = $producerResult;
      $typeProdArr['producer_type_product_id'] = $producerTypeProductResult;
      $resultArr['type_product_id'][] = $typeProdArr;
    }
    $typeProdId = TypeProduct::orderBy('sort','asc')->take(1)->pluck('id')->first();
    $prodLineId = ProducerTypeProduct::orderBy('sort','asc')->take(1)->pluck('id')->first();
    return view('product.add', compact('category_all','resultArr','typeProdId','prodLineId'));
  }

  /**
   *
   * Add Product Handler
   * @param StoreProductRequest $productRequest
   * @return \Illuminate\Http\Redirect
   */
  public function addHandler(Request $productRequest)
  {
    $files_id = $productRequest->files_ids;
    $normTitle = str_replace("/"," ",$productRequest->title);
    $productRequest['url_key'] = \Slug::make($normTitle);
    $this->validate($productRequest, [
      'title' => 'required',
      'price' => 'required|numeric',
      'description' => '',
      'qty' => 'numeric',
      'active' => '',
      'sort' => 'numeric',
      'onsale' => '',
      'special' => '',
      'need_order' => '',
      'category_id' => 'required',
      'type_product_id' => 'required',
      'url_key' => 'required|unique:products',
    ]);
    $arr_id = json_decode($files_id);
    $model_name = $productRequest->model;
    $request = $productRequest->all();
    if($request["producer_id"]== "0")
    {
      $request["producer_id"] = null;
    }
    if($request["producer_type_product_id"] == "0")
    {
      $request["producer_type_product_id"] = null;
    }
    $normTitle = str_replace("/"," ",$request["title"]);

    $product = Product::create($request);
    $id = $product->id;
    foreach ($arr_id as $item) {
      File::where('id', $item)->update(['fileable_id'=>$id, 'fileable_type'=>$model_name]);
    }
    return redirect()->route('update-product',['id' => $id]);
  }

  /**
   *  Update Product
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update($id)
  {
    $id = (int)$id;
    $product = Product::where('id',$id)->firstOrFail();
    $type_product_id = Product::where('id',$id)->pluck('type_product_id')->first();
    if(!$type_product_id) {
      $prodTypeProd = Product::find($id);
      $type_product_id=$prodTypeProd->producer_type_product->type_product_id;
    }
    $attributes = TypeProduct::find($type_product_id)->attributes()->get();
    $category_all = Category::all()->pluck('title','id');
    /*$typeProducts = TypeProduct::all();
    $productLine = array();
    foreach($typeProducts as $typeProduct) {
        foreach ($typeProduct->producers as $producer) {
            $tempArr = [];
            $tempArr['id'] = $producer->pivot->id;
            $tempArr['title'] = $producer->pivot->name_line;
            $productLine[] = $tempArr;
        }
    }
    $typeProductAll = TypeProduct::all()->pluck('title','id');
    $productLine = json_encode($productLine);*/
    $resultArr = [];
    $type_products = TypeProduct::All();
    $typeProduArr = [];
    foreach ($type_products as $type_product) {
      $typeProdArr["id"] = $type_product->id;
      $typeProdArr["title"] = $type_product->title;
      $typeProdArr["sort"] = $type_product->sort;
      $producerResult = [];
      $producerTypeProductResult = [];
      foreach ($type_product->producers as $producer)
      {
        $producerArr["id"] = $producer->id;
        $producerArr["title"] = $producer->title;
        $producerArr["sort"] = $producer->sort;
        $producerTypeProductArr["id"] = $producer->pivot->id;
        $producerTypeProductArr["title"] = $producer->pivot->name_line;
        $producerTypeProductArr["sort"] = $producer->pivot->sort;
        $producerResult[] = $producerArr;
        $producerTypeProductResult[] = $producerTypeProductArr;
      }
      $typeProdArr['producer_id'] = $producerResult;
      $typeProdArr['producer_type_product_id'] = $producerTypeProductResult;
      $resultArr['type_product_id'][] = $typeProdArr;
    }
    return view('product.add', compact('product','category_all','attributes','resultArr'));
  }

  /**
   *
   * Update Product Handl
   * @param int $id
   * @param Request $request
   * @return \Illuminate\Http\Redirect
   */
  public function updateHandler($id, UpdateProductRequest $request)
  {
    $files_id = $request->files_ids;
    $arr_id = json_decode($files_id);
    $model_name = $request->model;
    $id = (int)$id;
    $productRequest = $request->except('_token','files_ids','model');
    if($productRequest["producer_id"]== "0")
    {
      $productRequest["producer_id"] = null;
    }
    if($productRequest["producer_type_product_id"] == "0")
    {
      $productRequest["producer_type_product_id"] = null;
    }
    $normTitle = str_replace("/"," ",$productRequest["title"]);
    $productRequest['url_key'] = \Slug::make($normTitle);
    Product::where('id', $id)->update($productRequest);
    foreach ($arr_id as $item) {
      File::where('id', $item)->update(['fileable_id'=>$id, 'fileable_type'=>$model_name]);
    }
    return redirect()->route('list-categories',['id' => 1]);
  }

  /**
   *
   * Delete Product
   *
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $product = Product::find($id);
    $currentFiles = File::where('fileable_id',$id)->where('fileable_type','App\Product')->get();
    foreach ($currentFiles as $currentFile) {
      $currentFile->delete();
    }
    $product->delete();
    return redirect()->back();
  }

  /**
   * Set Attributes
   */
  public function setAttributes()
  {
    $arrTypeProducts = array();
    $arrTypeProducts = TypeProduct::all()->sortBy("sort");
    $arrTypeProducts = $arrTypeProducts->toJson();
    return view('product.setAttributes', compact('arrTypeProducts'));
  }

  /**
   * Set ProdLine Attributes
   */
  public function setProdLineAttributes()
  {
    $arrTypeProducts = array();
    $arrProducerTypeProducts = ProducerTypeProduct::all()->sortBy("sort");
    $arrProducerTypeProducts = $arrProducerTypeProducts->toJson();
    return view('product.setProdLineAttributes', compact('arrProducerTypeProducts'));
  }


  /**
   * Add Attribute
   */
  public function addAttribute()
  {
    $arrTypeProducts = array();
    $arrTypeProducts = TypeProduct::all()->sortBy("sort");
    $arrTypeProducts = $arrTypeProducts->toJson();
    return view('product.addAttribute', compact('arrTypeProducts'));
  }

  /**
   *
   * Add Attribute Handler
   * @param AttributeRequest $attributeRequest
   * @return \Illuminate\Http\Redirect
   */
  public function addAttributeHandler(AttributeRequest $attributeRequest)
  {
    /*$request = $attributeRequest->all();
    $attribute = ProductAttribute::create($request);
    $id = $attribute->id;
    return redirect()->route('wacker');*/
  }

  /**
   *
   * Update Attribute
   * @param Request $request
   * @return \Illuminate\Http\Redirect
   */
  public function updateAttribute(Request $request)
  {
    $product_id = $request->product_id;
    $attributes = $request->All();
    $product = Product::find($product_id);
    foreach ($attributes as $key=>$attribute)
    {
      if($key!=='_token' && $key!=='product_id')
      {
        $attribute_id = Attribute::where('alias',$key)->pluck('id')->first();
        $product->attributes()->attach($attribute_id,['value'=> $attribute]);
      }
    }
    return redirect()->route('update-product',['id' => $product_id]);
  }

  /**
   * Get All Attributes
   * @return json
   */
  public function getAllAttributes()
  {
    $attributes = Attribute::all();
    return $attributes->toJson();
  }

  /**
   * Get Attributes
   * @return Arr
   */
  public function getAttributesTypeProduct($id)
  {
    return TypeProduct::find($id)->attributes;
  }

  /**
   * Get Attributes
   */
  public function getNAttributesTypeProduct($id)
  {
    $attributes = Attribute::all();
    $arr1 = [];
    foreach ($attributes as $attribute) {
      $arr1[$attribute["id"]] = $attribute["title"];
    }
    $arr2 = [];
    foreach (TypeProduct::find($id)->attributes as $attribute) {
      $arr2[$attribute["id"]] = $attribute["title"];
    }
    $arrResult = array_diff($arr1,$arr2);
    $arrT = [];
    foreach ($arrResult as $key=>$arr) {
      $temp['id'] = $key;
      $temp['title'] = $arr;
      $arrT[] = $temp;
    }
    return $arrT;
  }

  /**
   * Get Attributes
   * @return Arr
   */
  public function getAttributesLineProduct($id)
  {
    return ProducerTypeProduct::find($id)->attributes;
  }


  /**
   * Get Attributes
   */
  public function getNAttributesLineProduct($id)
  {
    $attributes = Attribute::all();
    $arr1 = [];
    foreach ($attributes as $attribute) {
      $arr1[$attribute["id"]] = $attribute["title"];
    }
    $arr2 = [];
    foreach (ProducerTypeProduct::find($id)->attributes as $attribute) {
      $arr2[$attribute["id"]] = $attribute["title"];
    }
    $arrResult = array_diff($arr1,$arr2);
    $arrT = [];
    foreach ($arrResult as $key=>$arr) {
      $temp['id'] = $key;
      $temp['title'] = $arr;
      $arrT[] = $temp;
    }
    return $arrT;
  }

  /**
   * Get ProdLine Attributes
   * @return json
   */
  public function getProdLineAttributes($id)
  {
    $attributes = AttributeProducerTypeProduct::where('producer_type_product_id',$id)->get();
    return $attributes->toJson();
  }

  /**
   * Get Attributes
   * @return json
   */
  public function attributes($idTypeProduct,$idLineProduct)
  {

    /*$type_products = ProducerTypeProduct::find($id);
    $type_product_id  = $type_products->type_product_id;
    $attributes = Attribute::with(['attributeTypeProducts' => function($query) use (&$type_product_id) {
      $query->where('type_product_id', $type_product_id);
    }])->get();
    foreach ($attributes as $attribute)
    {
      foreach ($attribute->attributeTypeProducts as $item)
      {
        $temp['id'] = $attribute->id;
        $temp['title'] = $attribute->title;
        $arr[] = $temp;
      }
    }*/


    if($idLineProduct) {
      return ProducerTypeProduct::find($idLineProduct)->attributes;
    }

    if($idTypeProduct) {
      return TypeProduct::find($idTypeProduct)->attributes;
    }

    return [];
  }

  public function attributesType($id)
  {

    /*$type_products = ProducerTypeProduct::find($id);
    $type_product_id  = $type_products->type_product_id;
    $attributes = Attribute::with(['attributeTypeProducts' => function($query) use (&$type_product_id) {
      $query->where('type_product_id', $type_product_id);
    }])->get();
    foreach ($attributes as $attribute)
    {
      foreach ($attribute->attributeTypeProducts as $item)
      {
        $temp['id'] = $attribute->id;
        $temp['title'] = $attribute->title;
        $arr[] = $temp;
      }
    }*/
    $arr = [];
    $producerTypeProduct = TypeProduct::find($id);
    foreach ($producerTypeProduct->attributes as $attribute)
    {
      $temp['id'] = $attribute->id;
      $temp['title'] = $attribute->title;
      $arr[] = $temp;
    }
    return json_encode($arr);
  }

  /**
   * Get Exist Attributes
   * @return json
   */
  public function existAttributes($id)
  {
    $arr = [];
    $product = Product::find($id);
    foreach ($product->attributes as $attribute) {
      $temp['id'] = $attribute->id;
      $temp['title'] = $attribute->title;
      $temp['value'] = $attribute->pivot->value;
      $arr[] = $temp;
    }
    return json_encode($arr);
  }

  /**
   * Save Attributes
   * @return json
   */
  public function saveAttributes(Request $request)
  {
    $items = $request->data;
    $productId = $request->productId;
    $arr = [];
    $attributes = json_decode($items, true);
    foreach ($attributes as $attribute) {
      $val['value'] = $attribute["value"];
      $arr[$attribute["attribute_id"]] = $val;
    }
    $product = Product::find($productId);
    $product->attributes()->sync($arr);
    return response()->json([], 200);
  }

  /**
   * Add Atributes Value
   */
  public function addAttributeValue($data) {
    $attributes_values = json_decode($data,true);
    foreach ($attributes_values as $item)
    {
      $AttrTypeVal = new AttributeTypeProduct();
      $AttrTypeVal->attribute_id = $item["id"];
      $AttrTypeVal->value = $item["value"];
      $AttrTypeVal->type_product_id = $item["type_product_id"];
      $AttrTypeVal->save();
    }
    return response()->json([],200);
  }

  /**
   * Bind Attributes
   */
  public function bindAttributes(Request $request) {
    $typeProductId = $request->typeProductId;
    $lineProductId = $request->lineProductId;

    if($lineProductId) {
      //DB::table('attributables')->where('attributable_id', $lineProductId)->where('attributable_type', 'App\ProducerTypeProduct')->delete();
      foreach ($request->attr as $attribute) {
        DB::table('attributables')->insert([
          'attribute_id' => $attribute["id"],
          'attributable_id' => $lineProductId,
          'attributable_type' => 'App\ProducerTypeProduct'
        ]);
      }
      return response()->json([], 200);
    }

    if($typeProductId) {
      //DB::table('attributables')->where('attributable_id', $typeProductId)->where('attributable_type','App\TypeProduct')->delete();
      foreach ($request->attr as $attribute)
      {
        DB::table('attributables')->insert([
          'attribute_id' => $attribute["id"],
          'attributable_id' => $typeProductId,
          'attributable_type' => 'App\TypeProduct'
        ]);
      }
    }
    return response()->json([],200);
  }

  public function remAttrTypeProd(Request $request) {
    $attr = $request->attr;
    foreach ($attr as $item) {
      DB::table('attributables')->where('attribute_id', $item)->where('attributable_type', 'App\TypeProduct')->delete();
    }
  }

  public function remAttrLineProd(Request $request) {
    $attr = $request->attr;
    foreach ($attr as $item) {
      DB::table('attributables')->where('attribute_id', $item)->where('attributable_type', 'App\ProducerTypeProduct')->delete();
    }
  }

  /**
   * Bind LineProd Attributes
   */
  public function bindLineProdAttributes($attributes) {
    $attributes = json_decode($attributes, true);
    foreach ($attributes as $item)
    {
      $AttrTypeVal = new AttributeProducerTypeProduct;
      $AttrTypeVal->attribute_id = $item["attribute_id"];
      $AttrTypeVal->producer_type_product_id = $item["producer_type_product_id"];
      $AttrTypeVal->save();
    }
    return response()->json([],200);
  }

  /**
   * Bind Attributes Update
   */
  public function bindAttributesUpdate(Request $request) {
    $attributes = $request->data;
    $id = $request->typeProdId;
    $attributes = json_decode($attributes, true);
    DB::table('attributables')->where('type_product_id',$id)->delete();
    foreach ($attributes as $item)
    {
      DB::table('attributables')->insert([
        'attribute_id' => $item["attribute_id"],
        'attributable_id' => $item["type_product_id"],
        'attributable_type' => 'App\TypeProduct'
      ]);
    }
    return response()->json([],200);
  }

  /**
   * Bind LineProd Attributes Update
   */
  public function bindLineProdAttributesUpdate(Request $request) {
    $attributes = $request->data;
    $id = $request->prodLine;
    $attributes = json_decode($attributes, true);
    $delRelations = AttributeProducerTypeProduct::where('producer_type_product_id',$id)->get();
    foreach ($delRelations as $delRelation)
    {
      $delRelation->delete();
    }
    foreach ($attributes as $item)
    {
      $AttrTypeVal = new AttributeProducerTypeProduct;
      $AttrTypeVal->attribute_id = $item["attribute_id"];
      $AttrTypeVal->producer_type_product_id = $item["producer_type_product_id"];
      $AttrTypeVal->save();
    }
    return response()->json([],200);
  }

  /**
   * Get All Type Product
   */
  public function allTypeProduct() {
    $type_products = TypeProduct::all();
    return $type_products->toJson();
  }


  public function line() {
    /*$resultArr = [];
    $type_products = TypeProduct::All();
    $typeProduArr = [];
    foreach ($type_products as $type_product) {
      $typeProdArr["id"] = $type_product->id;
      $typeProdArr["title"] = $type_product->title;
      $typeProdArr["sort"] = $type_product->sort;
      $producerResult = [];
      $producerTypeProductResult = [];
      foreach ($type_product->producers as $producer)
      {
        $producerArr["id"] = $producer->id;
        $producerArr["title"] = $producer->title;
        $producerArr["sort"] = $producer->sort;
        $producerTypeProductArr["id"] = $producer->pivot->id;
        $producerTypeProductArr["title"] = $producer->pivot->name_line;
        $producerTypeProductArr["sort"] = $producer->pivot->sort;
        $producerResult[] = $producerArr;
        $producerTypeProductResult[] = $producerTypeProductArr;
      }
      $typeProdArr['producers'] = $producerResult;
      $typeProdArr['lines'] = $producerTypeProductResult;
      $resultArr['typeproducts'][] = $typeProdArr;
    }*/
      $resultArr = [];
      $type_products = TypeProduct::All();
      $typeProduArr = [];
      foreach ($type_products as $type_product) {
          $typeProdArr["id"] = $type_product->id;
          $typeProdArr["title"] = $type_product->title;
          $typeProdArr["sort"] = $type_product->sort;
          $producerResult = [];
          $producerTypeProductResult = [];
          foreach ($type_product->producers as $producer)
          {
              $producerArr["id"] = $producer->id;
              $producerArr["title"] = $producer->title;
              $producerArr["sort"] = $producer->sort;
              $producerTypeProductArr["id"] = $producer->pivot->id;
              $producerTypeProductArr["title"] = $producer->pivot->name_line;
              $producerTypeProductArr["sort"] = $producer->pivot->sort;
              if(!in_array($producerArr, $producerResult))
              {
                  $producerResult[] = $producerArr;
              }
              $producerTypeProductResult[] = $producerTypeProductArr;
          }
          $typeProdArr['producers_id'] = $producerResult;
          $typeProdArr['producer_type_product_id'] = $producerTypeProductResult;
          $resultArr['type_product_id'][] = $typeProdArr;
      }
    return view('product.line', compact('resultArr'));
  }


  public function lines() {
    $arrTypeProducts = array();
    $arrProducers = array();
    $arrProducerTypeProducts = array();
    $type_products = TypeProduct::all()->sortBy("sort");
    foreach ($type_products as $type_product) {
      $arrTypeProducts[$type_product->id]["id"] = $type_product->id;
      $arrTypeProducts[$type_product->id]["title"] = $type_product->title;
      $arrTypeProducts[$type_product->id]["sort"] = $type_product->sort;
      foreach(TypeProduct::find($type_product->id)->producers()->orderBy('sort')->get() as $producer) {
        $arrProducers[$type_product->id][$producer->id]["id"] = $producer->id;
        $arrProducers[$type_product->id][$producer->id]["title"] = $producer->title;
        $arrProducers[$type_product->id][$producer->id]["sort"] = $producer->sort;
      }
      $prodTypeProds = ProducerTypeProduct::where('type_product_id',$type_product->id)->orderBy('sort')->get();
      foreach ($prodTypeProds as $prodTypeProd) {
        $arrProducerTypeProducts[$type_product->id][$prodTypeProd->id]["id"] = $prodTypeProd->id;
        $arrProducerTypeProducts[$type_product->id][$prodTypeProd->id]["title"] = $prodTypeProd->name_line;
        $arrProducerTypeProducts[$type_product->id][$prodTypeProd->id]["sort"] = $prodTypeProd->sort;
      }
    }
    return view('product.lines', compact('arrProducers','arrTypeProducts','arrProducerTypeProducts'));
  }


  /**
   * Upload TNVED csv
   */
  public function uploadCsv() {
    return view('product.uploadcsv');
  }

  /**
   * HandlerUploadCsv
   * @param Request $request
   */
  public function uploadCsvHandler(CsvRequest $request) {
    $file = $request->tnved;
    $uploadSuccess = $file->move( "../public/images/csv/", "tnved.csv" );
    $SqlStr = '';
    if (($handle = fopen("../public/images/csv/tnved.csv", "r")) !== FALSE)
    {
      while (($data = fgetcsv($handle, 5000, ",")) !== FALSE)
      {
        try {
          $tnved = DB::table('tnved')->insert(['id'=> $data[3], 'title' => $data[0], 'service' => $data[1],'active' => $data[2]]);
        }
        catch (\Exception $e) {
            echo "Возникла ошибка";
        }
      }
      echo "Успешно загружено";
      return;
    }
    echo "Загрузка не удалась, не найден файл";
    return;
  }


  /**
   *
   * Add TypeProduct Handler
   * @param StoreTypeProductRequest $typeProductRequest
   * @return \Illuminate\Http\Redirect
   */
  public function addTypeProductHandler(StoreTypeProductRequest $typeProductRequest)
  {
    $request = $typeProductRequest->except(['_token','file']);
    $typeProduct = TypeProduct::create($request);
    $id = $typeProduct->id;
    $file = $typeProductRequest->file('file');
    $fileHandler = new FileHandler();
    $fileHandler->upload($file, false, 'App\TypeProduct',$id);
    return redirect()->route('type-product-update',['id' => $id]);
    //return redirect()->route('list-categories',['id' => 1]);
  }

    /**
     *  Update TypeProduct
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateTypeProduct($id)
    {
        $id = (int)$id;
        $tnved = Tnved::all()->pluck('title','id');
        $typeProduct = TypeProduct::find($id);
        $file = File::where('fileable_id',$id)->where('fileable_type','App\TypeProduct')->first();
        return view('product.typeProduct.add', compact('typeProduct', 'file', 'tnved'));
    }

    /**
     *
     * Update Type Product Handl
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Redirect
     */
    public function updateTypeProductHandler($id, UpdateTypeProductRequest $request)
    {
        $file = $request->file;
        $id = (int)$id;
        $typeProductRequest = $request->except('_token','file');
        TypeProduct::where('id', $id)->update($typeProductRequest);
        if($file) {
          $currentFile = File::where('fileable_id',$id)->where('fileable_type','App\TypeProduct')->first();
          if($currentFile)
          {
            $currentFile->delete();
          }
          $fileHandler = new FileHandler();
          $fileHandler->upload($file, false, 'App\TypeProduct',$id);
        }
        return redirect()->route('list-categories',['id' => 1]);
    }


  /**
   * List Type Products
   * @return \Illuminate\Http\Response
   */
  public function listTypeProduct() {
    $typeProducts = TypeProduct::All();
    return view('product.typeProduct.list',compact('typeProducts'));
  }

  /**
   *
   * Create Attribute
   */
  public function createAttribute()
  {
      return view('product.attribute.create');
  }

    /**
     *
     * Create Attribute Handler
     * @param StoreAttributeRequest $attributeRequest
     * @return \Illuminate\Http\Redirect
     */
    public function createAttributeHandler(StoreAttributeRequest $attributeRequest)
    {
        $request = $attributeRequest->except(['_token']);
        $producer = Attribute::create($request);
        return redirect()->route('list-categories',['id' => 1]);
    }


  /**
   *
   * Add Producer
   */
  public function addProducer()
  {
    return view('product.producer.add');
  }

  /**
   *
   * Add Producer Handler
   * @param StoreProducerRequest $producerRequest
   * @return \Illuminate\Http\Redirect
   */
  public function addProducerHandler(StoreProducerRequest $producerRequest)
  {
    $request = $producerRequest->except(['_token']);
    $producer = Producer::create($request);
    return redirect()->route('list-categories',['id' => 1]);
  }


  /**
   * Get Product Elements
   * @param int $id
   * @return JSON
   */
  public function elementsLine($id) {
    $products = Product::with('files')->where('producer_type_product_id',$id)->get();
    return $products->toArray();
  }


  public function special() {
    $specialProducts = Product::with('files')->where('special',1)->get();
    return $specialProducts->toJson();
  }

  public function typeProduct() {
    $typeProducts = TypeProduct::with('files')->get();
    return $typeProducts->toArray();
  }

  public function images($id) {
    $imageProducts = File::with('typeFile')->whereHas('typeFile', function($query) {
      $query->where('name','detailimage');
    })->where('fileable_id',$id)->where('fileable_type','App\Product')->get();
    return $imageProducts->toArray();
  }

  public function findProduct(Request $request) {
    $title = $request->title;
    $products = Product::where('title','LIKE',$title)->paginate(10);
    $categories = Category::where('parent',1)->get();
    return view('category.list', compact('categories','products'));
  }
}