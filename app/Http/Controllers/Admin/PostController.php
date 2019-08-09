<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePost;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::paginate(config('post.paginate'));
        
        return view('admin.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePost $request) {
        $data = $request->only([
            'title',
            'content',
            'image',
            'body',
        ]);

        $uploaded = $this->upload($data['image']);
        
        if (!$uploaded['status']) {
            return back()->with('status', $uploaded['msg']);
        }

        $data['image'] = $uploaded['file_name'];

        try {
            $post = Post::create($data);
        } catch (Exception $e) {
            return back()->with('status', __('message.create_fail'));
        }
        
        return redirect()->route('admin.post.index')->with('status', __('post.status'));
    }

    private function upload($file) {
        $destinationFolder = public_path() . '/' . config('post.image_path');
        
        try {
            $fileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $imageFileType = $file->getClientOriginalExtension();
            
            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif' ) {
                $result = [
                    'status' => false,
                    'msg' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.',
                ];
            }
            // $mimeType = $file->getMimeType();
            // $realPath = $file->getRealPath();
            $file->move($destinationFolder, $fileName);
                
            $result = [
                'status' => true,
                'file_name' => $fileName,
            ];
        } catch (Exception $e) {
            $msg = $e->getMessage();
                
            $result = [
                'status' => false,
                'msg' => $msg,
            ];
        }
        
        return $result;
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $post = Post::find($id);
            $post->delete();
            $result = [
                'status' => true,
                'msg' => 'Delete success',
            ];
        } catch (Exception $e) {
            $result = [
                'status' => false,
                'msg' => 'Delete fail',
            ];
        }

        return response()->json($result);
    }
}
