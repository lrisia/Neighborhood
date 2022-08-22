<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; // trait

    /*
     * + ฟังก์ชัน tags() คืนค่า ความสัมพันธ์ belongsToMany
     * + attribute tags คืนค่า collection ของ Tag ที่ผูกกับ Post นี้
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Post hasMany comments (มี s ด้วย)
     * + ฟังก์ชัน comments() คืนค่า ความสัมพันธ์ hasMany
     * + attribute comments คืนค่า Collection ของ Comment ที่ผูกกับ Post นี้
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function statusChecker(string $str) {
        if ($this->status === $str) return true;
        return false;
    }

    public function statusTranslator() {
        if ($this->status === "Waiting") return "กำลังส่งเรื่อง";
        else if ($this->status === "Received") return "รับเรื่องแล้ว";
        else if ($this->status === "Progress") return "กำลังดำเนินการ";
        else if ($this->status === "Completed") return "เสร็จสิ้น";
        else return "ส่งเรื่องกลับ";
    }

    public function tagsConcat() {
        $tags_name = "";
        foreach ($this->tags as $tag) {
//            dd($tag->id);
            $tag_name = Tag::find($tag->id)->name;
            if ($tags_name === "") $tags_name = $tag_name;
            else $tags_name = $tags_name.",".$tag_name;
        }
        return $tags_name;
    }

    public function scopeAdvertise($query)
    {
        return $query->where('like_count', '<', 1000)
                     ->where('view_count', '>', 70000);
    }

    public function scopePopular($query, $like_count, $view_count)
    {
        return $query->where('like_count', '>=', $like_count)
                     ->where('view_count', '>=', $view_count);
    }

    public function scopeFilterTitle($query, $search)
    {
        return $query->where('title', 'LIKE', "%{$search}%"); // % wildcard
    }

    private function numberToK($value) {
        return ($value >= 1000000)
            ? round($value / 1000000, 1) . 'm'
            : (
                ($value >= 1000)
                ? round($value / 1000, 1) . 'k'
                : $value
            );
    }

//    public function viewCount() : Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => $this->numberToK($value)
//        );
//    }
//
//    public function likeCount() : Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => $this->numberToK($value)
//        );
//    }
}
