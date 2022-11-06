<template>
  <div class="auth-layout">
    <aside class="auth-sidebar">
      <div class="logo">TIMEKEEPER</div>
      <div v-for="(path, index) in paths" :key="index">
        <router-link class="nav-link" :class="[$route.path === path.path ? 'nav-link-active' : '']" :to="path.path"
          v-if="path.path === '/manage/day/off' && isAdmin || path.path !== '/manage/day/off'">
          {{ path.name }}
        </router-link>
      </div>
    </aside>
    <div class="auth-main">
      <nav class="navbar">
        <div class="button_cont">
          <button class="checkin" @click="checkin">Checkin</button>
          <button class="checkout" @click="checkout">Checkout</button>
        </div>
        <div class="user">
          <p class="name">{{ user.name || "" }}</p>
          <button @click="logout" class="logout">
            <v-icon>mdi-logout-variant</v-icon>
          </button>
        </div>
      </nav>
      <div class="auth-body">
        <div class="auth-body-content">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import paths from "../configs/path";
import localStorageData from "../configs/localStorage";

export default {
  name: "AuthLayout",

  data() {
    return {
      paths: paths,
      user: {},
    };
  },

  computed: {
    isAdmin() {
      return this.user && this.user.role == 1 ? true : false
    }
  },

  methods: {
    async logout() {
      await this.$store.dispatch("auth/logout");
      this.$router.push({ name: "Login" });
      location.reload();
    },

    async checkin() {
      let res = await this.$store.dispatch("timekeeper/checkin");

      if (res.status === 200) {
        alert("Bạn đã checkin thành công");
        location.reload();
      } else if (res.status === 422) {
        alert("Bạn đã checkin ngày hôm nay");
      } else {
        alert("Đã xảy ra lỗi, vui lòng thử lại");
        location.reload();
      }
    },

    async checkout() {
      let res = await this.$store.dispatch("timekeeper/checkout");

      if (res.status === 200) {
        alert("Bạn đã checkout thành công");
        location.reload();
      } else if (res.status === 422) {
        alert(res.data.message);
      } else {
        alert("Đã xảy ra lỗi, vui lòng thử lại");
        location.reload();
      }
    },
  },

  async created() {
    if (!localStorage.getItem(localStorageData.key.auth)) {
      this.$router.push({ name: "Login" });
    } else {
      let user = this.$store.state.auth?.user;
      if (user) {
        this.user = user;
      } else {
        let res = await this.$store.dispatch("auth/user");
        if (res.status === 200) {
          this.user = res.data;
        } else {
          alert("Có lỗi đã xảy ra vui lòng đăng nhập lại");
          localStorage.removeItem(localStorageData.key.auth);
          location.reload();
        }
      }
    }
  },
};
</script>

<style lang="scss" scoped>
.logo {
  font-size: 32px;
  font-weight: 600;
  text-align: center;
  color: #ffffff;
  margin-bottom: 8px;
  border-bottom: 1px solid #cccccc;
  padding: 16px 0;
}

.auth-sidebar {
  width: 250px;
  height: 100vh;
  background-color: #343a40;
  position: fixed;
  top: 0;
  left: 0;
}

.auth-main {
  margin-left: 250px;
  height: 100vh;
  background-color: #ffffff;
}

.nav-link {
  display: block;
  text-decoration: none;
  padding: 8px;
  margin: 8px;
  border-radius: 4px;
  color: #ffffff;
  background-color: transparent;
  transition: all 0.2s ease-in-out;

  &:hover {
    background-color: #606b77;
  }

  &-active {
    background-color: #7e8c9b !important;
  }
}

.navbar {
  height: 50px;
  background-color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;

  & .user {
    display: flex;
    align-items: center;

    & .name {
      margin-right: 16px;
    }

    & button.logout {
      width: 32px;
      height: 32px;
      background-color: #f5f5f5;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease-in-out;

      & .v-icon {
        font-size: 18px;
      }

      &:hover {
        background-color: #e9e9e9;
      }

      &:active {
        background-color: #cecdcd;
      }
    }
  }

  & .button_cont button {
    padding: 4px 16px;
    color: #ffffff;
    border-radius: 4px;
    transition: all 0.2s ease-in-out;

    &.checkin {
      background-color: #12a512;

      &:hover {
        background-color: #0f810f;
      }

      &:active {
        background-color: #0b580b;
      }
    }

    &.checkout {
      background-color: #dd0808;

      &:hover {
        background-color: #b90606;
      }

      &:active {
        background-color: #850404;
      }
    }
  }
}

.auth-body {
  overflow-y: hidden;
  padding: 16px;
  background-color: #e9e9e9;

  &-content {
    background-color: #ffffff;
    border-radius: 8px;
    overflow-y: scroll;
    height: calc(100vh - 50px - 16px - 16px);
    padding: 16px;

    &::-webkit-scrollbar {
      width: 0;
    }
  }
}
</style>
