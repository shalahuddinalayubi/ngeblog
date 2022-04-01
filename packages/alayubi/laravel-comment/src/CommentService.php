<?php

namespace Lara\Comment;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lara\Comment\Contracts\IsCommentable;
use Lara\Comment\Exceptions\MustCommentableException;

class CommentService
{
    use AuthorizesRequests;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $commentable;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $commentator;

    /**
     * @var \Lara\Comment\Redirect\Redirect
     */
    protected $redirector;

    /**
     * @var bool
     */
    protected $validateWithBag = false;

    public function __construct($commentable, $request)
    {
        $this->setCommentable($commentable);
        $this->request = $request;
    }

    /**
     * Set commentable.
     * 
     * @param \Lara\Comment\Contracts\IsCommentable
     * @return this
     */
    public function setCommentable($commentable)
    {
        if (!$commentable instanceof IsCommentable) {
            throw new MustCommentableException();
        }

        $this->commentable = $commentable;

        return $this;
    }

    /**
     * Create new instace.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @param \Illuminate\Http\Request
     * @return this
     */
    public static function for($commentable, $request)
    {
        return (new self($commentable, $request));
    }

    /**
     * Set commentator.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return this
     */
    public function setCommentator($commentator)
    {
        $this->commentator = $commentator;

        return $this;
    }

    /**
     * Get the comment data.
     * 
     * @return array
     */
    public function getData()
    {
        return [
            'user_id' => $this->commentator->id,
            'comment' => $this->request->get('comment'),
        ];
    }

    /**
     * Validate the data.
     * 
     * @return array
     */
    public function validated()
    {
        $validator = Validator::make($this->getData(), [
            'user_id' => 'required',
            'comment' => 'required',
        ]);

        $this->setRedirector($validator);

        $validator->setException($this->redirector->getValidationException());

        return $this->validateWithBag ? $validator->validateWithBag($this->errorBag()) : $validator->validated();
    }

    /**
     * Set redirector.
     * 
     * @param \Illuminate\Validation\Validator $validator
     * @return $this
     */
    public function setRedirector($validator)
    {
        $redirector = config('comment.redirector');

        $this->redirector = new $redirector($validator);

        return $this;
    }

    /**
     * Run validation with error bag.
     * 
     * @param bool $validateWithBag
     * @return this
     */
    public function validateWithBag($validateWithBag = true)
    {
        $this->validateWithBag = $validateWithBag;

        return $this;
    }

    /**
     * Make string error bag.
     * 
     * @return string
     */
    protected function errorBag()
    {
        return (string) $this->commentable->id . $this->request->method();
    }

    /**
     * Store the comment to the storage.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store()
    {
        return $this->commentable->comments()->create($this->validated());
    }

    /**
     * Update the exists comment.
     * 
     * @return bool
     */
    public function update()
    {
        $this->authorize('update', $this->commentable);

        return $this->commentable->update(['comment' => $this->validated()['comment']]);
    }

    /**
     * Remove the comment from the storage.
     * 
     * @return bool
     */
    public function destroy()
    {
        $this->authorize('delete', $this->commentable);

        return $this->commentable->delete();
    }
}
