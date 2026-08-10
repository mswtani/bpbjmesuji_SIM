<form
    method="POST"
    action="{{ route('logout') }}"
>
    @csrf

    <button
        type="submit"
        class="w-full text-left"
    >
        Logout
    </button>
</form>