<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $user = \App\Models\User::where('username', $username)->with(['profile', 'watchlists.anime', 'favorites.anime', 'reviews.anime'])->firstOrFail();
        return view('profileshow', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addWatchlist(\Illuminate\Http\Request $request, $anime_id)
    {
        $watchlist = auth()->user()->watchlists()->where('anime_id', $anime_id)->first();
        if ($watchlist) {
            $watchlist->delete();
        } else {
            auth()->user()->watchlists()->create([
                'anime_id' => $anime_id,
                'status' => 'watching'
            ]);
        }
        $anime = \App\Models\Anime::findOrFail($anime_id);
        return redirect(route('anime.show', $anime->title) . '#actions');
    }

    public function addFavorite(\Illuminate\Http\Request $request, $anime_id)
    {
        $favorite = auth()->user()->favorites()->where('anime_id', $anime_id)->first();
        if ($favorite) {
            $favorite->delete();
        } else {
            auth()->user()->favorites()->create([
                'anime_id' => $anime_id
            ]);
        }
        $anime = \App\Models\Anime::findOrFail($anime_id);
        return redirect(route('anime.show', $anime->title) . '#actions');
    }

    public function addReview(\Illuminate\Http\Request $request, $anime_id)
    {
        $request->validate(['body' => 'required|string']);
        auth()->user()->reviews()->create([
            'anime_id' => $anime_id,
            'body' => $request->body
        ]);
        $anime = \App\Models\Anime::findOrFail($anime_id);
        return redirect(route('anime.show', $anime->title) . '#reviews');
    }

    public function addRating(\Illuminate\Http\Request $request, $anime_id)
    {
        $request->validate(['score' => 'required|integer|min:1|max:10']);
        auth()->user()->ratings()->updateOrCreate(
            ['anime_id' => $anime_id],
            ['score' => (string) $request->score]
        );
        $anime = \App\Models\Anime::findOrFail($anime_id);
        return redirect(route('anime.show', $anime->title) . '#actions');
    }

    public function editProfile($username)
    {
        if (auth()->user()->username !== $username) { abort(403); }
        return view('profileedit');
    }

    public function updateProfile(\Illuminate\Http\Request $request, $username)
    {
        if (auth()->user()->username !== $username) { abort(403); }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'avatar' => 'nullable|url',
            'bio' => 'nullable|string|max:1000'
        ]);

        $user = auth()->user();
        $user->username = $request->username;
        $user->save();

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'username' => $request->username,
                'avatar' => $request->avatar ?? '',
                'bio' => $request->bio ?? ''
            ]
        );

        return redirect()->route('profile.show', $user->username);
    }

    public function adminIndex()
    {
        if (auth()->user()->role !== 'admin') { abort(403); }
        $users = \App\Models\User::with('profile')->orderBy('created_at', 'desc')->get();
        return view('adminusers', compact('users'));
    }

    public function adminEdit($username)
    {
        if (auth()->user()->role !== 'admin') { abort(403); }
        $targetUser = \App\Models\User::where('username', $username)->firstOrFail();
        return view('profileedit3', compact('targetUser'));
    }

    public function adminUpdate(\Illuminate\Http\Request $request, $username)
    {
        if (auth()->user()->role !== 'admin') { abort(403); }
        $targetUser = \App\Models\User::where('username', $username)->firstOrFail();

        $request->validate([
            'role' => 'required|string|in:user,admin',
            'username' => 'required|string|max:255|unique:users,username,' . $targetUser->id,
            'password' => 'nullable|string|min:8',
            'avatar' => 'nullable|url',
            'bio' => 'nullable|string|max:1000'
        ]);

        $targetUser->role = $request->role;
        $targetUser->username = $request->username;
        if ($request->filled('password')) {
            $targetUser->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $targetUser->save();

        $targetUser->profile()->updateOrCreate(
            ['user_id' => $targetUser->id],
            [
                'username' => $request->username,
                'avatar' => $request->avatar ?? '',
                'bio' => $request->bio ?? ''
            ]
        );

        return redirect()->route('admin.users');
    }
}
