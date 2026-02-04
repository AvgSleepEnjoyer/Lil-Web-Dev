// Async no frena el codigo, solamente la terea encargada

function descargarNuevosClientes(){
    return new Promise(resolve => {
        console.log("descargando clientes, espere");

        setInterval(() => {
            resolve("Los clientes fueron descargados")
        }, 2000);
        
    })
}

function descargarUltimosPedidos(){
    return new Promise(resolve => {
        console.log("descargando pedidos, espere");

        setInterval(() => {
            resolve("Los pedidos fueron descargados")
        }, 3000);
        
    })
}

// setTimeout(() => {                  //Set interval
//     console.log("set timeout");
// }, 5000);

async function app(){
    try {
        // const clientes = await descargarNuevosClientes()
        // const pedidos = await descargarUltimosPedidos()
        // console.log(clientes);
        // console.log(pedidos);

        const resultado = await Promise.all([descargarNuevosClientes(), descargarUltimosPedidos()])
        console.log(resultado);

        mostrarClientes()

    } catch (error) {
        console.log(error);
    }
}

app()

