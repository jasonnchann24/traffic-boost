<template>
  <div class="card border-0 shadow-sm p-4">
    <div class="card-body">
      <h5>Panel Penyaring Data</h5>
      <div class="row mt-3">
        <div class="col-12 col-xl-5">
          <BaseInput
            v-model="form.search"
            type="text"
            placeholder="Cari nama / email pengguna"
            form-for="formSearch"
            label="Cari"
          />
        </div>
        <div class="col-12 col-xl-7">
          <label class="form-label">Kategori Pengguna</label>
          <div class="d-flex align-items-end">
            <BaseCheckbox
              v-model="form.roles.employee"
              label="Karyawan"
              form-for="checkEmployee"
            />
            <BaseCheckbox
              v-model="form.roles.tenant"
              label="Tenant"
              form-for="checkTenant"
            />
            <BaseCheckbox
              v-model="form.roles.admin"
              label="Admin"
              form-for="checkAdmin"
            />
            <BaseCheckbox
              v-model="form.roles.superadmin"
              label="Super Admin"
              form-for="checkSuperadmin"
            />
          </div>
        </div>
        <hr class="my-2" />
        <div class="col-12 text-end mt-3">
          <button class="btn btn-secondary px-5" @click="resetForm()">
            Atur Ulang
          </button>
          <button class="btn btn-primary px-5" @click="getUsers">Saring</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapActions } from 'vuex'
export default {
  name: 'UsersFilterPanel',
  data() {
    return {
      form: {
        roles: {
          tenant: true,
          admin: true,
          superadmin: true,
          employee: true,
        },
        search: '',
      },
    }
  },
  mounted() {
    this.getUsers()
  },
  methods: {
    ...mapActions({
      GET_USERS: 'users/GET_USERS',
    }),
    ...mapMutations({
      SET_QUERY: 'users/SET_QUERY',
    }),
    async getUsers() {
      this.setQueryString()
      const [_, error] = await this.$async(this.GET_USERS({}))
      if (error) {
        this.$errorHandler('Sesuatu bermasalah. Coba sebentar lagi.')
        return
      }
      this.$successHandler()
    },
    setQueryString() {
      let qs = this.$qsHandler('search', this.form.search)
      for (const prop in this.form.roles) {
        if (this.form.roles[prop]) {
          qs += this.$qsHandler(prop, this.form.roles[prop])
        }
      }
      this.SET_QUERY(qs)
    },
    resetForm() {
      this.form = {
        roles: {
          tenant: true,
          admin: true,
          superadmin: true,
          employee: true,
        },
        search: '',
      }
    },
  },
}
</script>

<style></style>
