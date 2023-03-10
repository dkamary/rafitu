<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    const STATIC = 1;
    const BLOG = 2;

    protected $table = 'page_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'parent_id', 'name', 'slug', 'description', 'is_active',
    ];
    public $timestamps = false;

    protected $_parent = null;

    public function hasParent() : bool {
        return is_null($this->parent_id) ? false : true;
    }

    public function getParent() : ?PageCategory {
        if($this->_parent) return $this->_parent;
        if($this->parent_id) return null;

        $this->_parent = PageCategory::where('id', '=', (int)$this->parent_id)->first();

        return $this->_parent;
    }

    public function getChildren() : ?Collection {
        return PageCategory::where('parent_id', '=', (int)$this->id)->get();
    }

    public function childrenCount() : int {
        return PageCategory::where('parent_id', '=', (int)$this->id)->count();
    }

    public function hasChildren() : bool {
        return $this->childrenCount() > 0;
    }

    public function refresh()
    {
        $this->_parent = null;
        parent::refresh();
    }
}
