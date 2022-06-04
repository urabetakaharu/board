@extends('layouts.app')

@section('content')

<h1><div class="card-header">欲しいもの掲示板</div></h1>

<div class="card-body">
<div class="container">
<div class="row">
<div class="col-md-6">
<div id="custaom-search-input">
<div class="input-group col-md-12">
    <form action="{{ route('posts.search') }}" method="get">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" placeholder="キーワードを入力" name="search">
            <span class="input-group-btn">
            <button class="btn btn-outline-success" type="submit" >
                <i class="fas fa-search"></i> 検索
            </button>
            </span>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>


<!--//この条件が存在するときのみ-->
@isset($search_result)
    <h5 class="card title">{{ $search_result }}</h5>
@endisset

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($posts as $post)
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <h5 class="card-title">
                カテゴリー:
                <a href="{{route('posts.index',['category_id' => $post->category_id]) }}">
                {{ $post->category->category_name }}
                </a>
            </h5>
            <h5 class="card-title">
                投稿者:
                <a href="{{ route('users.show', $post->user_id) }}">
                {{ $post->user->name }}
                </a>
            </h5>
            
            <p class="card-text">{{ $post->content }}
                @foreach($post->tags as $tag)
                <a href="{{ route('posts.index', ['tag_name' => $tag->tag_name]) }}">
                    #{{ $tag->tag_name }}
                </a>
                @endforeach
            </p>
            <a href="{{ route('posts.show',$post->id) }}" class="btn btn-primary">詳細</a>
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn btn-primary">削除</button> 
            </form>
          </div>
        </div>
        
    @endforeach
    
    @if(isset($category_id))
        {{ $posts->appends(['category_id' => $category_id])->links() }}
    @elseif(isset($tag_name))
        {{ $posts->appends(['tag_name' => $tag_name])->links() }}
    @elseif(isset($search_query))
        {{ $posts->appends(['search' => $search_query])->links() }}
    @else
        {{ $posts->links() }}
    @endif


</div>
@endsection


