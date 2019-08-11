<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Http\Requests\UpdateUser;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($id) {
        $user = User::find($id);

        if (!$user) {
            return back()->with('status', __('user.not_exist'));
        }

        return view('customer.user.show', ['user' => $user]);
    }

    public function edit($id) {
        $user = User::find($id);

        if (!$user) {
            return back()->with('status', __('user.not_exist'));
        }

        if (auth()->id() != $user->id) {
            return back()->with('status', __('user.not_permission'));

        }

        return view('customer.user.edit', ['user' => $user]);
    }

    private function upload($file) {
        $destinationFolder = public_path() . '/' . config('user.image_path');

        try {
            $fileName = $file->getClientOriginalName() . '_' . date('Ymd_His');
            $imageFileType = $file->getClientOriginalExtension();
            $extList = ['jpg', 'png', 'jpeg', 'gif'];

            if (!in_array(strtolower($imageFileType), $extList)) {
                $result = [
                    'status' => false,
                    'msg' => __('user.msg'),
                ];
            }else {
                $file->move($destinationFolder, $fileName);
                $result = [
                    'status' => true,
                    'file_name' => $fileName,
                ];
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $result = [
                'status' => false,
                'msg' => $msg,
            ];
        }

        return $result;
    }

    public function update(UpdateUser $request, $id) {
        $data = $request->only([
            'name',
            'email',
            'phone_number',
            'image',
            'address',
            'role',
        ]);

        try {
            $user = User::find($id);

            if (!$user) {
                return back()->with('status', __('user.not_exist'));
            }

            if (auth()->id() != $user->id) {
                return back()->with('status', __('user.not_permission'));

            } else {
                $result = $this->upload($request->image);

                if ($result['status'] == true) {
                    $data['image'] = $result['file_name'];
                }

                if ($result['status'] == null) {
                    unset($data['image']);
                }

                if ($result['status'] == false) {
                    return redirect()->route('customer.user.show')->with('status', $result['msg']);
                }

                $user->update($data);

            }
        } catch (Exception $e) {
            return back()->with('status', __('user.update_fail'));
        }

        return redirect(route('customer.user.show', $user->id))->with('status', __('user.update_success'));
    }
}
