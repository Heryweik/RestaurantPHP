let url = "producto.php";
fetch(url)
  .then((response) => response.json())
  .then((data) => {
    mostrarProductos(data);
    productList.push(data);
  })
  .catch((error) => console.log("Error:", error));

//<div class="d-flex gap-4" style="display: flex; flex-wrap: wrap; justify-content: center; padding: 1.5rem;">

/* const mostrarProductos = (data) => {
    let body = "";
    for (let i = 0; i < data.length; i++) {
        body += `
        <h2>${data[i].category}</h2>
        <div  class="d-flex gap-4" style="display: flex; flex-wrap: wrap; justify-content: center; padding: 1.5rem;">
            ${
                data.filter((p) => p.category === data[i].category).map((p) => {
                    return `
                    <div class="card" style="width: 18rem;">
                        <img src="${p.image}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title
                            ">${p.title}</h5>
                            <p class="card-text">${p.price}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    `;
            }
            ).join('')}
      </div>
        `;
    }
    document.getElementById("all-products").innerHTML = body;
};
 */

let cantidad = 0;
const mostrarProductos = (data) => {
  // Obtener categorías únicas
  const categoriasUnicas = [
    ...new Set(data.map((producto) => producto.NombreCategoria)),
  ];

  let body = "";
  categoriasUnicas.forEach((categoria) => {
    // Filtrar productos por categoría
    const productosCategoria = data.filter(
      (producto) => producto.NombreCategoria === categoria
    );

    body += `
              <h2 class='text-center'>${categoria}</h2>
              <div class="gap-5" style="display: flex; justify-content: center; flex-wrap: wrap; padding: 1.5rem; width: 100%">
                  ${productosCategoria
                    .map((p) => {
                      const productId = p.ProductoID;

                      return `
                              <div class="card col-2 p-4 d-flex align-items-center justify-content-center text-center " style="width: 29rem; border-radius: 1rem;">
                                  <img src="./images/${productId}.jpg" class="card-img-top img-fluid w-50 h-50" alt="...">
                                  <div class="">
                                      <h5 class="card-title">${p.Nombre}</h5>
                                      <p class="card-text">${p.Precio}</p>
                                      <div style="display: flex; justify-content: center; margin-bottom: 1rem; gap: .5rem">
                                      <button onclick="restar(${productId})" style="border: none; width: 3rem; height: 2rem; display: flex; align-items: center; justify-content: center">-</button>
                                      <span id="contador-${productId}">${cantidad}</span>
                                      <button onclick="sumar(${productId})" style="border: none; width: 3rem; height: 2rem; display: flex; align-items: center; justify-content: center">+</button>
                                      </div>
                                      <button class="btn btn-primary" id="agregar-${productId}" disabled onclick="agregarAlCarrito(${productId})">Agregar al carrito</button>
                                  </div>
                              </div>
                          `;
                    })
                    .join("")}
              </div>
          `;
  });

  document.getElementById("all-products").innerHTML = body;
};

/* Contador para la cantidad de productos */
const sumar = (productId) => {
  let contador = document.getElementById(`contador-${productId}`);
  contador.innerHTML = parseInt(contador.innerHTML) + 1;
  cantidad = parseInt(contador.innerHTML);

  //Habilitar el botón de agregar al carrito
  if (cantidad > 0) {
    document.getElementById(`agregar-${productId}`).disabled = false;
  }
};

const restar = (productId) => {
  let contador = document.getElementById(`contador-${productId}`);
  if (parseInt(contador.innerHTML) > 0) {
    contador.innerHTML = parseInt(contador.innerHTML) - 1;
    cantidad = parseInt(contador.innerHTML);
  }

  //Deshabilitar el botón de agregar al carrito
  if (cantidad === 0) {
    document.getElementById(`agregar-${productId}`).disabled = true;
  }
};


// Función para agregar al carrito
const agregarAlCarrito = (productId) => {

  // Obtener productos del carrito almacenados en el Local Storage
  const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

  // Verificar si el producto ya está en el carrito
  const productoEnCarrito = carrito.find(
    (item) => item.ProductoID === productId
  );

  if (productoEnCarrito) {
    // Si ya está en el carrito, incrementar la cantidad
    productoEnCarrito.quantity += cantidad;
  } else {
    // Si no está en el carrito, agregar nuevo item con la cantidad del contador
    carrito.push({ productId, quantity: cantidad });
  }

  localStorage.setItem("carrito", JSON.stringify(carrito));

  cantidad = parseInt(document.getElementById(`contador-${productId}`).innerHTML) === 0;

  // Mostrar alerta
  alert("Producto agregado al carrito");

  window.location.reload();
};

