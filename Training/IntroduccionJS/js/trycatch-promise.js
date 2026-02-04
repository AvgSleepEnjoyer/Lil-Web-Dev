const num1=3
const num2=5

console.log(num1);
try {
    console.log(num45);
} catch (error) {
    console.log(error);
}
console.log(num2);

/////////////////////////

const usuarioAutenticado = new Promise ( (resolve, reject) => {
    const auth = true

    if (auth) {
        resolve("Usuario autenticado");
    }else{
        reject("Usuario no autenticado");
    }
})
                                    //Imprime si el usuario fue autenticado, funcion de los promises
usuarioAutenticado
    .then( function(resultado){
        console.log(resultado);
    })
    .catch(function(error){
        console.log(error);
    })

