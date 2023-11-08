<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControleCategories extends Model
{
    protected $table = 'categories';

    protected $fillable = ['id', 
                           'name',
                           'activate'
                          ];
    
    public function rules()
    {
        return [
            'name' => 'required:categories',
            'activate' => 'required:categories'
        ];
    }

    public function relDocuments() {
        return $this->hasMany('App\Models\ControleDocuments', 'id_categories' );
    }
}
