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
            <h5 class="fw-bold">Lupa Kata Sandi</h5>
            <div class="w-75 mt-4">
              <form @submit.prevent="forgetPassword()">
                <BaseInput
                  v-model="form.email"
                  type="email"
                  placeholder="example@email.com"
                  form-for="formEmail"
                  label="Alamat E-mail"
                  required
                />
                <NuxtLink to="/login">Batal</NuxtLink>
                <button type="submit" class="btn btn-primary w-100 mt-4">
                  Kirim Permintaan
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
  name: 'ForgotPassword',
  middleware: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
      },
    }
  },
  methods: {
    async forgetPassword() {
      await this.$axios.$get('/sanctum/csrf-cookie')
      const [_, error] = await this.$async(
        this.$axios.$post('/forgot-password', this.form)
      )
      if (error) {
        this.$errorHandler('Permintaan gagal! Coba sebentar lagi.')
        return
      }
      this.$successHandler(
        'Berhasil! Permintaan penyetelan ulang kata sandi Anda sudah terkirim melalui email!'
      )
    },
  },
}
</script>

<style></style>
