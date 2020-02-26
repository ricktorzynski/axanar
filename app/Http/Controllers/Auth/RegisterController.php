<?php

namespace Ares\Http\Controllers\Auth;

use Ares\Mail\ActivateMail;
use Ares\Models\Addresses;
use Ares\User;
use Ares\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers, SendsPasswordResetEmails;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showNewDonorForm()
    {
        return view('auth.register-new-donor');
    }

    public function showActivateForm()
    {
        return view('auth.passwords.activate');
    }

    public function matchEmail(Request $request)
    {
        $create = ($request->post('create') === 'create');

        if ($create) {
            $email = $request->post('email');
            $user = $this->create(['email' => $email, 'full_name' => $email, 'password' => date('YmdHis') . $email]);
            if ($user) {
                return $this->sendActivationLink($request, $user);
            }

            return back()->with('status', 'There was a problem creating your account.');
        }

        return view('auth.email-match', $request->only('email'));
    }

    public function activateLinkClicked(Request $request, string $token = null, string $tokenType = null)
    {
        if (empty($token)) {
            return redirect('/');
        }

        $view = $tokenType === 'register'
            ? 'auth.passwords.select'
            : 'auth.passwords.create';

        $token = urldecode($token);

        /** @var User $user */
        $user = User::where('resetPass', $token)->first();
        if (empty($user)) {
            return redirect('/');
        }

        $data = [
            'user' => $user->toArray(),
            'token' => $token,
            'tokenType' => $tokenType,
            'email' => $user['email'],
        ];
        return view($view, $data);
    }

    public function completePassword(Request $request)
    {
        $userId = $request->post('user_id');

        /** @var User $user */
        $user = User::find($userId);
        if (empty($user)) {
            return redirect('/');
        }

        $userInfo = getUserAccountInfo($userId);
        if (empty($userInfo)) {
            $userInfo = [];
        }

        $addressId = $userInfo['address_id'] ?? null;
        $firstName = $userInfo['firstName'] ?? null;
        $lastName = $userInfo['lastName'] ?? null;
        $altName = $userInfo['altName'] ?? trim($firstName . ' ' . $lastName);

        if ($request->method() !== 'POST') {
            return back();
        }

        $status = 'IN ORDER TO COMPLETE YOUR REGISTRATION';
        $error =
            'Please provide ALL of the required information below (marked in red) and then click "COMPLETE REGISTRATION" at the bottom of the page.';

        $postVars = $request->post();

        $data = [
            'user_id' => $userId,
            'firstName' => $request->post('contact-firstname'),
            'lastName' => $request->post('contact-lastname'),
            'address_1' => $request->post('contact-address1'),
            'address_2' => $request->post('contact-address2'),
            'city' => $request->post('contact-city'),
            'state' => $request->post('contact-state'),
            'zip' => $request->post('contact-zip'),
            'country' => $request->post('contact-country'),
            'gender' => $request->post('contact-gender'),
            'shirtSize' => $request->post('contact-shirtsize'),
            'altName' => $request->post('contact-altname'),
        ];

        $firstName = $data['firstName'] ?? null;
        $lastName = $data['lastName'] ?? null;
        $data['altName'] = $altName ?: $data['altName'] ?? trim($firstName . ' ' . $lastName);
        $formError = false;

        foreach ($data as $key => $value) {
            if (in_array($key, ['gender', 'shirtSize', 'altName', 'address_2'])) {
                continue;
            }
            if (empty($value)) {
                $formError = true;
                break;
            }
        }

        if ($formError) {
            return back()
                ->withInput()
                ->with('status', $status)
                ->withErrors(['error' => $error]);
        }

        if (empty($addressId)) {
            $addressId = Addresses::insertGetId($data);
            if (!empty($addressId)) {
                $data['address_id'] = $addressId;
            }
        } else {
            $data['address_id'] = $addressId;
            Addresses::where('address_id', $addressId)->update($data);
        }

        User::where('user_id', $userId)->update([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'full_name' => trim($data['firstName'] . ' ' . $data['lastName']),
            'donor_name' => $data['altName']
        ]);

        return redirect('/');
    }

    public function updatePassword(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $token = $request->post('token');
        $passwordConfirm = $request->post('password_confirmation');
        $tokenType = $request->post('token_type');
        $ageAgree = !empty($request->post('age_agree', false));

        if (empty($token) || empty($email)) {
            return redirect('/');
        }

        /** @var User $user */
        $user = User::where(['resetPass' => $token, 'email' => $email])->first();
        if (empty($user)) {
            return redirect('/');
        }

        if ($user->need_update != 2) {
            if ($password !== $passwordConfirm) {
                return back()
                    ->withInput($request->except(['password', 'password-confirmation']))
                    ->with('status', 'PASSWORDS DO NOT MATCH')
                    ->withErrors([
                        'password' =>
                            trans('Please be careful to type the exact same password into both boxes below.')
                    ]);
            }

            if (!$ageAgree) {
                return back()
                    ->withInput($request->except(['password', 'password-confirmation']))
                    ->with('status', 'AGE NOT VERIFIED')
                    ->withErrors([
                        'age_agree' =>
                            trans('Only people who are 18 years of age or older may set up accounts on Ares Digital 3.0.  If you are not yet 18, please ask your parent or guardian to set up an account.  Otherwise, please check the box below to confirm that you are 18 or older.')
                    ]);
            }

            $user->need_update = 2;
            $user->password = bcrypt($password);
            $user->save();

            Auth::login($user);
        }

        return view('auth.complete-registration', ['user' => $user, 'email' => $email]);
    }

    public function checkActivateEmail(Request $request)
    {
        $result = User::where('email', $request->post('email'))->get()->toArray();
        $user = !empty($result) ? reset($result) : false;

        //  User not found
        if (!$user) {
            return back()
                ->with('status', 'no-user')
                ->withInput($request->only('email'));
        }

        $pass = $user['password'] ?? null;
        $passCheck = trim(strtolower($pass));
        $activated = !empty($passCheck) && $passCheck[0] === '$';

        //  User and not activated
        if (!$activated) {
            return $this->matchEmail($request);
        }

        //  User and activated
        return view('auth.email-account', $request->only('email'));
    }

    public function checkEmail(Request $request)
    {
        $email = $request->post('email');
        $result = User::where('email', $email)->get()->toArray();
        $user = !empty($result) ? reset($result) : false;

        //  No match on email
        if (!$user) {
            $user = $this->create(['email' => $email, 'full_name' => $email, 'password' => date('YmdHis') . $email]);
            if ($user) {
                return $this->sendActivationLink($request, $user, true)->with('status', 'no-match');
            }

            return back()->with('status', 'There was a problem creating your account.');
        }

        $pass = $user['password'] ?? null;
        $passCheck = trim(strtolower($pass));
        $activated = !empty($passCheck) && $passCheck[0] === '$';

        //  User and not activated
        if (!$activated) {
            return $this->matchEmail($request);
        }

        //  User and activated
        return view('auth.email-account', $request->only('email'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $response
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showThanksLinkSent(Request $request)
    {
        return view('auth.thank-you-link-sent', $request->only('email'));
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        Log::info('Reset link sent', ['response' => $response]);
        return view('auth.thank-you-link-sent', $request->only('email'))->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        Log::info('Reset link failed', ['response' => $response]);
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \Ares\User
     */
    protected function create(array $data)
    {
        /** @var User $user */
        $user = User::where('email', $data['email'])->first();
        if (!empty($user)) {
            $user->update([
                'full_name' => $data['full_name'] ?? $data['email'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            return $user;
        }

        return User::create([
            'full_name' => $data['full_name'] ?? $data['email'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param User                     $user
     * @param bool                     $register
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function sendActivationLink(Request $request, User $user, $register = false)
    {
        $hash = md5(Hash::make(Str::random(32)));

        $user->resetPass = $hash;
        $user->save();

        Mail::to($user->email)->send(new ActivateMail($user, $register));
        return view('auth.activate-thanks', $request->only('email'));
    }
}
