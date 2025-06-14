function ChangeView() {
    var SignUpBox = document.getElementById("SignUpBox");
    var SignInBox = document.getElementById("SignInBox");

    SignUpBox.classList.toggle("d-none");
    SignInBox.classList.toggle("d-none");

}

function signUp() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var pw = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var f = new FormData();

    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", pw.value);
    f.append("mobile", mobile.value);
    f.append("gender", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText
            if (t == "success") {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
                window.location.reload();


            } else {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";

            }
        }
    }

    r.open("POST", "SignupProcess.php", true);
    r.send(f)

}

function signin() {

    var ea = document.getElementById("email1");
    var pw = document.getElementById("password1");
    var rm = document.getElementById("rememberMe");

    var f = new FormData();

    f.append("email", ea.value);
    f.append("password", pw.value);
    f.append("rememberMe", rm.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            t = r.responseText
            if (t == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("msgdiv2").className = "d-block";
                //alert(t);
            }
        }
    }

    r.open("POST", "SigngnInProcess.php", true);
    r.send(f);

}

function signout() {


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                window.location.reload();

            } else {
                alert(t);
            }


        }
    }

    r.open("GET", "signoutprocess.php", true);
    r.send();

}

var bm;
function forgotPassword() {

   // alert ("OK");

    var email = document.getElementById("email1");
    //alert(email.value);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                swal(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function resetPassword() {

    var email1 = document.getElementById("email1");
    var np = document.getElementById("Upp");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email1.value);
    f.append("np", np.value);
    f.append("rnp", rnp.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                bm.hide();
                swal("Your password has been updated!","","success");
                //window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);

}

function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        rnp.type = "password";
        rnpb.innerHTML = '<i class="bi bi-eye"></i>';
    }

}

function showPassword3() {
    var Upp = document.getElementById("Upp");
    var Uppb = document.getElementById("Uppb");

    if (Upp.type == "password") {
        Upp.type = "text";
        Uppb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        Upp.type = "password";
        Uppb.innerHTML = '<i class="bi bi-eye"></i>';
    }
}

function updateProfile() {

    var profile_img = document.getElementById("profileImage");
    var first_name = document.getElementById("fname");
    var last_name = document.getElementById("lname");
    var email_address = document.getElementById("email");
    var password = document.getElementById("Upp");

    var address_line_1 = document.getElementById("line1");
    var address_line_2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var postal_code = document.getElementById("pc");
    var mobile_no = document.getElementById("mobile");

    var f = new FormData();
    f.append("img", profile_img.files[0]);
    f.append("fn", first_name.value);
    f.append("ln", last_name.value);
    f.append("ea", email_address.value);
    f.append("pw", password.value);

    f.append("al1", address_line_1.value);
    f.append("al2", address_line_2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", postal_code.value);
    f.append("mn", mobile_no.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                signout();
                 window.location = "home.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "userProfileUpdateProcess.php", true);
    r.send(f);

}

function loadBrands() {
    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;

        }
    }

    r.open("GET", "loadBrandProcess.php?c=" + category, true);
    r.send();
}

function loadModel() {
    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("model").innerHTML = t;

        }
    }

    r.open("GET", "loadModelProcess.php?c=" + brand, true);
    r.send();
}

function updateclr() {

    var color = document.getElementById("clr");

    var f = new FormData();
    f.append("color", color.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t =="select color from the list"){
                swal("Color is already in the list.Select color");
            }else if(t =="Color Successfully added. select from the list"){
                swal("Color Successfully added. select from the list");
            }else{
                alert (t);
            }

            //alert(t);

        }
    }
    r.open("POST", "addColor.php", true);
    r.send(f);

}

function changeProductImage() {

    var images = document.getElementById("imageuploader");

    images.onchange = function () {

        var file_count = images.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }
        } else {
            alert(file_count + "file uploaded. You are proceed upload 3 or less than 3 files.");
        }
    }
}

function addProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }
    var clr = document.getElementById("color");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var dfi = document.getElementById("dfi");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("con", condition);
    f.append("clr", clr.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    f.append("dfi", dfi.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product Added Succesfully") {
                swal("Product Added successfully!","","success");
                Window.location.reload();
            } else {
                
                document.getElementById("msg1").innerHTML = t;
                document.getElementById("msgdiv1").className = "d-block";
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function qty_inc(qty) {

    var input = document.getElementById("qty_input");

    if (input.value < qty) {

        var new_value = parseInt(input.value) + 1;
        input.value = new_value;

    } else {
        alert("you have reach to the maximum");
        input.value = qty;

    }
}

function qty_dec() {

    var input = document.getElementById("qty_input");

    if (input.value > 1) {

        var new_value = parseInt(input.value) - 1;
        input.value = new_value;

    } else {
        alert("you have reach to the minimum");
        input.value = 1;

    }
}

function check_value(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 1) {
        alert("You must add one or more");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficient quantity");
        input.value = qty;
    }
}

function changeMainImage(id) {

    var new_img = document.getElementById("product_img" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + new_img + ")";
}

function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText

            if (t == "This product Already exist in the cart") {
                swal("This product Already exist in the cart","Go To cart and Check list!","warning");
            } else if (t == "Product Added") {
                swal("Product Added to cart Successfully", "Go To cart and Check list!", "success");
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function removeFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert("t");
            }
        }
    }

    r.open("GET", "removeFromcartProcess.php?id=" + id, true);
    r.send();
}

function basicSearch(x) {
    var txt = document.getElementById("basic_search_txt");
    var select = document.getElementById("basic_search_select");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("s", select.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchresults").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);

}

function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var condition = document.getElementById("condition");
    var color = document.getElementById("color");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("mo", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("pt", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}

function sort(x) {

    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("sort").innerHTML = t;

        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function clearSort() {
    window.location.reload();
}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}

function changeStatus(id) {
    var product_id = id;

    var r = new XMLHttpRequest(); {
        if (r.status == 200 && r.readyState == 4) {

            var t = r.responseText;
            if (t == "Activated" || t == "Deactivated") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.send("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.open();
}

function updateProduct() {

    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var dfi = document.getElementById("dfi");
    var dwc = document.getElementById("dwc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dfi", dfi.value);
    f.append("dwc", dwc.value);
    f.append("d", description.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("1" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadyStatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "myProducts.php";
            } else if (t == "Invalid Image count") {

                if (confirm("Don't you want to update product images?") == true) {
                    window.location = "my Products.php";
                } else {
                    alert("Select images");
                }
            } else {
                alert(t);
            }

        }

    }


    r.open("POST", "updateproductProcess.php", true);
    r.send(f);


}

function addTowatchlist(id) {

    var r = new XMLHttpRequest

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText
            if (t == "Added") {
                swal("Product added to the watch list successfully","Go to WatchList","success");
                window.location.reload;
            } else if (t == "Removed") {

                swal("Product removed from the watch list successfully","Go to WatchList","warning");
                window.location.reload;
            } else {
                alert(t);
            }
        }

    }


    r.open("GET", "addWatchListProcess.php?id=" + id, true);
    r.send();
}

function removefromwatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert("t");
            }
        }
    }

    r.open("GET", "removeFromWatchListProcess.php?id=" + id, true);
    r.send();
}

var cam;
function contactAdmin(email) {
    var m = document.getElementById("contactAdmin");
    cam = new bootstrap.Modal(m);
    cam.show();
}


function sendAdminMsg(email) {

    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("r", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "sendAdminMessageProcess.php", true);
    r.send(f);
}

function ChangeView1() {

    var Recieved = document.getElementById("recievedbox");
    var Sent = document.getElementById("sentbox");

    Recieved.classList.toggle("d-none");
    Sent.classList.toggle("d-none");

}

function login1() {

    var ea = document.getElementById("email2");
    var pw = document.getElementById("pasw1");


    var f = new FormData();

    f.append("email2", ea.value);
    f.append("pasw1", pw.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            t = r.responseText
            if (t == "success") {

                var m = document.getElementById("AdminVerificationModel");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminSigninprocess.php", true);
    r.send(f);


}

function blockUser(email) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
            } else if (txt == "unblocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn btn-danger";
            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "userBlockProcess.php?email=" + email, true);
    request.send();

}

function sendAdminMsg(email) {

    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("r", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "sendAdminMessageProcess.php", true);
    r.send(f);
}

var ram;
function contactUser(email) {
    var s = document.getElementById("contactUser");
    ram = new bootstrap.Modal(s);
    ram.show();
}




var cat;
function addNewCategory() {
    var c = document.getElementById("addNewCategory");
    cat = new bootstrap.Modal(c);
    cat.show();
}

