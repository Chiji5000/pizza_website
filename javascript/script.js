const accounts = {
  user123: "123",
  admin: "password",
};

const submitBtn = document.getElementById("submit-btn");

submitBtn.addEventListener("click", (e) => {
  e.preventDefault();
  const username = document.getElementById("username").value;
  const code = document.getElementById("code").value;

  if (accounts[username] === code) {
    window.location.href = "loaderindex.html";
  } else {
    alert("Invalid username or code");
  }
});

