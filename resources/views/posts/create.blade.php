@extends('layouts.app')

@section('content')
<div class="card-header">Board</div>
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
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="tiltle" name="title">
            </div>
            
            <!--<div class="form-group">-->
            <!--    <label for="exampleFormControlFile1">Example file input</label>-->
            <!--    <input type="file" class="form-control-file" id="exampleFormControlFile1" placeholder="tiltle" name="title">-->
            <!--</div>-->

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">category</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                    <option selected="">選択する</option>
                    <option value="1">家具</option>
                    <option value="2">家電</option>
                    <option value="3">自転車</option>
                    <option value="4">車のパーツ</option>
                    <option value="5">バイク</option>
                    <option value="6">楽器</option>
                    <option value="7">チケット</option>
                    <option value="8">生活雑貨</option>
                    <option value="9">子供用品</option>
                    <option value="10">おもちゃ</option>
                    <option value="11">スポーツ</option>
                    <option value="12">パソコン</option>
                    <option value="13">携帯/スマホ</option>
                    <option value="14">本/CD/DVD</option>
                    <option value="15">服/ファッション</option>
                    <option value="16">靴/バッグ</option>
                    <option value="17">コスメ/ヘルスケア</option>
                    <option value="18">食品</option>
                    <option value="19">お酒</option>
                    <option value="20">グッツ</option>
                    <option value="21">その他</option>
                </select>
            </div>
          
            <div class="form-group">
                <label for="comment">comment</label>
                <textarea class="form-control" row="5" id="comment" name="content"></textarea>
            </div>
            
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>
</div>
@endsection