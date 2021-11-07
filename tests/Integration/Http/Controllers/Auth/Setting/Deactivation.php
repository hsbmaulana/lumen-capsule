<?php

namespace Tests\Integration\Http\Controllers\Auth\Setting;

use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Tests\Integration\Events\Auth\Deactivated;

class Deactivation extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = auth()->user(); $content = null; $status = 0;
        $this->authorize('deactivateable');
        // $validateddata = $this->validate($request, []); //

        DB::beginTransaction();

        try {

            $user->delete();

            DB::commit();

            event(new Deactivated($user));

            $status = 201;

        } catch (Exception $exception) {

            DB::rollback();

            $status = 304;
        }

        return response()->json($content, $status);
    }
}