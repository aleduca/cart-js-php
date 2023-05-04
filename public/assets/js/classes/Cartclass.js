import { currency } from "../modules/helpers.js";

class Cartclass {

  constructor() {
    this.cart = (localStorage.getItem('cart')) ?
      JSON.parse(localStorage.getItem('cart')):
      [];   
  }

  add(product) {

    if (!this.cart.length) {
      this.cart.push({ id: product.id, qty:1, price: product.price });
      localStorage.setItem('cart',JSON.stringify(this.cart));
      return;
    }

    const productFound = this.getProductIndex(product);

    (productFound >= 0) ?
      this.cart[productFound].qty += 1 :
      this.cart.push({ id: product.id, qty: 1, price: product.price });
    
    localStorage.setItem("cart", JSON.stringify(this.cart));

    console.log(this.cart);
  }
  
  remove(product) {
     const productFound = this.getProductIndex(product);

    if (productFound >= 0) {
      (this.cart[productFound].qty <= 1)?
        this.cart.splice(productFound, 1):
        this.cart[productFound].qty -= 1 
    }

    localStorage.setItem("cart", JSON.stringify(this.cart));

    console.log(this.cart);
  }

  clear() {
    this.cart = [];
    localStorage.removeItem('cart');
  }

  getProductIndex(product) {
    return this.cart.findIndex(productInCart => { 
      return productInCart.id === product.id;
    })
  }

  getProductQuantityAndPrice(product) {
    const productFound = this.getProductIndex(product);

    if (productFound < 0) {
      return {
        qty: 0,
        price:0
      }
    }

    const total = this.cart[productFound].qty * this.cart[productFound].price;

    return {qty: this.cart[productFound].qty, price: currency(total)}
  }

  getTotalQuantityAndPrice() {
    const sum = this.cart.reduce((accumulator, product) => {
      return {
        qty: accumulator['qty'] + product.qty,
        total: accumulator['total'] + (product.qty * product.price)
      }
    }, { qty: 0, total: 0 })
    
    return sum;
  }

  getCart() {
    return this.cart;
  }

}

export default Cartclass;