//Carrito
// Función para obtener la información de los productos del carrito desde el API
const obtenerProductosCarrito = async (items) => {
  const apiUrl = "producto.php";

  try {
    const response = await fetch(apiUrl);

    if (!response.ok) {
      throw new Error(`Error en la solicitud: ${response.status}`);
    }

    const data = await response.json();

    // Filtrar productos según los IDs del carrito
    const productosCarrito = data
      .map((producto) => {
        const item = items.find((item) => item.productId === parseInt(producto.ProductoID, 10)) || {
          quantity: 0,
        };
        return { ...producto, ...item };
      })
      .filter((producto) => producto.quantity >= 1);

    // Renderizar los productos en la interfaz
    renderizarProductosCarrito(productosCarrito);
  } catch (error) {
    console.error("Error en la solicitud:", error);
  }
};

// Función para renderizar los productos del carrito en la interfaz
let cantidadCarrito = 1;
const renderizarProductosCarrito = (productos) => {
  let body = "";
  for (let i = 0; i < productos.length; i++) {
    cantidadCarrito = productos[i].quantity; /* <i class="fa-solid fa-check"></i> */
    body += `
            
    <tr>
      <td>
        <div style="display: flex; margin-bottom: 1rem; gap: .5rem">
          <button onclick="restarCarrito(${productos[i].ProductoID})" style="border: none; width: 3rem; height: 2rem; display: flex; align-items: center; justify-content: center">-</button>
          <span id="contadorCarrito-${productos[i].ProductoID}">${cantidadCarrito}</span>
          <button onclick="sumarCarrito(${productos[i].ProductoID})" style="border: none; width: 3rem; height: 2rem; display: flex; align-items: center; justify-content: center">+</button>
          <button id="actualizar-${productos[i].ProductoID}" onclick="actualizar(${productos[i].ProductoID})"  style="border: none; width: auto; height: 2rem; display: flex; align-items: center; justify-content: center; background: white; color:green" class="d-none">
          <i class="fa-solid fa-check"></i>
        </button>
        </div>
      </td>
      <td>${productos[i].Nombre}</td>
      <td>L. ${(productos[i].Precio * productos[i].quantity).toFixed(2)}</td>
      <td>
        <button onclick="eliminar(${productos[i].ProductoID})" style="border: none; width: auto; height: 3rem; display: flex; align-items: center; justify-content: center; background: white; color:red">
          <i class="fa-solid fa-trash"></i>
        </button>
      </td>
    </tr>`;
  }

  let total = 0;
  for (let i = 0; i < productos.length; i++) {
    total = total + productos[i].Precio * productos[i].quantity;
  }
  document.getElementById("order-total").innerHTML = `L. ${total.toFixed(2)}`;
  document.getElementById("order-table").innerHTML = body;
};

/* Contador para la cantidad de productos del carrito*/
const sumarCarrito = (productId) => {
  let contador = document.getElementById(`contadorCarrito-${productId}`);
  contador.innerHTML = parseInt(contador.innerHTML) + 1;
  cantidadCarrito = parseInt(contador.innerHTML);

    //Habilitar el botón de actualizar
    document.getElementById(`actualizar-${productId}`).classList.remove("d-none");
};

const restarCarrito = (productId) => {
  let contador = document.getElementById(`contadorCarrito-${productId}`);
  if (parseInt(contador.innerHTML) > 1) {
    contador.innerHTML = parseInt(contador.innerHTML) - 1;
    cantidadCarrito = parseInt(contador.innerHTML);

    //Habilitar el botón de actualizar
    document.getElementById(`actualizar-${productId}`).classList.remove("d-none");
  }
};

// Función para actualizar un producto del carrito
const actualizar = (productId) => {
    let contador = document.getElementById(`contadorCarrito-${productId}`);
    cantidadCarrito = parseInt(contador.innerHTML);
    document.getElementById(`actualizar-${productId}`).classList.add("d-none");
    
    // Obtener productos del carrito almacenados en el Local Storage
    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    
    // Actualizar la cantidad del producto en el carrito
    const productoEnCarrito = carrito.find(
        (item) => item.productId === productId
    );
    productoEnCarrito.quantity = cantidadCarrito;
    
    localStorage.setItem("carrito", JSON.stringify(carrito));
    
    // Mostrar alerta
    alert("Producto actualizado");
    showOrder();
}

// Función para eliminar un producto del carrito
const eliminar = (productId) => {
  const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
  const nuevoCarrito = carrito.filter((item) => item.productId !== productId);
  localStorage.setItem("carrito", JSON.stringify(nuevoCarrito));
  obtenerProductosCarrito(nuevoCarrito);

  // Mostrar alerta
  alert("Producto eliminado");
};

