<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;
    private static $logos, $logo, $image, $imageExtension, $imageName, $directory, $imageUrl, $message;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageExtension = self::$image->getClientOriginalExtension();
        self::$imageName = time().'.'.self::$imageExtension;
        self::$directory = 'backend/images/logo-images/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }
    public static function newLogo($request)
    {
        self::$logos = new Logo();
        self::$logos->title = $request->title;
        self::$logos->image = self::getImageUrl($request);
        self::$logos->save();
    }
    public static function updateLogoStatus($id)
    {
        self::$logo = Logo::find($id);
        if (self::$logo->status == 1)
        {
            self::$logo->status = 0;
            self::$message = "Logo Unpublished";
        }
        else
        {
            self::$logo->status = 1;
            self::$message = "Logo Published";
        }
        self::$logo->save();
        return self::$message;
    }
    public static function updateLogo($request, $id)
    {
        self::$logo = Logo::find($id);

        if($request->file('image'))
        {
            if (file_exists(self::$logo->image))
            {
                unlink(self::$logo->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$logo->image;
        }
        self::$logo->title = $request->title;
        self::$logo->image = self::$imageUrl;
        self::$logo->save();
    }
    public static function deleteLogo($id)
    {
        self::$logo = logo::find($id);

        if(file_exists(self::$logo->image))
        {
            unlink(self::$logo->image);
        }
        self::$logo->delete();
    }

}
