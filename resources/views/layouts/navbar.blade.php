<nav class="navbar navbar-light bg-white shadow-sm">

    <div class="container-fluid">

        <span class="navbar-brand">

            Admin Panel

        </span>

        <div>

            {{ auth()->user()->name }}

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="d-inline">

                @csrf

                <button
                    class="btn btn-danger btn-sm">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>