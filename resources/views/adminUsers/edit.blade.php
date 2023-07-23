@extends('layout.layout')

@section('title')
    管理ユーザー詳細
@endsection
@php
    /** @var App\Models\User $user */
@endphp
@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 100px">
        <div class="card" style="width: 48rem;">
            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            名前：<input type="text" name="name" value="{{ old('name', $user->name) }}">
                        </li>
                        <li class="list-group-item">
                            メールアドレス：<input type="email" name="email" value="{{ old('email', $user->email) }}">
                        </li>
                        <li class="list-group-item">作成日：{{$user->created_at}}</li>
                    </ul>
                    <button type="submit" class="btn btn-primary mt-3">更新</button>
                </div>
            </form>
            <a href="{{ route('admin.users.index') }}" class="btn btn btn-secondary d-flex justify-content-center mt-3">管理ユーザー一覧に戻る</a>
        </div>
    </div>
@endsection
