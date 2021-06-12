<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update user
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255']
        ]);


        $request->user()->update($data);

        return response()->json(['success' => 'User details updated successfully!', $data], 200);
    }

    /**
     * Show user details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $user = auth()->user();
        return response()->json($user, 200);
    }
    
    /**
     * Delete user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $user = User::find(auth()->user()->id);

        //Revoke tokens
        $user->tokens()->delete();

        $user->delete();

        return response()->json(['success' => 'User deleted successfully!'], 204);
    }
}
