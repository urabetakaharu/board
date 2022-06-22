@extends('layouts.app')

@section('content')

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ url('/') }}">一覧表示</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">お気に入り</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">ランキング</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">フォローリスト</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">欲しいものリスト</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('posts.create') }}" class="nav-link">投稿</a>
  </li>
</ul>

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <h5 class="card-title">
                    カテゴリー:{{ $post->category->category_name }}
                </h5>
                <h5 class="card-title">
                    投稿者:{{ $post->user->name }}
                </h5>
                <p class="card-text">{{ $post->content }}</p>
                @if($post->users()->where('user_id', Auth::id())->exists())
                    <div class="col-md-3">
                      <form action="{{ route('unfavorites', $post) }}" method="POST">
                         @csrf
                         <input type="submit" value="&#xf164;{{ $post->users()->count() }}" class="fas btn btn-link">
                      </form>
                     </div>
                @else
                    <div class="col-md-3">
                      <form action="{{ route('favorites', $post) }}" method="POST">
                        @csrf
                        <input type="submit" value="&#xf164;{{ $post->users()->count() }}" class="fas btn btn-link">
                      </form>
                     </div>
                @endif
                
                <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary">編集</a>
                
            </div>
        </div>
      <div class ="p-3">
      <h3 class="card_title">コメント一覧</h3>
        @foreach($post->comments as $comment)
            <div class="card">
              <div class="card-body">
                <p class="card-text">{{ $comment->comment }}</p>
                <p class="card-text">
                    投稿者：
                    <a href="{{ route('users.show',$comment->user->id) }}">
                        {{ $comment->user->name }}
                    </a>
                </p>
              </div>
            </div>
        @endforeach
        <a href="{{ route('comments.create',['post_id'=>$post->id]) }}" class="btn btn-primary">コメントする</a>
      </div>
</div>
@endsection