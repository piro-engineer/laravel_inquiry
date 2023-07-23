@extends('layout.layout')

@section('title')
    管理ユーザー一覧
@endsection

@section('content')
    <p class="h1 d-flex justify-content-center mt-3">管理ユーザー</p>

    @if( count($errors) )
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- 検索フォーム --}}
    <div class="row">
        <div class="col-sm-4">
            <form class="form-inline" action="{{ route('admin.users.index') }}" method="get">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="名前またはメールアドレス">
                </div>
                <input type="submit" value="検索" class="btn btn-primary">
            </form>
        </div>
    </div>

    <div style="margin: 24px 48px">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">名前</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">作成日</th>
                <th scope="col">詳細</th>
                <th scope="col">削除</th>
            </tr>
            </thead>
            <tbody>
            @php
                /** @var Illuminate\Support\Collection<App\Models\User> $users */
            @endphp
            @foreach ($users as $user)
                <tr>
                    <th scope="row"><a href="{{ route('admin.users.edit', $user->id) }}">{{$user->id}}</a></th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route('admin.users.edit', $user->id) }}">詳細</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.users.destroy', ['id'=>$user->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-secondary">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
@endsection
