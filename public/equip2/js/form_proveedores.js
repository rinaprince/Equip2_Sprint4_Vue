document.addEventListener("DOMContentLoaded", function () {
  // Creación de objetos para encapsular la información
  // Provider contiene los inputs de cada campo
  let provider = {
    email:document.getElementById("email"),
    dni:document.getElementById("dni"),
    phone:document.getElementById("phone"),
    cif:document.getElementById("cif"),
    address:document.getElementById("address"),
    nif:document.getElementById("managerNIF")
  }

  // Errors contiene el parágrafo donde se mostrá cada uno de los errores de cada input 
  let errors = {
    address:document.querySelector("#ErrorAddress>p"),
    dni:document.querySelector("#ErrorDNI>p"),
    phone:document.querySelector("#ErrorPhone>p"),
    email:document.querySelector("#ErrorEmail>p"),
    cif:document.querySelector("#ErrorCIF>p"),
    nif:document.querySelector("#ErrorManagerNIF>p"),
    aplicarEstilo: function(inputElement) {
                      inputElement.style.borderColor = 'red';
                   },
    borrarEstilo:  function (inputElement) {
                      inputElement.style.borderColor = '';
                   }
  }
  // Obtener todos los inputs en una colección de elementos
  let todosInputs = document.querySelectorAll("input");


  // Llamamos a las funciones de validar cuando se interactúa con los campos
  provider.email.addEventListener("input", validarEmail);
  provider.address.addEventListener("input", validarDomicilio);
  provider.dni.addEventListener("input", validarDNI);
  provider.phone.addEventListener("input", validarTelefono);
  provider.cif.addEventListener("input", validarCIF);
  provider.nif.addEventListener("input", validarNIFGerente);

  // Agregar eventos "blur" para validar cuando se pierde el foco
  provider.address.addEventListener("blur", validarDomicilio);
  provider.dni.addEventListener("blur", validarDNI);
  provider.phone.addEventListener("blur", validarTelefono);
  provider.email.addEventListener("blur", validarEmail);
  provider.cif.addEventListener("blur", validarCIF);
  provider.nif.addEventListener("blur", validarNIFGerente);

  document.getElementById("delete").addEventListener("click", function () {
    // Elimina el objeto para que no se vuelvan a llenar los inputs
    localStorage.removeItem("formData");
  });

  /**Botón de enviar
  document.getElementById("send").addEventListener("click", function (event) {
    event.preventDefault(); // Evita que el formulario se envíe si hay errores

    // Verifica no haya inputs vacíos o con errores
    let todosLosCamposValidos = Array.from(todosInputs).every(function (input) {
      return input.value.trim() !== "" && !input.style.borderColor;
    });

    if (todosLosCamposValidos) {
      // Guardar datos automáticamente al enviar el formulario
      guardarDatosFormularioEnLocalStorage();
      //alert("Formulario enviado correctamente");
      // Aquí puedes agregar código para enviar el formulario
    } else {
      //alert("Por favor, complete todos los campos correctamente");
    }
  });
      */

  /**Botón aceptar cookies
  document.getElementById("botonCookies").addEventListener("click", eliminaDivCookies);
  //Eliminamos el div con el mensaje de las cookies cuando el usuario pulsa el botón de aceptar
  function eliminaDivCookies(){
    document.getElementById("divCookies").remove();
   
  }

  //Eliminamos la cookie si el usuario rechaza du uso 
  document.getElementById("botonRechazarCookies").addEventListener("click", function(){
    //Establecemos una fecha de caducidad en el pasado para que se considere caducada y se elimine
    document.cookie = 'visitas=1; expires=Fri, 31 Dec 1999 23:59:59 GMT; path=/;';
    divCookies.remove();
  })



  // Cargar automáticamente los datos almacenados al cargar la página
  cargarDatosFormularioDesdeLocalStorage();



  // Función cookies
  // Verificar si la cookie 'visitas' ya existe
  if (document.cookie.indexOf('visitas=') === -1) {
    // Si no existe, crearla y establecer su valor en 1
    document.cookie = 'visitas=1';
  } else {
    // Si la cookie ya existe, obtiene su valor y lo convierte a un número
    const visitas = parseInt(getCookie('visitas'));

    // Incrementar el valor en 1
    document.cookie = 'visitas=' + (visitas + 1);
  }

  // Función para obtener el valor de una cookie por su nombre
  function getCookie(nombre) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      if (cookie.startsWith(nombre + '=')) {
        return cookie.substring(nombre.length + 1);
      }
    }
    return '';
  }
   */

  // Validaciones

  function validarDomicilio() {
    if (provider.address.value.length === 0) {
      errors.aplicarEstilo(provider.address);
      errors.address.textContent = "Error: Este campo es necesario";
    } else {
      errors.borrarEstilo(provider.address);
      errors.address.textContent = "";
    }
  }
  

  function validarDNI() {
    let DNIPattern = /^[0-9]{8}[A-Z]{1}$/;

    if (provider.dni.value.length === 0) {
      errors.aplicarEstilo(provider.dni);
      errors.dni.textContent = "Error: Este campo es necesario";
    } else if (!DNIPattern.test(provider.dni.value)) {
      errors.aplicarEstilo(provider.dni);
      errors.dni.textContent = "Error: DNI no válido. El formato es: 12345678A";
    } else {
      errors.borrarEstilo(provider.dni);
      errors.dni.textContent = "";
    }
  }

  function validarTelefono() {

    if (provider.phone.value.length === 0) {
      errors.aplicarEstilo(provider.phone);
      errors.phone.textContent = "Error: Este campo es necesario";
    } else if (!/^\d{9}$/.test(provider.phone.value)) {
      errors.aplicarEstilo(provider.phone);
      errors.phone.textContent = "Error: Debe tener 9 dígitos. El formato es: 555555555";
    } else {
      errors.borrarEstilo(provider.phone);
      errors.phone.textContent = "";
    }
  }

  function validarEmail() {
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (provider.email.value.length === 0) {
      errors.aplicarEstilo(provider.email);
      errors.email.textContent = "Error: Este campo es necesario";
    } else if (!emailPattern.test(provider.email.value)) {
      errors.aplicarEstilo(provider.email);
      errors.email.textContent = "Error: Email no válido";
    } else {
      errors.borrarEstilo(provider.email);
      errors.email.textContent = "";
    }
  }

  function validarCIF() {
    let CIFPattern = /^[A-Z]{1}[0-9]{8}/;

    if (provider.cif.value.length === 0) {
      errors.aplicarEstilo(provider.cif);
      errors.cif.textContent = "Error: Este campo es necesario";
    } else if (!CIFPattern.test(provider.cif.value)) {
      errors.aplicarEstilo(provider.cif);
      errors.cif.textContent = "Error: CIF no válido";
    } else {
      errors.borrarEstilo(provider.cif);
      errors.cif.textContent = "";
    }
  }

  function validarNIFGerente() {
    let NIFPattern = /^[0-9]{8}[A-Z]{1}$/;

    if (provider.nif.value.length === 0) {
      errors.aplicarEstilo(provider.nif);
      errors.nif.textContent = "Error: Este campo es necesario";
    } else if (!NIFPattern.test(provider.nif.value)) {
      errors.aplicarEstilo(provider.nif);
      errors.nif.textContent = "Error: NIF del gerente no válido";
    } else {
      errors.borrarEstilo(provider.nif);
      errors.nif.textContent = "";
    }
  }

  function guardarDatosFormularioEnLocalStorage() {

    // Guardar los datos en un objeto
    let formData = {
      domicilio: provider.address.value,
      DNI: provider.dni.value,
      tel: provider.phone.value,
      email: provider.email.value,
      CIF: provider.cif.value,
      NIFGerente: provider.nif.value
    };

    // Convertir el objeto a una cadena JSON
    let formDataJSON = JSON.stringify(formData);

    // Almacenar la cadena JSON en el almacenamiento local
    localStorage.setItem("formData", formDataJSON);
  }

  function cargarDatosFormularioDesdeLocalStorage() {
    // Obtener la cadena JSON almacenada en el almacenamiento local
    let formDataJSON = localStorage.getItem("formData");

    if (formDataJSON) {
      // Parsear la cadena JSON a un objeto
      let formData = JSON.parse(formDataJSON);

      // Llenar los campos del formulario con los datos cargados
      provider.address.value = formData.domicilio;
      provider.dni.value = formData.DNI;
      provider.phone.value = formData.tel;
      provider.email.value = formData.email;
      provider.cif.value = formData.CIF;
      provider.nif.value = formData.NIFGerente;
    }
  }

  /**
  function generarDNIAleatorio() {
      // Generar 8 números aleatorios entre 0 y 9
      const numerosAleatorios = Array.from({ length: 8 }, () => Math.floor(Math.random() * 10)).join('');
    
      // Generar una letra mayúscula aleatoria
      const letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      const letraAleatoria = letras.charAt(Math.floor(Math.random() * letras.length));
    
      // Combinar los números y la letra aleatoria para formar el DNI
      const dniAleatorio = numerosAleatorios + letraAleatoria;
    
      // Establecer el DNI aleatorio generado en el campo de entrada DNI
      provider.dni.value = dniAleatorio;
  }
      */


  
});




