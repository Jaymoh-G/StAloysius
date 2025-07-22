<div
    x-data
    @turnstile-success.window="window.Livewire.find($root.getAttribute('wire:id')).set('turnstile_token', $event.detail)"
>
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session("message") }}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
    @endif

    <div class="blog-comments">
        <h3>Comments ({{ $commentsCount }})</h3>

        @if($comments->count() > 0)
        <div class="blog-comments-wrapper">
            @foreach($comments as $comment)
            <div class="blog-comments-single">
                <img src="{{ $comment->avatar }}" alt="{{ $comment->name }}" />
                <div class="blog-comments-content">
                    <h5>{{ $comment->name }}</h5>
                    <span>
                        <i class="far fa-clock"></i>
                        {{ $comment->created_at->format('M d, Y') }}
                    </span>
                    <p>{{ $comment->comment }}</p>
                    <a
                        href="#"
                        wire:click.prevent="setReplyTo({{ $comment->id }})"
                    >
                        <i class="far fa-reply"></i>
                        Reply
                    </a>
                </div>
            </div>

            {{-- Display replies --}}
            @foreach($comment->replies as $reply)
            <div class="blog-comments-single blog-comments-reply">
                <img src="{{ $reply->avatar }}" alt="{{ $reply->name }}" />
                <div class="blog-comments-content">
                    <h5>{{ $reply->name }}</h5>
                    <span>
                        <i class="far fa-clock"></i>
                        {{ $reply->created_at->format('M d, Y') }}
                    </span>
                    <p>{{ $reply->comment }}</p>
                    <a
                        href="#"
                        wire:click.prevent="setReplyTo({{ $comment->id }})"
                    >
                        <i class="far fa-reply"></i>
                        Reply
                    </a>
                </div>
            </div>
            @endforeach @endforeach
        </div>
        @else
        <div class="text-center py-4">
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        </div>
        @endif

        <div class="blog-comments-form" id="commentForm">
            <h3>
                @if($replyTo) Reply to Comment
                <button
                    type="button"
                    class="btn btn-sm btn-outline-secondary ms-2"
                    wire:click="cancelReply"
                >
                    Cancel Reply
                </button>
                @else Leave A Comment @endif
            </h3>

            <form wire:submit.prevent="submitComment">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Your Name*"
                                wire:model="name"
                            />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Your Email*"
                                wire:model="email"
                            />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea
                                class="form-control @error('comment') is-invalid @enderror"
                                rows="5"
                                placeholder="Your Comment*"
                                wire:model="comment"
                            ></textarea>
                            @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <div
                                id="cf-turnstile-comments"
                                class="cf-turnstile"
                                data-sitekey="{{
                                    config('services.turnstile.sitekey')
                                }}"
                                data-callback="onTurnstileSuccess"
                            ></div>
                            @error('turnstile_token')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button
                            type="submit"
                            class="theme-btn"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove>
                                @if($replyTo) Post Reply @else Post Comment
                                @endif
                                <i class="far fa-paper-plane"></i>
                            </span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin"></i>
                                Submitting...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("livewire:init", () => {
            Livewire.on("scrollToCommentForm", () => {
                document.getElementById("commentForm").scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            });
        });
    </script>
</div>

<script
    src="https://challenges.cloudflare.com/turnstile/v0/api.js"
    async
    defer
></script>
<script>
    function onTurnstileSuccess(token) {
        window.dispatchEvent(
            new CustomEvent("turnstile-success", { detail: token })
        );
    }
</script>
