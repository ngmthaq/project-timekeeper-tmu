<template>
  <guest-layout>
    <div class="cont">
      <div class="cont-wrap">
        <div class="cont-wrap-bg">
          <img src="/image/login_bg.png" alt="Login Background" />
        </div>
        <form @submit.prevent="login">
          <div class="form-row">
            <h1 class="form-title">Đăng nhập</h1>
          </div>
          <div class="form-row">
            <label for="username" class="required">Tài khoản</label>
            <input
              type="text"
              id="username"
              placeholder="Vui lòng nhập tài khoản của bạn"
              v-model="credentials.username"
            />
            <span class="error-msg"> {{ errors.username }} </span>
          </div>
          <div class="form-row">
            <label for="password" class="required">Mật khẩu</label>
            <input
              type="password"
              id="password"
              placeholder="Vui lòng nhập mật khẩu của bạn"
              v-model="credentials.password"
            />
            <span class="error-msg"> {{ errors.password }} </span>
          </div>
          <div class="form-row">
            <button type="submit">Đăng nhập</button>
          </div>
        </form>
      </div>
    </div>
  </guest-layout>
</template>

<script>
export default {
  data() {
    return {
      credentials: {
        username: "",
        password: "",
      },
      errors: {
        username: "",
        password: "",
      },
    };
  },

  methods: {
    async login() {
      let res = await this.$store.dispatch("auth/login", this.credentials);

      this.errors = { username: "", password: "" };

      if (res.status === 200) {
        this.$router.push({ name: "Timekeeper" });
      } else if (res.status === 401) {
        this.errors.username = res.data.message;
      } else if (res.status === 422) {
        if (res.data.errors.username) {
          this.errors.username = res?.data?.errors?.username[0];
        }

        if (res.data.errors.password) {
          this.errors.password =
            res?.data?.errors?.password[0] ?? res.data.message;
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped>
form {
  flex: 1;

  & .form-row {
    display: flex;
    flex-direction: column;
    padding: 0 80px;
    margin-bottom: 16px;

    & h1 {
      font-size: 32px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 16px;
      text-transform: uppercase;
      color: #1b805b;
    }

    & label {
      align-self: flex-start;
      margin-bottom: 4px;
    }

    & input {
      border: 1px solid #999;
      padding: 8px 16px;
      border-radius: 8px;
      outline: none;
      transition: all 0.2s ease-in-out;
      font-size: 16px;

      &:focus {
        border-color: #1b805b;
      }
    }

    & .error-msg {
      font-size: 12px;
      color: #ff0000;
    }

    & button {
      padding: 12px 16px;
      background-color: #2ccc92;
      color: #ffffff;
      border-radius: 16px;
      transition: all 0.2s ease-in-out;
      margin-top: 16px;

      &:hover {
        background-color: #1b805b;
      }

      &:active {
        background-color: #156346;
      }
    }
  }
}

.cont {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  width: 100vw;
  background-color: #2ccc92;

  &-wrap {
    width: 1280px;
    max-width: 60vw;
    border-radius: 16px;
    background-color: #ffffff;
    overflow: hidden;
    box-shadow: 4px 4px 8px 0px #1b805b;
    display: flex;
    align-items: center;
    justify-content: space-between;

    &-bg {
      max-width: 500px;
      width: 100%;
      height: 500px;
      flex: 1;

      & img {
        width: 100%;
        height: 100%;
      }
    }
  }
}
</style>
