<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function assignee() {
        return $this->belongsTo(User::class,'assignee_id');
    }
    
    public function assign($user_id) {
        $this->attributes['assignee_id'] = $user_id;
        return $this->save();
    }

    public function decline() {
        $this->attributes['assignee_id'] = null;
        return $this->save();
    }

    public function is_assigned() {
        return $this->attributes['assignee_id'] != null;
    }

    public function resolve() {
        $this->attributes['is_done'] = true;
        return $this->save();
    }
}
