<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Http\Resources\PostalCodeResource;
use App\Models\PostalCode;
use Illuminate\Http\Request;


class PostalCodeController extends Controller
{
    /**
     * List postal codes
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function list(Request $request) {
        $postalCodes = PostalCode::with('state')->orderBy('code')->paginate(15);
        return PostalCodeResource::collection($postalCodes);
    }
}
