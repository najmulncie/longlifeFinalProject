<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    private static $banners, $banner, $image, $imageExtension, $imageName, $directory, $imageUrl, $message;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageExtension = self::$image->getClientOriginalExtension();
        self::$imageName = time().'.'.self::$imageExtension;
        self::$directory = 'backend/images/banner-images/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }
    public static function newbanner($request)
    {
        self::$banners = new banner();
        self::$banners->title = $request->title;
        self::$banners->image = self::getImageUrl($request);
        self::$banners->save();
    }
    public static function updatebannerStatus($id)
    {
        self::$banner = banner::find($id);
        if (self::$banner->status == 1)
        {
            self::$banner->status = 0;
            self::$message = "banner Unpublished";
        }
        else
        {
            self::$banner->status = 1;
            self::$message = "banner Published";
        }
        self::$banner->save();
        return self::$message;
    }
    public static function updatebanner($request, $id)
    {
        self::$banner = banner::find($id);

        if($request->file('image'))
        {
            if (file_exists(self::$banner->image))
            {
                unlink(self::$banner->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$banner->image;
        }
        self::$banner->title = $request->title;
        self::$banner->image = self::$imageUrl;
        self::$banner->save();
    }
    public static function deletebanner($id)
    {
        self::$banner = banner::find($id);

        if(file_exists(self::$banner->image))
        {
            unlink(self::$banner->image);
        }
        self::$banner->delete();
    }
}
