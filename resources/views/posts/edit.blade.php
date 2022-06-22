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
    <a href="{{ route('posts.create') }}" class="nav-link ">投稿</a>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="tiltle" name="title" value="{{ $post->title }}">
            </div>
            
            <!--<div class="form-group">-->
            <!--    <label for="exampleFormControlFile1">Example file input</label>-->
            <!--    <input type="file" class="form-control-file" id="exampleFormControlFile1" placeholder="tiltle" name="title">-->
            <!--</div>-->

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">category</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category_id" >
                 
                  
                  @foreach($categories as $key => $category) 
                    <option value="{{  $key+1 }}"
                    @if($key+1 == $post->category->category_id? 'selected' :'')
                    @endif
                    >{{ $category->category_name }}</option>
                    
                  @endforeach
                    
                </select>
            </div>
            
            <div class="form-group">
                <label for="comment">comment</label>
                <textarea class="form-control" row="5" id="comment" name="content" value="{{ $post->comment }}"></textarea>
            </div>
            
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <button type="submit" class="btn btn-primary">Submit</button>
            
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline-block">
                @csrf
                @method('DELETE')
                <input type="submit" style="display:none">
                <button type="submit"class="btn btn-primary"><span onclick="return deletePost(this);">削除</span></button> 
            </form>
            
        </form>
      <script>
        function deletePost(){
            const result = window.confirm("本当に削除しますか？");
            if (result){
                return true;
            }else{
                return false;
            }
        }
      </script>
    </div>
    </div>
</div>
</div>
@endsection
