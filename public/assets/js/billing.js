// Dynamically add product rows
const productsList = document.getElementById('products-list');
const addProductButton = document.getElementById('add-product');
let productCounter = 0;

addProductButton.addEventListener('click', () => {
    productCounter++;
    const productRow = document.createElement('div');
    productRow.className = 'product-row';
    productRow.innerHTML = `
        <input type="text" name="product-id[${productCounter}]" class="product-input" onchange="getProduct(this)" placeholder="Product ID" required>
        <input type="number" name="quantity[${productCounter}]" class="quantity-input" oninput="fixQuantity(this)" placeholder="Quantity" required>
    `;
    productsList.appendChild(productRow);
});

/**
 * Fetches product details from the server and adds the product quantity to
 * the input element as a data attribute. This is called when the user
 * types a product ID into the input field.
 *
 * @param {HTMLInputElement} input The input element containing the product ID.
 */
function getProduct(input) {
    input.classList.remove('error');
    fetch(getProductUrl.replace(':productId', input.value))
        .then(response => response.json())
        .then(response => {
            input.nextElementSibling.setAttribute('data-quantity', response.data.quantity);
        })
        .catch(error => {
            input.classList.add('error');
            console.error('Error fetching product details:', error);
        });
}

/**
 * Checks that the quantity entered by the user is within the range of 1 to the
 * available quantity of the product. If the quantity is outside this range, it
 * is adjusted to be within the range.
 *
 * @param {HTMLInputElement} input The input element containing the quantity.
 */
function fixQuantity(input) {
    const availableQuantity = parseFloat(input.getAttribute('data-quantity'));
    const quantity = parseFloat(input.value);

    if (quantity <= 0) {
        input.value = 1;
    }

    if (quantity >= availableQuantity) {
        input.value = availableQuantity;
    }
}
