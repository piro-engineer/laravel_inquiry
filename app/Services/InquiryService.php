<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Inquiry;
use App\Models\User;
use App\Notifications\InquiryNotification;

class InquiryService
{
    /**
     * メールを送る
     *
     * @param User $user
     * @param Inquiry $inquiry
     */
    public function send(User $user, Inquiry $inquiry): void
    {
        $user->notify(
            new InquiryNotification(
                $inquiry
            )
        );
    }
}
