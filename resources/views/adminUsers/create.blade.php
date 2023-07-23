@extends('layout.layout')

@section('title')
    管理者登録
@endsection

@section('content')
    <div style="margin: 100px;">
        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            {{-- 名前 --}}
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">名前</label>
                @if($errors->has('name'))
                    @foreach($errors->get('name') as $message)
                        <span class="text-danger">{{ $message }}</span>
                    @endforeach
                @endif
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="テスト 太郎" name="name" value="{{ old('name') }}">
            </div>
            {{-- メアド --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">メールアドレス</label>
                @if($errors->has('email'))
                    @foreach($errors->get('email') as $message)
                        <span class="text-danger">{{ $message }}</span>
                    @endforeach
                @endif
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="test@example.com" name="email" value="{{ old('email') }}">
            </div>
            {{-- パスワード --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">パスワード</label>
                @if($errors->has('password'))
                    @foreach($errors->get('password') as $message)
                        <span class="text-danger">{{ $message }}</span>
                    @endforeach
                @endif
                <input type="password" class="form-control" id="exampleFormControlInput1" name="password">
            </div>
            {{-- 送信ボタン --}}
            <div class="col text-center">
                <button type="submit" class="btn btn-secondary" style="margin: 50px 0;">登録</button>
            </div>
        </form>
    </div>
@endsection
