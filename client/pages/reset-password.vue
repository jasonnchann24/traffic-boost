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
            <h1 class="fw-bold">Traffic Boost</h1>
            <h5 class="fw-bold">Setel Ulang Kata Sandi</h5>
            <div class="w-75 mt-4">
              <form @submit.prevent="resetPassword()">
                <BaseInput
                  v-model="form.email"
                  type="email"
                  placeholder="example@email.com"
                  form-for="formEmail"
                  label="Alamat E-mail Terdaftar"
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
                <BaseInput
                  v-model="form.password_confirmation"
                  type="password"
                  placeholder="Ulang Kata Sandi"
                  form-for="formPasswordConfirmation"
                  label="Ulang Kata Sandi"
                  required
                />
                <NuxtLink to="/login">Batal</NuxtLink>
                <button type="submit" class="btn btn-primary w-100 mt-4">
                  Ubah
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
  name: 'ResetPassword',
  middleware: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
        password: '',
        password_confirmation: '',
      },
    }
  },
  methods: {
    async resetPassword() {
      this.form.token = this.$route.query.token

      await this.$axios.$get('/sanctum/csrf-cookie')
      const [_, error] = await this.$async(
        this.$axios.$post('/reset-password', this.form)
      )
      if (error) {
        this.$errorHandler(
          'Penyetelan gagal! Lakukan permintaan email ulang atau coba sebentar lagi.',
          {
            timeout: 10000,
          }
        )
        return
      }
      this.$successHandler('Berhasil! Kata sandi Anda berhasil diubah!')
      this.$router.push('/login')
    },
  },
}
</script>

<style></style>
