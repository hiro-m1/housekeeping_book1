@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">科目マスタ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <form method="GET" action="{{ route('subject.create') }}">
                        <button type="submit" class="btn btn-primary">
                          新規登録
                        </button>
                      </form>
                    {{-- <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('subject.index')}}">
                        <input class="form-control mr-sm-2" name="search" type="search" placeholder="検索" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
                      </form> --}}
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">id</th>
                            <th scope="col">科目名</th>
                            <th scope="col">登録日</th>
                            <th scope="col">更新日</th>
                            <th scope="col">編集</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($subjects as $subject)
                            <tr>
                              <th>
                                {{ $subject->id }}
                              </th>
                              <td>
                                {{ $subject->subject_name }}
                              </td>
                              <td>
                                {{ $subject->created_at }} 
                              </td>
                              <td>
                                {{ $subject->updated_at }}
                              </td>
                              <td>
                              <a href="{{ route('subject.edit', ['id' => $subject->id]) }}">編集</a>
                              </td>
                            </tr>
                      @endforeach
                        </tbody>
                      </table>
                      {{-- {{ $contacts->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
