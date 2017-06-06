<?php

namespace App\Services;

use App\Models\CompetitionPost;
//use App\Models\CompetitionJoin;

class CompetitionPostService {

    public function createPost($joinedTalent,$user, $competition_id, $post_title, $post_description, $post_media_type, $post_media_url) {
        CompetitionPost::create([
            'competition_post_title' => $post_title,
            'competition_post_description' => $post_description,
            'competition_post_media_type' => $post_media_type,
            'competition_post_media_url' => $post_media_url,
            'talent_id' => $user->id,
            'competition_id' => $competition_id
        ]);
        $joinedTalent->update(['joined'=>1]);
       
        return response()->json(['status' => 'ok', 'message' => 'Post Created Successfully under competition ' . $competition_id], 201);
    }

    public function updatePost($postDetails, $competition_id, $post_title, $post_description, $post_media_type, $post_media_url) {
        $postDetails->update([
            'competition_post_title' => $post_title,
            'competition_post_description' => $post_description,
            'competition_post_media_type' => $post_media_type,
            'competition_post_media_url' => $post_media_url
        ]);
        return response()->json(['status' => 'ok', 'message' => 'Post Updated Successfully under Competition ' . $competition_id], 201);
    }

    public function deletePost($postDetails, $competition_id) {
        $postDetails->delete();
        return response()->json(['status' => 'ok', 'message' => 'Post Deleted Successfully under Competition ' . $competition_id], 201);
    }
    

}