function saveCategory() {

    var n = document.getElementById("n").value;
    var e = document.getElementById("e").value;

    var f = new FormData();

    f.append("n", n);
    f.append("e", e);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Success") {
                //vc.hide();
                swal("category Added successfully!","","success");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "SaveCategoryProcess.php", true);
    r.send(f);
}

function payNow(id){
    
    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.status == 200 && r.readyState==4){
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if(t == 1){
                alert ("Please login.");
                window.location = "index.php";
            }else if(t == 2){
                alert ("Please Update your profile");
                window.location = "userProfile.php";
            }else{
                // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);

        saveInvoice(orderId,id,mail,amount,qty);

        // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "0000000",    // Replace your Merchant ID
        "return_url": "http://localhost/tradewave/singleproductview.php?id=" + id,     // Important
        "cancel_url": "http://localhost/tradewave/singleproductview.php?id=" + id,     // Important
        "notify_url": "http://sample.com/notify",
        "order_id": obj["id"],
        "items": obj["item"],
        "amount": amount,
        "currency": "LKR",
        "hash": obj["hash"],
        "first_name": obj["fname"],
        "last_name": obj["lname"],
        "email": mail,
        "phone": obj["mobile"],
        "address": obj["address"],
        "city": obj["city"],
        "country": "Sri Lanka",
        "delivery_address": obj["address"],
        "delivery_city": obj["city"],
        "delivery_country": "Sri Lanka",
        "custom_1": "",
        "custom_2": ""
    };

    // Show the payhere.js popup, when "PayHere Pay" is clicked
    // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
    // };
            }
        }
    }

    r.open("GET","payNowProcess.php?id="+id+"&qty="+qty,true);
    r.send();
}

function saveInvoice(orderId,id,mail,amount,qty){

    var f = new FormData();
    f.append("o",orderId);
    f.append("i",id);
    f.append("m",mail);
    f.append("a",amount);
    f.append("q",qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){

                window.location = "invoice.php?id="+orderId;

            }else{
                alert (t);
            }
        }
    }

    r.open("POST","saveInvoice.php",true);
    r.send(f);

}

function verifycode() {

    var email1 = document.getElementById("email2");
    var vc = document.getElementById("vc");

    var f = new FormData();

    f.append("e", email1.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                bm.hide();
                
                window.location = "dashboard.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);



}

/*function checkout(){
    //alert ("OK");

    var f = new FormData();
    f.append("cart",true);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var responce = request.responseText;
             alert(responce);
            var payment = JSON.parse(responce);
           // doCheckout(payment, "checkoutProcess.php");
        }
    }

    request.open("POST","Cartpayment.php",true);
    request.send(f);
}*/

function printinvoice(){
      // alert("OK");
  var originalContent = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;

  document.body.innerHTML = page;

  window.print();

  document.body.innerHTML = originalContent;

}

function checkout(){
    
   // alert ("OK");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.status == 200 && r.readyState==4){
            var t = r.responseText;
           // alert (t);
            var obj = JSON.parse(t);
            
            
            var mail = obj["umail"];
            var amount = obj["amount"];

            if(t == 1){
                alert ("Please login.");
                window.location = "index.php";
            }else if(t == 2){
                alert ("Please Update your profile");
                window.location = "userProfile.php";
            }else{
                // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);

        //saveInvoice(orderId,id,mail,amount,qty);

        // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "0000000",    // Replace your Merchant ID
        "return_url": "http://localhost/etradewave/singleproductview.php?id=" + id,     // Important
        "cancel_url": "http://localhost/tradewave/singleproductview.php?id=" + id,     // Important
        "notify_url": "http://sample.com/notify",
        "order_id": obj["id"],
        "items": obj["item"],
        "amount": amount,
        "currency": "LKR",
        "hash": obj["hash"],
        "first_name": obj["fname"],
        "last_name": obj["lname"],
        "email": mail,
        "phone": obj["mobile"],
        "address": obj["address"],
        "city": obj["city"],
        "country": "Sri Lanka",
        "delivery_address": obj["address"],
        "delivery_city": obj["city"],
        "delivery_country": "Sri Lanka",
        "custom_1": "",
        "custom_2": ""
    };

    // Show the payhere.js popup, when "PayHere Pay" is clicked
    // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
    // };
            }
        }
    }

    r.open("GET","Cartpayment.php",true);
    r.send();
}
