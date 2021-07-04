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
                    <form method="POST" action="{{ route('method.update', ['id' => $method->id]) }}">
                    @csrf

                    支払方法
                      <input type="text" name="method_name" value="{{ $method->method_name }}">
                      <br>
                    締め日
                      <input type="text" name="closing_date" value="{{ $method->closing_date }}" maxlength="2" size="2">日
                      <br>
                    支払口座
                      <select name="bank_id">
                        <option value="">選択してください</option>
                        @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}" @if ($bank->id === $method->bank_id) selected @endif> {{ $bank->bank_name }} </option>
                        @endforeach
                      </select>
                      <br>
                      <input class="btn btn-info" type="submit" value="更新する">
                    </form>
                    <form method="POST" action="{{ route('method.destroy', ['id' => $method->id]) }}" id="delete_{{ $method->id }}">
                     @csrf
                       <a href="#" class="btn btn-danger" data-id="{{ $method->id }}" onclick="deletePost(this);">削除する</a>
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
