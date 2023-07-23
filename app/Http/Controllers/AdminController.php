<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IndexGet;
use App\Models\Inquiry;
use Illuminate\View\View;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * 1ページあたりの表示件数
     */
    private const PER_PAGE = 10;

    /**
     * 初期ページ
     */
    private const DEFAULT_PAGE = 1;

    /**
     * @param IndexGet $request
     * @return View
     */
    public function index(IndexGet $request): View
    {
        $page = $request->validated('page') ?? self::DEFAULT_PAGE;
        $inquiries = Inquiry::query()->orderBy('created_at', 'desc')
            ->paginate(self::PER_PAGE, ['*'], 'page', $page);

        return view('admin.index', compact('inquiries'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $inquiry = Inquiry::query()->findOrFail($id);

        return view('admin.show', compact('inquiry'));
    }
}
