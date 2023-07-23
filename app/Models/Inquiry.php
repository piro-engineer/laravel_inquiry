<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InquiryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id ID
 * @property string $name 名前
 * @property string $email メールアドレス
 * @property string $content お問い合わせ内容
 * @property InquiryType $type お問い合わせタイプ
 */
class Inquiry extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => InquiryType::class,
    ];

    protected $fillable = ['name', 'email', 'content', 'type'];
}
