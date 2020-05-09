@component('mail::message')
# New Post Published!

New post published by {{ '@'.$post->author->username }},

{{ $post->title }}
@component('mail::button', ['url' => $postLink])
Check Out Post
@endcomponent

Want to unsubscribe?
You can do so in your profile settings.

Thanks,<br>
The {{ config('app.name') }} Team
@endcomponent
