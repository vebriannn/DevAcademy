<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MemberReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index()
    {
        $reviews = Review::with('user')->get(); 
        return view('index', ['reviews' => $reviews]);
    }
    

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:tbl_courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'note' => 'nullable|string',
        ]);

        $review = Review::create($validated);
        return response()->json([
            'message' =>'komentar ditambahkan',
            'data' =>$review,
        ]);
    }

    /**
     * Display the specified review.
     */
    public function show($id): JsonResponse
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        return response()->json($review);
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:tbl_courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'note' => 'nullable|string',
        ]);

        $review->update($validated);
        return response()->json($review);
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id): JsonResponse
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();
        return response()->json(['message' => 'Review deleted successfully']);
    }
}
