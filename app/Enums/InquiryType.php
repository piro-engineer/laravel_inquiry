<?php

declare(strict_types=1);

namespace App\Enums;

enum InquiryType: string
{
    case ESTIMATE = 'estimate';
    case RECRUIT = 'recruit';
    case OTHER = 'other';

    /** 表示用のテキストを取得 */
    public function text(): string
    {
        return match($this) {
            self::ESTIMATE => 'お見積もり',
            self::RECRUIT => '採用',
            self::OTHER => 'その他',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}
