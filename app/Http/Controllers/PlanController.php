<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;

class PlanController extends Controller
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
    public function show(string $id)
    {
        //
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
        $plan = Plan::findOrFail($id);
        $plan->update($request->only(['name', 'price', 'message_limit']));

        return redirect()->back()->with('success', 'Plan actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function purchasePlan($id)
    {
        $plan = Plan::findOrFail($id);
        $user = Auth::user();

        if ($user instanceof User) {
            $user->update([
                'plan_id' => $plan->id,
                'message_limit' => $plan->message_limit
            ]);

            return redirect()->route('home')->with('status', '¡Plan adquirido correctamente!');
        }

        return redirect()->route('login')->with('error', 'Debes iniciar sesión para comprar un plan.');
    }

}
