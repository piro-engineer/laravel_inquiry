@extends('layout.layout')

@section('title')
    管理者ダッシュボード詳細
@endsection

@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 100px">
        <div class="card" style="width: 48rem;">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">名前：{{$inquiry->name}}</li>
                    <li class="list-group-item">メールアドレス：{{$inquiry->email}}</li>
                    <li class="list-group-item">お問い合わせ内容：{{$inquiry->content}}</li>
                    <li class="list-group-item">お問い合わせ種別：{{$inquiry->type}}</li>
                    <li class="list-group-item">送信日：{{$inquiry->created_at}}</li>
                </ul>
                <a href="{{ route('admin.index') }}" class="btn btn-primary d-flex justify-content-center mt-3">お問い合わせ一覧に戻る</a>
            </div>
        </div>
    </div>
@endsection
