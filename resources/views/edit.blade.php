@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <h1>投稿「{{$make->make_title}}」の編集</h1>

        <form action="{{ url('update') }}" method="POST">
            <!-- item_name -->
            <div class="form-group">
                <label for="item_name">Title</label>
                <input type="text" name="item_name" class="form-control" value="{{$make->make_title}}">
            </div>
            <!--/ item_name -->
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('home') }}"> Back</a>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$make->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>
@endsection



<form action="{{ url('shousai', ['id'=>$make->id]) }}" method="POST">
            <!-- 賛同者の名前 -->
            <div class="form-group">
                <input type="text" name="item_name" class="form-control" value="{{$make->user->name}}">
            </div>
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('shousai', ['id'=>$make->id]) }}"> Back</a>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$make->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>