<template>
  <nav class="navbar navbar-expand-xl navbar-light bg-light shadow mb-5 py-3">
    <div class="container-fluid">
      <NuxtLink to="/" class="navbar-brand fw-bold text-primary"
        >Traffic Boost</NuxtLink
      >
      <button
        class="navbar-toggler border-0"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNavbar"
        aria-controls="mainNavbar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="mainNavbar" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <NuxtLink to="/home" class="nav-link">Home</NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/users" class="nav-link">Users</NuxtLink>
          </li>
          <li class="nav-item dropdown me-5">
            <a
              id="navbarDropdown"
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              {{ $auth.user.name }}
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdown"
            >
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Help</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <button class="dropdown-item" @click="logMeOut()">
                  Logout
                </button>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'TheNavbar',
  methods: {
    async logMeOut() {
      const [_, error] = await this.$async(this.$auth.logout())
      if (error) {
        this.$errorHandler('Something went wrong! Please refresh this page.')
        return
      }
      this.$router.push('/')
      this.$successHandler('Successfully logout.')
    },
  },
}
</script>

<style></style>
