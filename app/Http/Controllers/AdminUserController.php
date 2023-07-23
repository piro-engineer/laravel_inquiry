<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\IndexGet;
use App\Http\Requests\User\StorePost;
use App\Http\Requests\User\UpdatePut;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
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
        $keyword = $request->input('keyword');
        $query = User::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        }

        $page = $request->validated('page') ?? self::DEFAULT_PAGE;
        $users = $query->paginate(self::PER_PAGE, ['*'], 'page', $page);


        return view('adminUsers.index', compact('users', 'keyword'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view("adminUsers.create");
    }

    /**
     * @param StorePost $request
     * @return RedirectResponse
     */
    public function store(StorePost $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = new User();
        $user->fill($validated);
        $user->save();

        return redirect()->route("admin.users.index")->with('flash_message', '登録が完了しました。');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user = User::query()->findOrFail($id);

        return view('adminUsers.edit', compact('user'));
    }

    /**
     * @param UpdatePut $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdatePut $request, int $id): RedirectResponse
    {
        $user = User::query()->find($id);
        if (is_null($user)) {
            abort(404);
        }
        $validated = $request->validated();
        $user->fill($validated);
        $user->save();

        return redirect(route('admin.users.index'))->with('flash_message', '更新しました。');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = User::query()->find($id);
        if (is_null($user)) {
            abort(404);
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('flash_message', '削除しました。');
    }
}
