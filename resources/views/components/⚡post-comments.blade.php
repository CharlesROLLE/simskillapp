<?php

use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    public string $body = '';

    public string $replyBody = '';

    public ?int $replyingTo = null;

    public ?int $userLikedId = null;

    public int $likesCount = 0;

    public function mount(Post $post): void
    {
        $this->post = $post->loadCount('postLikes');

        $this->likesCount = $post->post_likes_count;

        if (Auth::check()) {
            $like = PostLike::where('post_id', $post->id)
                ->where('user_id', Auth::id())
                ->first();

            $this->userLikedId = $like?->id;
        }
    }

    public function getCommentsProperty()
    {
        return $this->post
            ->postComments()
            ->with(['replies', 'replies.user'])
            ->get();
    }

    public function toggleLike(): void
    {
        if (! Auth::check()) {
            return;
        }

        if ($this->userLikedId) {
            PostLike::where('id', $this->userLikedId)->delete();
            $this->userLikedId = null;
            $this->likesCount--;
        } else {
            $like = PostLike::create([
                'post_id' => $this->post->id,
                'user_id' => Auth::id(),
            ]);
            $this->userLikedId = $like->id;
            $this->likesCount++;
        }
    }

    public function addComment(): void
    {
        if (! Auth::check()) {
            return;
        }

        $this->validate([
            'body' => 'required|min:2|max:1000',
        ]);

        PostComment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'body' => $this->body,
        ]);

        $this->body = '';
    }

    public function startReply(int $parentId): void
    {
        $this->replyingTo = $parentId;
        $this->replyBody = '';
    }

    public function cancelReply(): void
    {
        $this->replyingTo = null;
        $this->replyBody = '';
    }

    public function addReply(): void
    {
        if (! Auth::check()) {
            return;
        }

        $this->validate([
            'replyBody' => 'required|min:2|max:1000',
        ]);

        PostComment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'parent_id' => $this->replyingTo,
            'body' => $this->replyBody,
        ]);

        $this->replyBody = '';
        $this->replyingTo = null;
    }

    public function deleteComment(int $commentId): void
    {
        $comment = PostComment::findOrFail($commentId);

        if ($comment->user_id !== Auth::id()) {
            return;
        }

        $comment->delete();
    }
}
?>

<div class="space-y-6">
    <h2 class="text-2xl font-bold">{{ __('Comments') }}</h2>

    @guest
        <div class="bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-200 dark:border-indigo-700 rounded-lg p-4 text-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-indigo-700 dark:text-indigo-300">
                    {{ __('Please') }}
                    <a href="{{ route('login') }}" class="font-semibold underline hover:no-underline">{{ __('login') }}</a>
                    {{ __('or') }}
                    <a href="{{ route('register') }}" class="font-semibold underline hover:no-underline">{{ __('register') }}</a>
                    {{ __('to add a comment.') }}
                </p>
            </div>
        </div>
    @endguest

    @auth
        <form wire:submit="addComment" class="space-y-3">
            <flux:field>
                <flux:textarea wire:model="body" placeholder="{{ __('Write a comment...') }}" rows="3" />
                <flux:error name="body" />
            </flux:field>
            <div class="flex justify-end">
                <flux:button type="submit">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    {{ __('Post Comment') }}
                </flux:button>
            </div>
        </form>
    @endauth

    <div class="space-y-6">
        @forelse ($this->comments as $comment)
            <div class="space-y-3" wire:key="comment-{{ $comment->id }}">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                        {{ $comment->user->initials() }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-semibold text-sm">{{ $comment->user->name }}</span>
                            <span class="text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                            @auth
                                @if ($comment->user_id === Auth::id())
                                    <button
                                        wire:click="deleteComment({{ $comment->id }})"
                                        wire:confirm="{{ __('Delete this comment?') }}"
                                        class="text-gray-400 hover:text-red-500 transition-colors ml-auto"
                                    >
                                        <flux:icon.trash class="w-4 h-4" />
                                    </button>
                                @endif
                            @endauth
                        </div>
                        <p class="text-gray-700 dark:text-gray-200 mt-1">{{ $comment->body }}</p>
                        @auth
                            <button
                                wire:click="startReply({{ $comment->id }})"
                                class="text-xs text-indigo-600 hover:text-indigo-800 font-medium mt-1"
                            >
                                {{ __('Reply') }}
                            </button>
                        @endauth
                    </div>
                </div>

                @if ($replyingTo === $comment->id)
                    <div class="ml-11">
                        <form wire:submit="addReply" class="space-y-2">
                            <flux:field>
                                <flux:textarea wire:model="replyBody" placeholder="{{ __('Write a reply...') }}" rows="2" />
                                <flux:error name="replyBody" />
                            </flux:field>
                            <div class="flex items-center gap-2">
                                <flux:button type="submit" size="sm">{{ __('Post Reply') }}</flux:button>
                                <flux:button variant="ghost" size="sm" wire:click="cancelReply">{{ __('Cancel') }}</flux:button>
                            </div>
                        </form>
                    </div>
                @endif

                @if ($comment->replies->isNotEmpty())
                    <div class="ml-11 space-y-3">
                        @foreach ($comment->replies as $reply)
                            <div class="flex items-start gap-3" wire:key="reply-{{ $reply->id }}">
                                <div class="w-7 h-7 rounded-full bg-gray-500 flex items-center justify-center text-white text-[10px] font-bold shrink-0">
                                    {{ $reply->user->initials() }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-semibold text-sm">{{ $reply->user->name }}</span>
                                        <span class="text-gray-400 text-xs">{{ $reply->created_at->diffForHumans() }}</span>
                                        @auth
                                            @if ($reply->user_id === Auth::id())
                                                <button
                                                    wire:click="deleteComment({{ $reply->id }})"
                                                    wire:confirm="{{ __('Delete this comment?') }}"
                                                    class="text-gray-400 hover:text-red-500 transition-colors ml-auto"
                                                >
                                                    <flux:icon.trash class="w-4 h-4" />
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-200 mt-0.5 text-sm">{{ $reply->body }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-400 text-sm">{{ __('No comments yet. Be the first to comment!') }}</p>
        @endforelse
    </div>

    <div class="border-t pt-4 flex items-center gap-3">
        <button
            wire:click="toggleLike"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-200 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors text-sm"
        >
            @if ($userLikedId)
                <flux:icon.heart class="w-5 h-5 text-red-500 fill-current" />
            @else
                <flux:icon.heart class="w-5 h-5 text-gray-400" />
            @endif
            <span class="font-medium">{{ $likesCount }}</span>
        </button>
    </div>
</div>
