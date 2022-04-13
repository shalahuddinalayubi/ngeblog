<?php

return [
    /**
     * If you wish to extends \Lara\Comment\Redirect\Redirect
     * for your implementation redirect that you want.
     */
    'redirector' => \Lara\Comment\Redirect\RedirectBackWithFragment::class,

    /**
     * This option controll how to validate the comment data.
     */
    'validator' => \Lara\Comment\Validation\DefaultValidator::class,

    /**
     * This option determine route to comment on a comment.
     */
    'route' => true,

    'indentation' => 1
];
