<?php
namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\News;
use App\FileHandler;
use App\File;
use Illuminate\Http\Request;
use App\Http\Requests\News\UpdateNewsRequest;

class NewsController extends Controller
{
  /**
   *
   * Add News
   *
   * @return \Illuminate\Http\Response
   */
  public function add()
  {
    $news = News::where('title','По умолчанию')->first();
    if(!$news)
    {
      $news = new News;
      $news->title = "По умолчанию";
      $news->url_key = \Slug::make($news->title);
      $news->save();
    }
    $id = $news->id;
    return view('news.add',compact('id','news'));
  }


  /**
   *  Update News
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update($id)
  {
    $news = News::find($id);
    $file = File::where('fileable_id',$id)->where('fileable_type','App\News')->first();
    return view('news.add',compact('id','news','file'));
  }


  /**
   *  Update News
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function updateHand($id, UpdateNewsRequest $request)
  {
    $file = $request->file;
    $newsRequest = $request->except('_token','file');
    $id = (int)$id;
    $normTitle = str_replace("/"," ",$request["title"]);
    $newsRequest['url_key'] = \Slug::make($normTitle);
    News::where('id', $id)->update($newsRequest);
    if($file) {
      $currentFile = File::where('fileable_id',$id)->where('fileable_type','App\News')->first();
      if($currentFile)
      {
        $currentFile->delete();
      }
      $fileHandler = new FileHandler();
      $fileHandler->upload($file, false, 'App\News', $id);
    }
    return redirect()->route('list-news');
  }

  /**
   * List News Admin
   * @return \Illuminate\Http\Response
   */
  public function listNews() {
    $news = News::All();
    return view('news.listnews',compact('news'));
  }

  /**
   *
   * Delete News
   *
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $news = News::find($id);
    $currentFiles = File::where('fileable_id',$id)->where('fileable_type','App\News')->get();
    foreach ($currentFiles as $currentFile) {
      $currentFile->delete();
    }
    $news->delete();
    return redirect()->back();
  }


  /**
   * List News
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $news = News::with('files')->get();
    return view('news.index',compact('news'));
  }

  /**
   * View news
   * @return \Illuminate\Http\Response
   */
  public function show($slug) {
    $news = News::with('files')->where('url_key',$slug)->first();
    return view('news.show',compact('news'));
  }

}