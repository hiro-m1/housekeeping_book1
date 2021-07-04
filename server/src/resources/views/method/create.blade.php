@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">登録</div>

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

                      <form method="POST" action="{{route('method.store')}}">
                      @csrf
                      支払方法
                      <input type="text" name="methods_name">
                      <br>
                      締め日
                      <input type="text" name="closing_date">
                      <br>
                      支払口座
                      <select name="age">
                        <option value="">選択してください</option>
                        <option value="1">～19歳</option>
                        <option value="2">20歳～29歳</option>
                        <option value="3">30歳～39歳</option>
                        <option value="4">40歳～49歳</option>
                        <option value="5">50歳～59歳</option>
                        <option value="6">60歳～</option>
                      </select>
                      <br>
                      <input class="btn btn-info" type="submit" value="登録する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
