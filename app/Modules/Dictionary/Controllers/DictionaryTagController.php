<?php

namespace App\Modules\Dictionary\Controllers;

use App\Models\DictionaryCategory;
use App\Models\Tag;
use App\Modules\Core\Controllers\Controller;
use App\Modules\Dictionary\Requests\TagSaveRequest;
use App\Modules\Dictionary\Resources\DictionaryResource;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DictionaryTagController extends Controller
{
    /**
     * Display list of resources
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'code,asc'));
        $pageSize = (int)$request->input('pageSize', 10);

        $resource = Tag::query()->when($request->filled('search'), function (Builder $q) use ($request) {
            $q->where(Tag::COLUMN_NAME, 'like', '%' . $request->search . '%');
        })->orderBy($column, $order)->paginate($pageSize);

        return DictionaryResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagSaveRequest $request
     * @param Tag $tag
     * @return JsonResponse
     */
    public function store(TagSaveRequest $request, Tag $tag): JsonResponse
    {
        $data = $request->validated();
        $tag->fill($data)->save();

        return response()->json([
            'data' => new DictionaryResource($tag),
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $dictionary
     * @return DictionaryResource
     */
    public function show(Tag $dictionary): DictionaryResource
    {
        return new DictionaryResource($dictionary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagSaveRequest $request
     * @param Tag $dictionary
     * @return JsonResponse
     */
    public function update(TagSaveRequest $request, Tag $dictionary): JsonResponse
    {
        $data = $request->validated();
        $dictionary->fill($data)->save();

        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated',
        ]);
    }

    /**
     * Delete the specified resource.
     *
     * @param DictionaryCategory $dictionary
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(DictionaryCategory $dictionary): JsonResponse
    {
        $dictionary->delete();

        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted',
        ]);
    }
}
