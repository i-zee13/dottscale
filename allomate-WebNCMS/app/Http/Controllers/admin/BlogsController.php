<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class BlogsController extends Controller
{

    public function index()
    {
        return view('admin.blogs');
    }
    public function add_blog()
    {
        $blog_categories = BlogCategory::where('publish', '1')->get();
        return view('admin.add-blog', compact('blog_categories'));
    }
    public function blog_slug($blog_title)
    {
        $blog_slug = Str::slug($blog_title);
        return response()->JSON([
            'blog_slug' => $blog_slug
        ]);
    }
    public function store(Request $request)
    {
        $after_header_image = null;
        $validate = $this->validate($request, [
            'title' => 'required',
            'blog_date' => 'required',
        ]);

        if (Blogs::WHERE('title', $request->title)->WHERE('id', '!=', $request->blog_id)->first()) {
            return response()->JSON([
                'status' => 'duplicate',
                'msg' => 'Blog Title Already Exisst',
            ]);
        }
        if (Blogs::WHERE('slug', $request->slug)->WHERE('id', '!=', $request->blog_id)->first()) {
            return response()->JSON([
                'status' => 'duplicate',
                'msg' => 'Blog Slug Already Exist',
            ]);
        }
        if ($request->blog_id != '') {
            $save_blog = Blogs::find($request->blog_id);
        } else {
            $save_blog = new Blogs();

        }
        if ($request->hasFile('after_header_image')) {
            $completeFileName = $request->file('after_header_image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('after_header_image')->getClientOriginalExtension();
            $report = str_replace(' ', '_', $fileNameOnly) . '_' . time() . '.' . $extension;
            $path = $request->file('after_header_image')->storeAs('public/blogs/', $report);
            $after_header_image = '/storage/blogs/' . $report;
        } else {
            $after_header_image = $request->hidden_after_header_image;
        }
        $slugBlog = '';
        $page_slug = '';
        if ($request->slug != null) {
            $slugBlog = $request->slug;
            $slugBlog = str_replace([' ', '/'], '-', $slugBlog);
            $slugBlog = preg_replace('/-+/', '-', $slugBlog);
        } else {
            $slugBlog = $request->title;
            $slugBlog = str_replace([' ', '/'], '-', $slugBlog);
            $slugBlog = preg_replace('/-+/', '-', $slugBlog);
        }
        $save_blog->title = $request->title;
        $save_blog->slug = $slugBlog;
        $save_blog->tags = $request->tags;
        $save_blog->blog_date = $request->blog_date;
        $save_blog->short_description = $request->short_description;


        if ($request->hasfile('meta_og_image')) {
            $meta_og_image =  $request->meta_og_image->store('og-images', 'public');
        } else {
            $meta_og_image = $request->hidden_og_image;
        }

        $save_blog->blog_details = $request->blog_details;
        $save_blog->user_id = Auth::user()->id;
        $save_blog->blog_type = 2; //category related blogs
        if (intval($request->blog_category_id)) {
            $save_blog->blog_category_id = $request->blog_category_id;
        } else {
            $save_blog->blog_category_id = null;
        }
        $seo = storeSeo($request);
        $save_blog->page_meta_tags = $seo;
        $save_blog->meta_og_image = $meta_og_image;
        if ($request->blog_id != '') {
            $save_blog->updated_by = Auth::user()->id;
        } else {
            $save_blog->created_by = Auth::user()->id;
        }
        $save_blog->after_header_image = $after_header_image;
        $save_blog->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'blog_added'
        ]);
    }
    public function all_blogs_list(Request $request)
    {
        $all_blogs = Blogs::orderBy('id', 'DESC')
            ->selectRaw('blogs.id,blogs.title,
                                        blogs.short_description ,
                                        DATE_FORMAT(blogs.blog_date,"%d-%b-%Y") as date,
                                        blogs.slug ,
                                        blogs.blog_details,
                                        blogs.blog_category_id,
                                        blogs.published
                                    ')->get();
        return response()->JSON([
            'status' => 'success',
            'all_blogs' => $all_blogs,
        ]);
    }
    public function blog_status_change(Request $request)
    {

        $status_blog = Blogs::where('id', $request->id)->update([
            'published' => $request->blog_status,
        ]);
        return response()->JSON([
            'status' => 'success',
            'msg' => 'status_change'
        ]);
    }
    public function delete_blog(Request $request)
    {
        $delete_blog = Blogs::where('id', $request->id)->delete();
        return response()->JSON([
            'status' => 'success',
            'msg' => 'blog_deleted'
        ]);
    }

    public function edit($id)
    {

        $blog_categories = BlogCategory::where('publish', '1')->get();
        $blog_details = Blogs::where('id', $id)->first();
        return view('admin.add-blog', compact([
            'blog_details',
            'blog_categories',
        ]));
    }
}
