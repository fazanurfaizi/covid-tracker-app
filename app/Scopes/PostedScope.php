<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PostedScope implements Scope {

    public function apply(Builder $builder, Model $model) {
        $user = auth()->user() ?? auth('api')->user();

        if(!$user || !$user->isAdmin()) {
            $builder->where('created_at', '<=', now());
        }
    }

}

?>