async function showOrder() {
  // Obtener productos del carrito almacenados en el Local Storage
  const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
  obtenerProductosCarrito(carrito);

  document.getElementById("all-products").style.display = "none";
  document.getElementById("order").style.display = "block";
}






// --------------------------------------------
const mercadopago = new MercadoPago('TEST-c6353c13-c841-473d-8dd6-bf56114341c3', {
  locale: 'es-HN' 
});

let productList = [];

let order = {
  total: 0,
  items: [],
};

function add(productId, price) {
  const product = productList.find((p) => p.id === productId);
  product.stock--;

  const productInOrder = order.items.find((p) => p.id === productId);
  if (productInOrder) {
    productInOrder.quantity = productInOrder.quantity + 1;
  }
  else {
    order.items.push({
      id: product.id,
      name: product.name,
      price: product.price,
      quantity: 1,
    });
  }

  console.log(productId, price);

  order.total = order.total + price;
  document.getElementById("checkout").innerHTML = `Carrito $${order.total}`;
  displayProducts();
}

/* async function showOrder() {
  document.getElementById("all-products").style.display = "none";
  document.getElementById("order").style.display = "block";

  document.getElementById("order-total").innerHTML = `$${order.total}`;

  let productsHTML = `
    <tr>
        <th>Cantidad</th>
        <th>Detalle</th>
        <th>Subtotal</th>
    </tr>`;
  order.items.forEach((p) => {
    productsHTML += `<tr>
            <td>${p.quantity}</td>
            <td>${p.name}</td>
            <td>$${p.price * p.quantity}</td>
        </tr>`;
  });
  document.getElementById("order-table").innerHTML = productsHTML;
} */

async function pay() {
  try {
    order.shipping = {
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      phone: document.getElementById("phone").value,
      addressLine1: document.getElementById("addressLine1").value,
      addressLine2: document.getElementById("addressLine2").value,
      city: document.getElementById("city").value,
      postalCode: document.getElementById("postalCode").value,
      state: document.getElementById("state").value,
      country: document.getElementById("country").value,
    };

    const preference = await (
      await fetch("/api/pay", {
        method: "post",
        body: JSON.stringify(order),
        headers: {
          "Content-Type": "application/json",
        },
      })
    ).json();

    const bricksBuilder = mercadopago.bricks();
    document.getElementById("order-actions").innerHTML = "";

    const renderComponent = async (bricksBuilder) => {
      if (window.checkoutButton) window.checkoutButton.unmount();
      await bricksBuilder.create(
        'wallet',
        'order-actions',
        {
          initialization: {
            preferenceId: preference.preferenceId
          },
          callbacks: {
            onError: (error) => console.error(error),
            onReady: () => {}
          }
        }
      );
    };
    window.checkoutButton =  renderComponent(bricksBuilder);

    document.getElementById("name").disabled = true;
    document.getElementById("email").disabled = true;
    document.getElementById("phone").disabled = true;
    document.getElementById("addressLine1").disabled = true;
    document.getElementById("addressLine2").disabled = true;
    document.getElementById("city").disabled = true;
    document.getElementById("postalCode").disabled = true;
    document.getElementById("state").disabled = true;
    document.getElementById("country").disabled = true;
  } catch {
    window.alert("Sin stock");
  }

  order = {
    total: 0,
    items: [],
  };
  document.getElementById("checkout").innerHTML = `Carrito $${order.total}`;
}

//-----
function displayProducts() {
  document.getElementById("all-products").style.display = "block";
  document.getElementById("order").style.display = "none";

  const gym = productList.filter((p) => p.category === "gym");
  displayProductsByType(gym, "product-cards-gym");

  const car = productList.filter((p) => p.category === "car");
  displayProductsByType(car, "product-cards-car");

  const pc = productList.filter((p) => p.category === "pc");
  displayProductsByType(pc, "product-cards-pc");
}

function displayProductsByType(productsByType, tagId) {
  let productsHTML = "";
  productsByType.forEach((p) => {
    let buttonHTML = `<button class="button-add" onclick="add(${p.id}, ${p.price})">Agregar</button>`;

    if (p.stock <= 0) {
      buttonHTML = `<button disabled class="button-add disabled" onclick="add(${p.id}, ${p.price})">Sin stock</button>`;
    }

    productsHTML += `<div class="product-container">
            <h3>${p.name}</h3>
            <img src="${p.image}" />
            <h1>$${p.price}</h1>
            ${buttonHTML}
        </div>`;
  });
  document.getElementById(tagId).innerHTML = productsHTML;
}

async function fetchProducts() {
  productList = await (await fetch("/api/products")).json();
  displayProducts();
}

window.onload = async () => {
  await fetchProducts();
};
