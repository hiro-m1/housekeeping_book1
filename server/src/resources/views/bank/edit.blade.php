@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">編集</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('bank.update', ['id' => $bank->id]) }}">
                    @csrf

                    銀行名
                      <input type="text" name="bank_name" value="{{ $bank->bank_name }}">
                      <br>
                    支店名
                      <input type="text" name="branch_name" value="{{ $bank->branch_name }}">
                      <br>
                    残高
                      <input type="text" name="balance" value="{{ $bank->balance }}">
                      <br>
                      <input class="btn btn-info" type="submit" value="更新する">
                    </form>
                    <form method="POST" action="{{ route('bank.destroy', ['id' => $bank->id]) }}" id="delete_{{ $bank->id }}">
                     @csrf
                       <a href="#" class="btn btn-danger" data-id="{{ $bank->id }}" onclick="deletePost(this);">削除する</a>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 // 削除ボタンを押したときの確認メッセージ
 function deletePost(e) {
     'use strict';
     if (confirm('本当に削除していいですか？')) {
         document.getElementById('delete_' + e.dataset.id).submit();
     }
 }
 
     
 </script>
 
@endsection
