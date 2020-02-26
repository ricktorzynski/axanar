<?php

namespace Ares\Http\Controllers;

use Ares\Models\Addresses;
use Ares\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends AuthenticatedController
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shipping(Request $request)
    {
        $msg = null;
        $icon = "fa fa-info-circle";

        $userId = Auth::id();
        $userInfo = getUserAccountInfo($userId);
        if (empty($userInfo)) {
            $userInfo = [];
        }

        $donorListedAs = null;
        $addressId = $userInfo['address_id'] ?? null;
        $firstName = $userInfo['firstName'] ?? null;
        $lastName = $userInfo['lastName'] ?? null;
        $altName = $userInfo['altName'] ?? null;

        if (empty($firstName) && empty($lastName) && empty($altName)) {
            $donorListedAs = 'No Name Recorded';
        } else {
            if (!empty($firstName) || !empty($lastName)) {
                $donorListedAs = trim($firstName) . ' ' . trim($lastName);
            }
            if (!empty($altName)) {
                $donorListedAs = $altName;
            }
        }

        if ($request->method() === 'POST') {
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
            $data['altName'] = $data['altName'] ?? trim($firstName . ' ' . $lastName);

            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }

            if (empty($addressId)) {
                Addresses::insert($data);
            } else {
                $data['address_id'] = $addressId;
                Addresses::where('address_id', $addressId)->update($data);
            }

            User::find($userId)->update($data);

            $msg = 'Your information has been successfully updated';
            $icon = "fa fa-info-circle";
            updateUserAlert($userId, 1);

            //  Refresh our model
            $userInfo = getUserAccountInfo($userId = Auth::id());
        }

        return view('account.shipping', [
            'userInfo' => $userInfo,
            'address' => $this->buildAddress($userInfo),
            'altName' => $altName,
            'msg' => $msg,
            'icon' => $icon,
            'donorListedAs' => $donorListedAs,
        ]);
    }

    /**
     * @param array $user
     *
     * @return string|null
     */
    protected function buildAddress(array $user)
    {
        $address = !empty($user['address_1']) ? $user['address_1'] . '<br />' : null;
        $address .= !empty($user['address_2']) ? $user['address_2'] . '<br />' : null;
        $address .= !empty($user['city']) ? $user['city'] : null;
        $address .= !empty($user['state']) ? ', ' . $user['state'] : null;
        $address .= (!empty($user['zip']) ? ' ' . $user['zip'] . '<br />' : null);
        $address .= !empty($user['country']) ? ' ' . $user['country'] : null;

        return empty($address) ? null : $address;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function emailChange(Request $request)
    {
        if ($request->method() !== 'POST') {
            return view('auth.email-change');
        }

        $email1 = trim(strtolower($request->post('email')));
        $email2 = trim(strtolower($request->post('email_verify')));

        if (empty($email1) || empty($email2)) {
            return back()
                ->withErrors([
                    'email' =>
                        trans('Both fields must contain your email address')
                ]);
        }

        if ($email1 !== $email2) {
            return back()
                ->withErrors([
                    'email' =>
                        trans('Please enter your new email address twice.')
                ]);
        }

        $userID = Auth::id();
        $user = getUserRecord($userID);
        if (empty($user)) {
            return back()
                ->withErrors([
                    'email' =>
                        trans('Your original email address cannot be found.')
                ]);
        }

        $copy = User::where('email', $email1)->get()->toArray();
        if (!empty($copy)) {
            return back()
                ->withErrors([
                    'email' =>
                        trans('The email address "' . $email1 . '" is not available."')
                ]);
        }

        $emailNow = trim(strtolower($user['email']));
        if ($emailNow === $email1) {
            return back()
                ->withErrors([
                    'email' =>
                        trans('Your new email address must be different from your current email address.')
                ]);
        }

        if (!User::find($userID)->update(['email' => $email1])) {
            return back()
                ->withErrors([
                    'email' =>
                        trans('Your email address could not be changed.')
                ]);
        }

        //  It's all good!
        return redirect('/')
            ->with('status', 'Email address successfully changed.');
    }
}
