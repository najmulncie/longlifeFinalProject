<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'operator',
        'category',
        'title',
        'price',
        'cashback',
        'description',
        'image'
    ];

    private static $logos, $logo, $image, $imageExtension, $imageName, $directory, $imageUrl, $message;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageExtension = self::$image->getClientOriginalExtension();
        self::$imageName = time().'.'.self::$imageExtension;
        self::$directory = 'backend/images/operator-images/';
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


}
