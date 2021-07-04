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
                    <form method="POST" action="{{ route('subject.update', ['id' => $subject->id]) }}">
                    @csrf

                    科目名
                      <input type="text" name="subject_name" value="{{ $subject->subject_name }}">
                      <br>
                      <input class="btn btn-info" type="submit" value="更新する">
                    </form>
                    <form method="POST" action="{{ route('subject.destroy', ['id' => $subject->id]) }}" id="delete_{{ $subject->id }}">
                     @csrf
                       <a href="#" class="btn btn-danger" data-id="{{ $subject->id }}" onclick="deletePost(this);">削除する</a>
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
