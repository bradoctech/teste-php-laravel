<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControleDocuments extends Model
{
    protected $table = 'documents';

    protected $fillable = ['id_categories', 
                           'title',
                           'contents',
                           'activate'
                          ];

    public function rules()
    {
        return [
            'title' => 'required:documents',
            'contents' => 'required:documents',
            'activate' => 'required:documents'
        ];
    }
    
    public function relCategories() {
        return $this->hasOne('App\Models\ControleCategories', 'id', 'id_categories' );
    }
}
