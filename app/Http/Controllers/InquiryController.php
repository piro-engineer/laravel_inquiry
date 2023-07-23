<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\InquiryStoreRequest;
use App\Models\Inquiry;
use App\Models\User;
use App\Services\InquiryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class InquiryController
 * @package App\Http\Controllers
 * お問い合わせ用コントローラー
 */
class InquiryController extends Controller
{
    /**
     * @var InquiryService
     */
    private InquiryService $inquiryService;

    /**
     * @param InquiryService $inquiryService
     */
    public function __construct(
        InquiryService $inquiryService
    ) {
        $this->inquiryService = $inquiryService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('inquiry');
    }

    /**
     * @param InquiryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(InquiryStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $inquiry = new Inquiry();
        $inquiry->fill($validated);
        $inquiry->save();

        $users = User::all();
        $users->each(
            function (User $user) use ($inquiry) {
                $this->inquiryService->send($user, $inquiry);
            }
        );

        return redirect()->route("inquiries.complete");
    }

    /**
     * @return View
     */
    public function complete(): View
    {
        return view('inquiryComplete');
    }
}
