<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'id';
    protected $fillable = [
        'slug', 'title', 'description', 'content', 'page_category_id', 'author_id', 'preview_image', 'page_status_id',
    ];
    public $timestamps = false;

    protected $category;
    protected $author;
    protected $status;

    public function getCategory() : ?PageCategory {
        if($this->category) return $this->category;
        if(is_null($this->page_category_id)) return null;

        $this->category = PageCategory::where('id', '=', (int)$this->page_category_id)->first();

        return $this->category;
    }

    public function hasCategory() : bool {
        return is_null($this->page_category_id) ? false : null;
    }

    public function getAuthor() : ?User {
        if($this->author) return $this->author;
        if(is_null($this->author_id)) return null;

        $this->author = User::where('id', '=', (int)$this->author_id)->first();

        return $this->author;
    }

    public function hasAuthor() : bool {
        return is_null($this->author_id) ? false : true;
    }

    public function getStatus() : ?PageStatus {
        if($this->status) return $this->status;
        if(!$this->page_status_id) return null;

        $this->status = PageStatus::where('id', '=', (int)$this->page_status_id)->first();

        return $this->status;
    }

    public function hasStatus() : bool {
        return is_null($this->page_status_id) ? false : true;
    }

    public function refresh()
    {
        $this->author = $this->status = $this->category = null;
        parent::refresh();
    }
}
