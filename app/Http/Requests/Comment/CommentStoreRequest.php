<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'video_id' => 'nullable|integer|exists:videos,id|required_if:comment_type,video',
            'post_id' => 'nullable|integer|exists:posts,id|required_if:comment_type,post',
            'photo_id' => 'nullable|integer|exists:photos,id|required_if:comment_type,photo',
            'comment_type' => 'required|in:video,photo,post',
            'body' => 'required|string',
        ];
    }
}
