<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Make; //この行を上に追加
use App\Models\User;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加

class MakesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 全ての投稿を取得
        $makes = Make::get();
        
        
        if (Auth::check()) {
             //ログインユーザーのお気に入りを取得
             $favo_posts = Auth::user()->favo_posts()->get();
             
              return view('makes',[
            'makes'=> $makes,
            'favo_posts'=>$favo_posts
            ]);
            
        }else{
            
            return view('makes',[
            'makes'=> $makes
            ]);
            
        }
        
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'make_title' => 'required|max:255',
            'make_desc' => 'required|max:255',
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $makes = new Make;
        $makes->make_title = $request->make_title;
        $makes->make_desc = $request->make_desc;
        $makes->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $makes->save();
        
        return redirect('/ichiran');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //ichiranページに移行
        $makes = Make::all();
        return view("/ichiran" ,compact('makes') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //削除
        //ログイン中のユーザーを取得
        $user = Auth::user();
        //削除する記事
        $make = Make::find($id);
        $make->delete();
        return redirect(url('mypage'))->with('success', 'ブログ記事を削除しました');
    }
    
    //お気に入り処理
    public function favo($make_id)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //お気に入りする記事
        $make = Make::find($make_id);
        
        //リレーションの登録
        $make->favo_user()->attach($user);
        
        return redirect('ichiran');
    }
    
    
    //一覧表示
    public function ichiran($id)
    {
        // URLの生成
    $url = route('ichiran');
    
    // リダイレクトの生成
    return redirect()->route('ichiran');
    }
    
    //マイページの表示
    public function mypage($id)
    {
        // URLの生成
        $url = route('mypage');
    
        // リダイレクトの生成
        return redirect()->route('mypage');
    }
    
    /**
     * 詳細画面の表示
     */
    public function shousai($id)
    {
        $make = Make::find($id);

        return view('shousai', compact('make'))->with('make', $make);
    }
    

}