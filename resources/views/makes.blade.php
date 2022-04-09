<!-- resources/views/makes.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            投稿フォーム
        </div>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム -->
        @if( Auth::check() )
        <form action="{{ url('makes') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- 投稿のタイトル -->
            <div class="form-group">
                投稿のタイトル
                <div class="col-sm-6">
                    <input type="text" name="make_title" class="form-control">
                </div>
            </div>
            <!-- 投稿の本文 -->
            <div class="form-group">
                投稿の本文
                <div class="col-sm-6">
                    <input type="text" name="make_desc" class="form-control">
                </div>
            </div>
            <!--　登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
        @endif
    </div>
    
    <!-- 全ての投稿リスト -->
    @if (count($makes) > 0)
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>投稿一覧</th>
                            <th>&nbsp;</th>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                            @foreach ($makes as $make)
                                <tr>
                                    <!-- 投稿タイトル -->
                                    <td class="table-text">
                                        <div>{{ $make->make_title }}</div>
                                    </td>
                                     <!-- 投稿詳細 -->
                                    <td class="table-text">
                                        <div>{{ $make->make_desc }}</div>
                                    </td>
    				                <!-- 投稿者名の表示 -->
                                    <td class="table-text">
                                       <div>{{ $make->user->name }}</div>
                                    </td>
     				                <!-- お気に入りボタン -->
     				                <td class="table-text">
                                    @if(Auth::check())
                                    	@if(Auth::id() != $make->user_id && $make->favo_user()->where('user_id',Auth::id())->exists() !== true)
                                    	<form action="{{ url('make/'.$make->id) }}" method="POST">
                                    		{{ csrf_field() }}
                                    		<button type="submit" class="btn btn-danger">
                                    		お気に入り
                                    		</button>
                                    	</form>
                                    	@endif
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>		
        @endif
    
    <!-- お気に入り一覧 -->
    @if( Auth::check() )
    	@if (count($favo_posts) > 0)
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>お気に入り一覧</th>
                            <th>&nbsp;</th>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                            @foreach ($favo_posts as $favo_post)
                                <tr>
                                    <!-- 投稿タイトル -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->make_title }}</div>
                                    </td>
                                     <!-- 投稿詳細 -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->make_desc }}</div>
                                    </td>
                                    <!-- 投稿者名の表示 -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->user->name }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>		
        @endif 

    @endif
    
    
@endsection

 