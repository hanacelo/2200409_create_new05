<!-- resources/views/makes.blade.php -->
@extends('layouts.app')
@section('content')

<!-- 全ての投稿リスト -->
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>キャンペーン一覧</th>
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
                                    <!-- 詳細ボタン -->
                                    <td><a href="{{ url('/shousai', ['id'=>$make->id]) }}" class="btn btn-primary">詳細</a></td>
     				                <!-- 賛同ボタン -->
     				                <td class="table-text">
                                    @if(Auth::check())
                                    	@if(Auth::id() != $make->user_id && $make->favo_user()->where('user_id',Auth::id())->exists() !== true)
                                    	<form action="{{ url('make/'.$make->id) }}" method="POST">
                                    		{{ csrf_field() }}
                                    		<button type="submit" class="btn btn-danger">
                                    		賛同
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
            
            <td class="table-text">
                <a href="{{ url('/') }}" type="submit" class="btn btn-danger">さらにキャンペーンを作る</a>
            </td>

  @endsection