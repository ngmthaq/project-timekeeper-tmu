<template>
  <guest-layout>
    <div class="cont">
      <div class="cont-wrap">
        <div class="cont-wrap-bg">
          <img src="/image/login_bg.png" alt="Login Background" />
        </div>
        <form>
          <div class="form-row">
            <h1 class="form-title">Đăng nhập</h1>
          </div>
          <div class="form-row">
            <label for="email" class="required">Email</label>
            <input
              type="text"
              id="email"
              placeholder="Vui lòng nhập email của bạn"
            />
            <span class="error-msg"></span>
          </div>
          <div class="form-row">
            <label for="password" class="required">Mật khẩu</label>
            <input
              type="password"
              id="password"
              placeholder="Vui lòng nhập mật khẩu của bạn"
            />
            <span class="error-msg"></span>
          </div>
          <div class="form-row">
            <button type="button">Đăng nhập</button>
          </div>
        </form>
      </div>
    </div>
  </guest-layout>
</template>

<script>
export default {};
</script>


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
