<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\IcountService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::defaults()],
            'company_name' => 'required|string|max:255',
            'license' => 'required|string|max:255',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'company_name' => $validated['company_name'],
            'phone' => $validated['phone'],
            'license' => $validated['license'],
        ]);

        // Log the user in
        Auth::login($user);

        // Return success response
        return redirect()->route('dashboard');
    }

    public function subscribe()
    {
        $icountService = new IcountService;

        $card_number = 5123450000000008;
        $cc_cvv = 100;
        $cc_validity = "01/39";
        
        $data = [
            "sid" => "string",
            "cid" => "string",
            "user" => "string",
            "pass" => "string",
            "client_id" => 0,
            "custom_client_id" => "string",
            "vat_id" => 0,
            "email" => "string",
            "client_name" => "string",
            "doctype" => "string",
            "tax_exempt" => true,
            "incvat" => true,
            "bank_number" => 0,
            "bank_branch" => 0,
            "bank_account" => 0,
            "deposit_to_bank" => 0,
            "cc_token_id" => 0,
            "cc_number" => $card_number,
            "cc_cvv" => $cc_cvv,
            "cc_validity" => $cc_validity,
            "cc_type" => "string",
            "cc_holder_id" => 0,
            "cc_holder_name" => "string",
            "start_date" => "2019-08-24",
            "num_of_payments" => 0,
            "issue_every" => 0,
            "currency" => "ILS",
            "income_type_id" => 0,
            "employee_assigned" => 0,
            "items" => [
                [
                    "item_id" => 0,
                    "inventory_item_id" => "string",
                    "sku" => "string",
                    "description" => "string",
                    "long_description" => "string",
                    // "currency_id" => 0,
                    // "currency_rate" => -3.402823669209385e+38,
                    "unitprice" => -3.402823669209385e+38,
                    // "unitprice_incvat" => -3.402823669209385e+38,
                    // "unitprice_exempt" => -3.402823669209385e+38,
                    "tax_exempt" => true,
                    "quantity" => 1,
                    // "serial" => "string",
                    // "taxes" => (object)[],
                ]
            ],
            "price_indexing" => [
                "type" => "string",
                "adjustment" => "string",
                "price_index" => 0,
                "price_index_base" => 0,
                "price_index_value" => -3.402823669209385e+38,
                "currency_code" => "string",
                "currency_rate" => -3.402823669209385e+38,
            ],
            "email_to_client" => true,
            "email_cc" => "string",
            "email_client_on_issue" => true,
            "lang" => "string",
            "hk_cc_auto_retry" => true,
        ];


        $response = $icountService->createRecurringProfile($data);

        return back();
    }

    public function plans()
    {
        $plans = Plan::with('features')->get();

        return inertia('Plans',[
            'plans' => $plans
        ]);
    }

    public function addons()
    {
        $addons = Addon::get();

        if(session('plan') == null){
            return redirect('/plans');
        }

        $plan = Plan::with('features')->find(session('plan'));

        return inertia('Addons',[
            'addons' => $addons,
            'plan' => $plan
        ]);
    }

    public function selectPlan($plan_id)
    {
        session(['plan' => $plan_id]);
        return redirect()->route('addons');
    }

}
