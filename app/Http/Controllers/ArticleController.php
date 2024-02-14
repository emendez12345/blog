<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $articles=Article::where('user_id',$user->id)
        ->orderBy('id','desc')
        ->simplePaginate(10);

        return view('admin.articles.index',compact('articles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtenerr categorias publicas
        $categories=Category::select(['id','name'])
                            ->where('status','1')
                            ->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //
        $request->merge([
            'user_id'=>Auth::user()->id,        
        ]);
        //Guardo la solicitd en una variable
        $article=$request->all();

        if($request->hasFile('image')){
            $article['image']=$request->file('image')->store('articles');
        }

        Article::create($article);

        return redirect()->action([ArticleController::class,'index'])
                        ->with('success-create','Articulo creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //

        $coments=$article->comments()->simplePaginate(5);

        return view('subscriber.articles.show',compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //

         //Obtenerr categorias publicas
         $categories=Category::select(['id','name'])
         ->where('status','1')
         ->get();
         return view('admin.articles.edit', compact('categories','article'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        //Si el usuario sube una nueva imagen
        if($request->hasFile('image')){
            //Elimina la imagen
            File::delete(public_path('storage/'.$article->image));
            //Agrega la nueva imagen
            $article['image']=$request->file('image')->store('articles');
        }

        //Actualizar los datos
        $article->update([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'introduction'=>$request->introduction,
            'body'=>$request->body,
            'user_id'=>Auth::user()->id,
            'category_id'=>$request->category_id,
            'status'=>$request->status,
        ]);

        return redirect()->action([ArticleController::class,'index'])
                        ->with('success-update','Articulo actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //Eliminar imagen del articulo

        if($article->image){
            File::delete(public_path('storage/'.$article->image));
        }       

        //Eliminar articulo
        $article->delete();

        return redirect()->action([ArticleController::class,'index'],compact('article'))
                        ->with('success-delete','Articulo eliminado con exito');
    }
}
