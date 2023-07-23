@extends('layout.layout')

@section('title')
    管理者ダッシュボード
@endsection

@section('content')
    <p class="h1 d-flex justify-content-center mt-3">管理者ダッシュボード</p>

    @if( count($errors) )
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div style="margin: 24px 48px">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">名前</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">お問い合わせ内容</th>
                <th scope="col">お問い合わせ種別</th>
                <th scope="col">作成日</th>
            </tr>
            </thead>
            <tbody>
            @php
                /** @var Illuminate\Support\Collection<App\Models\Inquiry> $inquiries */
            @endphp
            @foreach ($inquiries as $inquiry)
                <tr>
                    <th scope="row"><a href="{{ route('admin.show', $inquiry->id) }}">{{$inquiry->id}}</a></th>
                    <td>{{$inquiry->name}}</td>
                    <td>{{$inquiry->email}}</td>
                    <td>{{$inquiry->content}}</td>
                    <td>{{$inquiry->type->text()}}</td>
                    <td>{{$inquiry->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $inquiries->links('pagination::bootstrap-4') }}
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
@endsection
