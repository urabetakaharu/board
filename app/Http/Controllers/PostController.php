<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $q = \Request::query();
        
        if(isset($q['category_id'])){
            
            $posts=Post::latest()->where('category_id',$q['category_id'])->paginate(5);
            $posts->load('category','user');
            $posts->load('category','user','tags');
            
            return view('posts/index',compact('posts','category_id'));
        
        }if(isset($q['tag_name'])){
            
            $posts=Post::latest()->where('content','Like',"%{$q['tag_name']}%")->paginate(5);
            $posts->load('category','user');
            $posts->load('category','user','tags');
            
            return view('posts/index',compact('posts','tag_name'));
            
        }else{
            $posts=Post::latest()->paginate(5);
            $posts->load('category','user');
            
            return view('posts/index',compact('posts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        //validateはPostRequestのrulesを呼び出す
        $post->create($request->validated());
        
        $post->user_id=$request->user_id;
        $post->category_id=$request->category_id;
        $post->content=$request->content;
        $post->title=$request->title;
        
        
        
        
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->content, $match);
        
        $tags=[];
        foreach($match[1] as $tag){
            $record=Tag::firstOrCreate(['tag_name'=>$tag]);
            array_push($tags, $record);
        }
        
        $tag_ids=[];
        
        foreach($tags as $tag){
            array_push($tag_ids, $tag['id']);
        }
        
        $post->save();
        $post->tags()->attach($tag_ids);
        
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post->load('category','user','comments.user');
        //  dd($post);
        return view('posts/show')
        ->with(
            ['post' => $post->load('category','user','comments.user')]
            );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function search(Request $request)
    {
        $posts=Post::where('title','Like',"%{$request->search}%")
        ->orwhere('content','Like',"%{$request->search}%")
        ->paginate(3);
        
        
        $search_result=$request->search.'の検索結果'.$posts->total().'件';
        return view('posts/index', [
            'posts' => $posts,
            'search_result'=>$search_result,
            'search_query'=>$request->search
            ]);
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
}
