<!-- resources/views/makes.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            キャンペーンを作りましょう
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
                キャンペーンのタイトル
                <div class="col-sm-6">
                    <input type="text" name="make_title" class="form-control">
                </div>
            </div>
            <!-- 投稿の本文 -->
            <div class="form-group">
                キャンペーンへの思いや、エピソード
                <div class="col-sm-6">
                    <input type="text" name="make_desc" class="form-control">
                </div>
            </div>
            <!--　登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        キャンペーンを作成する
                    </button>
                </div>
            </div>
        </form>
        @endif
    </div>
    
    
    
    <!-- お気に入り一覧 -->
    @if( Auth::check() )
    	@if (count($favo_posts) > 0)
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>賛同一覧</th>
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

 