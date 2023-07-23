@extends('layout.layout')

@section('title')
    お問い合わせフォーム
@endsection

@section('content')
    <div style="margin: 100px;">
        <form action="{{ route('inquiries.store') }}" method="post">
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
            {{-- 詳細 --}}
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">お問い合わせ内容</label>
                @if($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
                @endif
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="お問い合わせ内容を記入してください。" name="content">{{ old('content') }}</textarea>
            </div>
            {{-- セレクトボックス --}}
            @if($errors->has('type'))
                @foreach($errors->get('type') as $message)
                    <span class="text-danger">{{ $message }}</span>
                @endforeach
            @endif
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">お問い合わせ種別</label>
                <select class="form-select" aria-label="Default select example" name="type">
                    <option value="">選択してください</option>
                    @foreach(\App\Enums\InquiryType::cases() as $inquiryType)
                        <option value="{{ $inquiryType->value }}" @if(old('type')===$inquiryType->value) selected @endif>{{ $inquiryType->text() }}</option>
                    @endforeach
                </select>
            </div>
            {{-- 送信ボタン --}}
            <div class="col text-center">
                <button type="submit" class="btn btn-secondary" style="margin: 50px 0;">送信</button>
            </div>
        </form>
    </div>
@endsection
