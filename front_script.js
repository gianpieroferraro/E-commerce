
	//FORM LOGIN - REGISTR
	const container = document.querySelector(".containForm"),
		pwShowHide = document.querySelectorAll(".showHidePw"),
		pwFields = document.querySelectorAll(".password");
	const register = document.querySelector(".reg_link")
	const log = document.querySelector(".log_link")

	pwShowHide.forEach(eyeIcon =>{
		eyeIcon.addEventListener("click", function() {
			pwFields.forEach(pwField =>{
				if(pwField.type === "password") {
					pwField.type = "text"
					
					pwShowHide.forEach(icon =>{
						icon.classList.replace("uil-eye-slash", "uil-eye")
					})
				}else {
					pwField.type = "password"
					
					pwShowHide.forEach(icon =>{
						icon.classList.replace("uil-eye", "uil-eye-slash")
					})
				}
			})
		})
	}) 

	/*

	function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		let expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

	}
	function getCookie(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i <ca.length; i++) {
		  let c = ca[i];
		  while (c.charAt(0) == ' ') {
			c = c.substring(1);
		  }
		  if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		  }
		}
		return "";
	}
	*/
	
	let cart = document.querySelectorAll(".prod_bask")
	let art_det_cart = document.querySelectorAll(".add_bask")
	//let qty = document.querySelector(".quantity")


	for (let i=0; i < cart.length; i++) { 
		cart[i].addEventListener("click", add_to_cart)
		cart[i].addEventListener("click", iconcart)

	}

	for (let t=0; t < art_det_cart.length; t++) { 
		art_det_cart[t].addEventListener("click", add_to_cart)

	}


	//funzione aggiunta icona al carrello quando si agg un articolo
	function iconcart() {
		console.log("ciao")
		document.querySelector(".circle").classList.remove("hidden")
	}



	//funzione per aggiungere articoli al carrello
	function add_to_cart() {
		product_to_add = this.dataset.product;

		let qty = document.querySelector("#id_" + product_to_add)

		let carr_attuale = getCookie('carrello')

		
		if(carr_attuale == '') {
			carr_attuale = product_to_add + ":" + qty.value
		} else  {
			carr_attuale += ',' + product_to_add + ":" + qty.value
		}

		setCookie("carrello", carr_attuale, 7)

		document.querySelector(".alert").classList.remove("hidden")
		let tID = setTimeout(function() {
			document.querySelector(".alert").classList.add("hidden")
			window.clearTimeout(tID)
		},2000)

		alert("Articolo aggiunto al carrello")
	}




	let imgs = document.querySelectorAll(".imgs")

	for (let i = 0; i < imgs.length; i++) {
		imgs[i].addEventListener("click", function() {
			document.querySelector(".prod_img_container img").src = this.querySelector("img").src
			document.querySelector(".img_descr p").innerHTML = this.querySelector("h2").dataset.title
		})
	}




	
//numerazione articoli carrello:
	let cart_select = document.querySelectorAll(".num_art")

	for(let i =0; i<cart_select.length; i++) {
		cart_select[i].addEventListener("change", function() {
			
			parent = this.parentElement;
			original_price = parent.querySelector(".price").dataset.price	
			original_price_value = parseFloat(original_price)

			if(parent.querySelector(".sconto")) {
				original_price = parent.querySelector(".price").dataset.price	
				original_price_value = parseFloat(original_price)

				original_sconto = parent.querySelector(".sconto").dataset.sconto
				console.log(original_sconto)

				new_price = Math.round(original_price_value * this.value).toFixed(2)
				new_price = parseInt(parseFloat(new_price).toFixed(2))

				new_sconto =  parseInt(parseFloat(original_sconto * this.value).toFixed(2))
				//console.log(new_sconto)
				
				parent.querySelector(".price .normal_price").innerHTML =  new_price
				parent.querySelector(".price .sconto").innerHTML =  new_sconto
				parent.querySelector(".price").dataset.change = new_sconto
			} else {
				original_price = parent.querySelector(".price").dataset.price	
				original_price_value = parseFloat(original_price)
				console.log(original_price)

				original_sconto = document.querySelector(".sconto").dataset.sconto
				new_sconto = parseInt(original_sconto * this.value)
				//console.log(typeof(new_sconto))

				new_price = Math.round(original_price_value * this.value).toFixed(2)
				new_price = parseInt(parseFloat(new_price).toFixed(2))
				console.log("nuovo prezzo: " + new_price)

				parent.querySelector(".price").innerHTML =  "<b>" + new_price + " € <b>"
				parent.querySelector(".price").dataset.change = new_price
				
			}

			prices = document.querySelectorAll(".price")
			total = 0;
			for(let i=0; i<prices.length; i++) {
				prezzi = prices[i].dataset.change
				//console.log(prezzi)
				prezzi = parseFloat(prezzi)
				
				total += prezzi
				//console.log(prices[i].dataset.change)
			}
			//console.log(total)
			document.querySelector(".tot").innerHTML = total + " €"
		})

	}	




	//cancellazzione articoli dal carrello
	
	let delete_art = document.querySelectorAll("#cart_delete")

	for(let i=0; i<delete_art.length; i++) {
		delete_art[i].addEventListener("click", function() {

			art_to_remove = this.dataset.id + ":" + this.dataset.num
			console.log("art da rimuovere: " + art_to_remove)

			var carr_attuale = getCookie('carrello')
			carr_attuale = carr_attuale.split(",")
			console.log("carrello attuale: " + carr_attuale)

			var ind = carr_attuale.indexOf(art_to_remove)
			console.log("IND: " + ind)

			carr_attuale.splice(ind, 1)
			console.log(carr_attuale)

			setCookie("carrello", carr_attuale, 7);
			window.location.href = "/shop/carrello.php"
		})
	}

	