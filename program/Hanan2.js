function showAlert() {
    var message = "Item Has Been Successfully Added To The Cart!";
    alert(message);
}
function toggleDescription(descriptionId) {
  var description = document.getElementById(descriptionId);
  if (description.style.display === "none") {
    description.style.display = "block";
  } else {
    description.style.display = "none";
  }
}
