@extends('layout.layout')

@section('title')
    お問い合わせ完了
@endsection

@section('content')
<div style="margin-top: 50px;">
    <div class="alert alert-primary" role="alert" style="text-align: center;">
        お問い合わせありがとうございました。
    </div>

    <a href="{{ route('inquiries.index') }}">
        <button type="button" class="btn btn-primary btn-sm">トップへ戻る</button>
    </a>
</div>
@endsection
