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
                      <input type="text" name="method_name">
                      <br>
                      締め日
                      <input type="text" name="closing_date" maxlength="2" size="2">日
                      <br>
                      支払口座
                      <select name="bank_id">
                          <option value="">選択してください</option>
                        @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}" > {{ $bank->bank_name }} </option>
                        @endforeach
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
