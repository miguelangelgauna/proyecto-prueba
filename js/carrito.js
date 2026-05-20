document.addEventListener('DOMContentLoaded', () =>{




let carrito=[];

document.querySelectorAll(".agregar").forEach(boton=>{
    boton.addEventListener('click',()=>{
        let id = boton.dataset.id;
        let nombre = boton.dataset.nombre;
        let descripcion = boton.dataset.descripcion; 
        let precio = boton.dataset.precio; 
        agregarAlCarrito(id,nombre,descripcion,precio);

    });
});



function agregarAlCarrito(id, nombre, descripcion, precio){
    let producto= carrito.find(item=>item.id===id);
    if (producto){
        producto.cantidad++;
    }else{
        carrito.push ({id, nombre, descripcion, precio, cantidad:1});
 
    }
    actualizarCarrito();

    alertify.success('Agregado al Carrito :)');


    // console.log (carrito);

}
function actualizarCarrito(){
    let contenidoCarrito='';
    let total=0;



    carrito.forEach(producto=>{ 
        contenidoCarrito += `
         <div>${producto.nombre} x ${producto.cantidad} = ${parseFloat(producto.precio) * parseFloat(producto.cantidad)} </div>
        `;

        total += parseFloat(producto.precio) * parseFloat(producto.cantidad);
    })

    contenidoCarrito += `<div>total: $${total}</div>`;
    document.getElementById ('contenido-carrito').innerHTML = contenidoCarrito;
}


document.getElementById('procesar-compra').addEventListener('click' , function(){
    localStorage.setItem('carrito', JSON.stringify(carrito));
    window.location.href = "/tienda/modulos/ventas/procesar-compra.php";
})






});