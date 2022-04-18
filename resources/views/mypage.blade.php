<!-- resources/views/makes.blade.php -->
@extends('layouts.app')
@section('content')
<!-- お気に入り一覧 -->
    @if( Auth::check() )
    	@if (count($favo_posts) > 0)
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>これまで賛同したキャンペーン</th>
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
                                    <!-- 詳細ボタン -->
                                    <td>
                                        <a href="{{ route('shousai', ['id'=>$favo_post->id]) }}" class="btn btn-primary">詳細</a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>		
        @endif 

    @endif
    
    <!-- makesページへ戻る -->
    <td class="table-text">
        <a href="{{ url('/') }}" type="submit" class="btn btn-danger">投稿ページへ</a>
    </td>
    
    @endsection