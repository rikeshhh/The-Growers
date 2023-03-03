document.getElementById("close-update").addEventListener("click", () => {
  console.log("HELLO");
  document.querySelector(".edit-product-form").style.display = "none";
  window.location.href = "admin_products.php";
});
