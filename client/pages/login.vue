<template>
  <div
    class="
      container
      full-height
      d-flex
      flex-column
      align-items-center
      justify-content-center
    "
  >
    <div class="row w-100">
      <div class="col-12 col-lg-6 d-flex justify-content-center mx-auto">
        <div class="card w-100 border-0 shadow rounded-5 py-5">
          <div class="card-body d-flex flex-column align-items-center">
            <NuxtLink to="/" class="text-decoration-none">
              <h1 class="fw-bold">Traffic Booster</h1>
            </NuxtLink>
            <h5>Booster Management System</h5>

            <div class="w-75 mt-2">
              <p
                class="
                  text-danger
                  mb-3
                  p-2
                  border-start border-danger border-4
                  rounded-2
                "
              >
                Jika Anda merupakan karyawan / tenant silahkan masuk melalui
                aplikasi ponsel Anda.
              </p>
              <form @submit.prevent="logMeIn()">
                <BaseInput
                  v-model="form.email"
                  type="email"
                  placeholder="example@email.com"
                  form-for="formEmail"
                  label="Alamat E-mail"
                  required
                />
                <BaseInput
                  v-model="form.password"
                  type="password"
                  placeholder="Kata Sandi"
                  form-for="formPassword"
                  label="Kata Sandi"
                  required
                />
                <NuxtLink to="/forgot-password">Lupa kata sandi?</NuxtLink>

                <button type="submit" class="btn btn-primary w-100 mt-3">
                  MASUK
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
  middleware: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    }
  },
  methods: {
    async logMeIn() {
      this.$store.dispatch('TOGGLE_LOADING')
      try {
        await this.$auth.loginWith('laravelSanctum', {
          data: {
            email: this.form.email,
            password: this.form.password,
          },
        })
        this.$successHandler('Berhasil masuk.')
      } catch (err) {
        this.$errorHandler(
          'Sesuatu bermasalah! Pastikan kembali email dan kata sandi, atau coba sebentar lagi.',
          { timeout: 10000 }
        )
      } finally {
        this.$store.dispatch('TOGGLE_LOADING', false)
      }
    },
  },
}
</script>

<style></style>
