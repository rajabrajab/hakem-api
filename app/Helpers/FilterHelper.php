<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class FilterHelper
{
    public static function applyFilters(Builder $query, array $filters, array $relations = []): Builder
    {
        foreach ($filters as $field => $value) {
            if (!empty($value)) {

                if (array_key_exists($field, $relations)) {
                    $relation = $relations[$field];
                    $query->whereHas($relation, function ($q) use ($field, $value) {
                        $q->where($field, 'LIKE', '%' . $value . '%');
                    });
                } else {

                    $query->where($field, 'LIKE', '%' . $value . '%');
                }
            }
        }

        return $query;
    }
}


// usage
// $filters = [
//             'invitation_name' => $request->invitation_name,
//             'city' => $request->city,
//             'status' => $request->status,
//             'username' =>$request->username
//         ];

//         $relations = [
//             'username' => 'user',
//         ];

//         $query = Invitation::with('user');
//         $invitations = FilterHelper::applyFilters($query, $filters,$relations)->paginate(10);
