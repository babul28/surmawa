<div>
    @unless($user->email_verified_at)
    @if(session()->has('status'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
        class="bg-cyan-400 p-2 text-sm text-center flex justify-between" style="display: none">
        <p class="flex-1">{{ __('A new verification link has been sent to the email address you provided during
            registration.') }}</p>
        <a @click.prevent="show=false" href="">
            <x-icons.close />
        </a>
    </div>
    @endif

    <div x-data="{show: true}" x-show="show" class="bg-yellow-300 p-2 text-sm text-center flex justify-between"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
        style="display: none">
        <p class="flex-1">
            Please verify the email first!,
            <a @click.prevent="$refs.verification_form.submit()" href="{{ route('verification.send') }}"
                class="underline">
                resend email
            </a>.
        </p>

        <a @click.prevent="show=false" href="">
            <x-icons.close />
        </a>

        <form x-ref="verification_form" action="{{ route('verification.send') }}" method="POST" style="display: none">
            @csrf
        </form>
    </div>
    @endunless

</div>
