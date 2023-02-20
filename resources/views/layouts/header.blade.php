<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="#"></a> --}}
        <span class="navbar-brand">Blog</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to='/' class="nav-link">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link to='/register' class="nav-link">Register</router-link>
                </li>
                <li class="nav-item">
                    <router-link to='/login' class="nav-link">Login</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'account-info' }" class="nav-link">Profile</router-link>
                </li>
                <li class="nav-item">
                    <router-link to='/users' class="nav-link">Users</router-link>
                </li>
                {{-- <li class="nav-item">
                    <router-link to='/tool' class="nav-link">Tool</router-link>
                </li> --}}
                <li class="nav-item">
                    <router-link to='/about' class="nav-link">About</router-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
