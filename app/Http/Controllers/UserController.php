<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTableRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserTableRequest $request)
    {
        $query = User::query();

        if ($request->has('filter.country')) {
            $query->countryCode($request->input('filter.country'));
        }

        if ($request->has('filter.comment_activity_trend')) {
            $query->byTrend($request->input('filter.comment_activity_trend'));
        }

        if ($request->has('sort')) {
            $query->customSort($request->input('sort.field'), $request->input('sort.direction'));
        }

        return UserResource::collection($query->paginate(request('per_page', 5)));
    }
}
