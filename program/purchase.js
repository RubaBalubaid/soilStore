let cartIcon = document.querySelector('.cart-icon')
let cart = document.querySelector('.cart')
let closeCart = document.querySelector('.close-cart')

//open cart
cartIcon.onclick = () => {
    cart.classList.add("active");
}
//cart close
closeCart.onclick = () => {
    cart.classList.remove("active");
}

if (document.readyState == 'loading'){
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}


function ready() {
    var removeCartItemButtons = document.getElementsByClassName("crat-remove")
    for (var i =0; i < removeCartItemButtons.length; i++){
        var button = removeCartItemButtons[i]
        button.addEventListener("click", removeCartItem)    
    }
    var quantityInputs = document.getElementsByClassName("cart-quantity")
    for (var i =0; i < quantityInputs.length; i++){
        var input =  quantityInputs[i]
        input.addEventListener("change", quantityChanged)
    }
}

function removeCartItem(event){
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event){
    var input = event.target
    if (isNaN(input.value) || input.value <= 0){
        input.value = 1
    }
    updateCartTotal()
}

function addToCartClicked(event) {
  var button = event.target;
  var product = button.parentElement;
  var title = product.getElementsByClassName("product-title")[0].innerText;
  var price = product.getElementsByClassName("price")[0].innerText;
  var imageSrc = product.getElementsByClassName("product-img")[0].src;
  addItemToCart(title, price, imageSrc);
}

function addItemToCart(title, price, imageSrc) {
  var cartRow = document.createElement("div");
  cartRow.classList.add("cart-box");
  var cartItems = document.getElementsByClassName("cart-content")[0];
  var cartItemNames = cartItems.getElementsByClassName("cart-product-title");
  for (var i = 0; i < cartItemNames.length; i++) {
    if (cartItemNames[i].innerText == title) {
      alert("This item is already added to the cart");
      return;
    }
  }
  var cartRowContents = `
    <img class="cart-img" src="${imageSrc}" alt="product image">
    <p class="cart-product-title">${title}</p>
    <input class="cart-quantity" type="number" value="1">
    <h6 class="price">${price}</h6>
    <div class="crat-remove">&#10005;</div>
    `;
  cartRow.innerHTML = cartRowContents;
  cartItems.append(cartRow);
  cartRow.getElementsByClassName("crat-remove")[0].addEventListener("click", removeCartItem);
  cartRow.getElementsByClassName("cart-quantity")[0].addEventListener("change", quantityChanged);
  updateCartTotal();
}

function updateCartTotal(){
    var cartItemContener = document.getElementsByClassName("cart-content")[0]
    var CartBox = cartItemContener.getElementsByClassName("cart-box")
    var total = 0
    for (var i =0; i < CartBox.length; i++){
        var CartBox =CartBox[i]
        var priecElemant = CartBox.getElementsByClassName("price")[0]
        var quantityElement = CartBox.getElementsByClassName("cart-quantity")[0]
        var price = parseFloat(priecElemant.innerText.replace('RS', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName("total-price")[0].innerText = '$' + total
}