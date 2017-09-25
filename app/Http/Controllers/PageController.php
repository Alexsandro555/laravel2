<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Psy\Exception\ErrorException;

class PageController extends Controller
{
    /**
     *
     * Add Page
     *
     * @return \Illuminate\Http\Response
     */
    public function addPage()
    {
        return view('page.add');
    }

    /**
     *
     * Add Page Handler
     * @param Request $request
     * @return \Illuminate\Http\Redirect
     */
    public function addPageHandler(Request $request)
    {

        $messages = [
            'name.required' => 'Поле Заголовок страницы должно быть заполнено',
            'url_key.required' => 'Поле URL-адрес должно быть заполнено',
            'content.required' => 'Поле Содержимое стараницы должно быть заполнено',
            'name.max' => 'Количество символов поля Заголовок страницы должно быть меньше :size',
            'url_key.max' => 'Количество символов поля URL-адрес должно быть меньше :size',
            'url_key.unique' => 'Поле URL-адрес должно быть уникальным',
        ];

        $this->validate($request, [
            'name' => 'required|max:255',
            'url_key' => 'required|unique:pages|max:255',
            'content' => 'required'
        ], $messages);


        $page = new Page;
        $request = $request->all();
        $page->name = $request["name"];
        $page->url_key = $request["url_key"];
        $page->content = $request["content"];
        $page->save();
        //$id = $page->id;
        return redirect()->route('showlist-page');
    }

    /**
     *  Update Page
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePage($id)
    {
        try
        {
            $id = (int)$id;
            $page = Page::where('id',$id)->firstOrFail();
            return view('page.add', compact('page'));
        }
        catch (ModelNotFoundException $e)
        {
            //dd(get_class_methods($e));
            //dd($e);
        }
    }

    /**
     *
     * Update Page Handl
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Redirect
     */
    public function updatePageHandler($id, Request $request)
    {
        $messages = [
            'name.required' => 'Поле Заголовок страницы должно быть заполнено',
            'url_key.required' => 'Поле URL-адрес должно быть заполнено',
            'content.required' => 'Поле Содержимое стараницы должно быть заполнено',
            'name.max' => 'Количество символов поля Заголовок страницы должно быть меньше :size',
            'url_key.max' => 'Количество символов поля URL-адрес должно быть меньше :size',
        ];

        $this->validate($request, [
            'name' => 'required|max:255',
            'url_key' => 'required|max:255',
            'content' => 'required'
        ], $messages);

        $id = (int)$id;

        $page = Page::where('id', $id)->firstOrFail();
        $request = $request->all();
        $page->name = $request["name"];
        $page->url_key = $request["url_key"];
        $page->content = $request["content"];
        $page->save();
        return redirect()->route('showlist-page');
    }


    /**
     *
     * Delete Page
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function deletePage($id, Request $request)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect()->route('showlist-page');
    }

    /**
     *
     * Show List Pages
     *
     * @return \Illuminate\Http\Response
     */
    public function showListPage()
    {
        $pages = Page::paginate(1);
        return view('page.showlist', compact('pages'));
    }

    /**
     *
     * Show Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showPage($id)
    {
        try
        {
            $id = (int)$id;
            $page = Page::where('id',$id)->firstOrFail();
            return view('page.show', compact('page'));
        }
        catch (ModelNotFoundException $e)
        {
            //dd(get_class_methods($e));
            //dd($e);
        }
    }

    /**
     *
     * Render page
     *
     * @param String $url_key
     * @return \Illuminate\Http\Response
     */
    public function indexPage($url_key)
    {
        try{
            $page = Page::where('url_key',$url_key)->firstOrFail();
            return view('page.index', compact('page'));
        }
        catch (ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
        }

    }


    /**
     *
     * CreateNewTable
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createTable(Request $request)
    {
        echo "work";
    }

    /**
     *
     * Autocomplete
     *
     * @param String $text
     * @return \Illuminate\Http\Response
     */
    public function autocomplete($text)
    {
        $page = Page::where('name', 'LIKE', $text.'%')->select('id','name','content')->get();
        return $page->toJson();
    }
}
