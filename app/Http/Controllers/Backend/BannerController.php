<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    use FileUploadTrait;
    private $default_pagination;
    private $upload_path;
    private $width;
    private $height;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $banners = Banner::orderBy("banner_order", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.banner.index", compact("banners"));
    }

    public function create()
    {
        return view("backend.banner.create");
    }

    public function store(Request $request)
    {
        $input = $request->all();

        if (empty($input["banner_order"])) {
            $page_order = Banner::max("banner_order");
            $new_order = $page_order + 1;
            $input["banner_order"] = $new_order;
        }

        $banner = Banner::create($input);

        if ($request->hasFile('banner_image')) {
            $this->fileUpload($banner, 'banner_image', 'banner-image', false);
        }

        return redirect()->route('banners.index')->with('message', 'Banner Created Successfully');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view("backend.banner.edit", compact("banner"));
    }

    public function update($id, Request $request)
    {
        $banner = Banner::findOrFail($id);
        $input = $request->all();

        if (empty($input["banner_order"])) {
            $page_order = Banner::max("banner_order");
            $new_order = $page_order + 1;
            $input["banner_order"] = $new_order;
        }

        $banner->update($input);
  
        if ($request->hasFile('banner_image')) {
            $this->fileUpload($banner, 'banner_image', 'banner-image', false);
        }

        return redirect()->route('banners.index')->with('info', 'Banner Updated Successfully');

    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        // File::delete($this->upload_path . $banner->banner_image);

        return redirect()
            ->route("banners.index")
            ->with("error", "Banner deleted successfully");
    }
}
