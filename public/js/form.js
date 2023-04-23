// form loading animation

const form = [...document.querySelector(".form").children];

form.forEach((item, i) => {
  setTimeout(() => {
    item.style.opacity = 1;
  }, i * 100);
});

// window.onload = () => {
//   if (sessionStorage.name && location.pathname === "/register") {
//     location.href = "/";
//   }
// };

// form validation

const name = document.querySelector(".name");
const email = document.querySelector(".email");
const password = document.querySelector(".password");
const submitBtn = document.querySelector(".submit-btn");
const pname = document.querySelector(".product_name");
const unique_code = document.querySelector(".code");
const colour = document.querySelector(".colour");
const size = document.querySelector(".size");
const country = document.querySelector(".country");

switch (location.pathname) {
  case "/login": {
    submitBtn.addEventListener("click", () => {
      fetch("/login-user", {
        method: "post",
        headers: new Headers({ "Content-Type": "application/json" }),
        body: JSON.stringify({
          email: email.value,
          password: password.value,
        }),
      })
        .then((res) => res.json())
        .then((data) => {
          sessionStorage.setItem("email", email.value);
          //sessionStorage.setItem("name", name.value);
          redirectTo("/");
        });
    });

    break;
  }

  case "/register": {
    submitBtn.addEventListener("click", () => {
      fetch("/register-user", {
        method: "post",
        headers: new Headers({ "Content-Type": "application/json" }),
        body: JSON.stringify({
          name: name.value,
          email: email.value,
          password: password.value,
        }),
      })
        .then((res) => res.json())
        .then((data) => {
          redirectTo("/login");
        });
    });

    break;
  }

  case "/product": {
    if (!sessionStorage.email) location.href = "/login";

    submitBtn.addEventListener("click", () => {
      fetch("/product-user", {
        method: "post",
        headers: new Headers({ "Content-Type": "application/json" }),
        body: JSON.stringify({
          pname: pname.value,
          email: email.value,
          unique_code: unique_code.value,
          colour: colour.value,
          size: size.value,
          country: country.value,
        }),
      }).then((res) => res.json());
    });

    break;
  }
}

const redirectTo = (endpoint) => {
  location.pathname = endpoint;
  // location.href = redirectTo;
};

const alertBox = (data) => {
  const alertContainer = document.querySelector(".alert-box");
  const alertMsg = document.querySelector(".alert");
  alertMsg.innerHTML = data;

  alertContainer.style.top = `5%`;
  setTimeout(() => {
    alertContainer.style.top = null;
  }, 5000);
};

const logOut = document.querySelector(".logout");

logOut.onclick = () => {
  sessionStorage.clear();
  location.href = "/login";
};
