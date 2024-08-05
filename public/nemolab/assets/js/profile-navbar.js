document.addEventListener("DOMContentLoaded", function () {
    const profileDiv = document.getElementById("profileMenu");
    const profileImg = document.getElementById("myProfile");

    profileImg.addEventListener("click", function () {
      profileDiv.classList.toggle("menu");
    });
  });