{!! $comment->author->username !!} commented on {!!  $commentable->getName()  !!}:<br><Br>

{!! nl2br($comment->text)  !!}

<a href="{{ $comment->reference_url }}">(View comment here)</a>
<br><br>
--
the {{ env('APP_NAME') }} Team
