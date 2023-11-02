<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paiement avec différent agrégateur</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
      <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .product-title {
        font-size: 15px; /* Réduire la taille de la police à 18 pixels */
        color: green; /* Couleur du texte */
        font-weight: bold; /* Texte en gras */
        text-transform: uppercase; /* Texte en majuscules */
    }
        .container {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .card {
            border: none;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .table {
            background-color: #fff;
        }
        .btn {
            margin: 5px;
        }
        label {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class='row'>
            <h2 style="text-align: center;">Laravel 10 Integration Fadapay, Kkaipay, Stripe Payment Gateway</h2>
              <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        Paiement avec différent agrégateur
                    </div>
                    <div class="card-body">
                        <table id="cart" class="table table-hover table-condensed">
                            <!-- Le contenu du tableau reste inchangé -->
                            <thead>
                                <tr>
                                    <th style="width:50%">Product</th>
                                    <th style="width:10%">Price</th>
                                    <th style="width:8%">Quantity</th>
                                    <th style="width:22%" class="text-center">Subtotal</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <h5 class="nomargin product-title">Ordinateur Asus Vivobook 17 </h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">6€</td>
                                    <td data-th="Quantity">
                                        <input type="number" value="1" class="form-control quantity cart_update" min="1" />
                                    </td>
                                    <td data-th="Subtotal" class="text-center">6€</td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Delete</button>
                                    </td>
                                </tr>
                                <!-- Ajoutez d'autres lignes de produit ici si nécessaire -->
                            </tbody>

                            <tr>
                                <td colspan="5">
                                    <h3><strong>Choisissez un moyen de paiement :</strong></h3>
                                    <form id="payment-form">
                                        <label>
                                            <input type="radio" name="payment_option" value="Kkaipay">
                                            Kkaipay
                                        </label>
                                        <label>
                                            <input type="radio" name="payment_option" value="Fedapay">
                                            Fedapay
                                        </label>

                                        <label>
                                            <input type="radio" name="payment_option" value="Stripe">
                                            Stripe
                                        </label>
                                    </form>
                                </td>
                            </tr>
                            <!-- Fin des boutons radio -->

                            <tr>
                                <td colspan="5" style="text-align:right;">
                                    <h3><strong>Total 6€</strong></h3>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5" style="text-align:right;">
                                    <div class="btn-group">
                                    <button id="pay-btn-kkaipay"class="kkiapay-button btn btn-success" name="payment_option" value="Kkaipay" disabled>Pay with Kkaipay</button>
                                    <button id="pay-btn" class="btn btn-success" name="payment_option" value="Fedapay" disabled>Pay with Fedapay</button>
                                    <form action="/session" method="POST">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type='hidden' name="total" value="6">
                                        <input type='hidden' name="productname" value="Ordinateur portable Asus Vivobook 17 - Intel Core 10e">

                                        <button class="btn btn-success" type="submit" id="checkout-live-button" name="payment_option" value="Checkout" disabled>
                                            <i class="fa fa-money"></i> Pay with Stripe
                                        </button>

                                    </form>
                                    <a href="{{ url('/') }}" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i> Annuler
                                    </a>
                                </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    FedaPay.init('#pay-btn', {
      public_key: 'pk_sandbox_NLItyQr1riFOaiuRwogXpjF8',
      transaction: {
        amount: 3940,
        description: 'Acheter mon produit'
      },
      customer: {
        email: 'johndoe@gmail.com',
        lastname: 'Doe',
        firstname: 'John',
      }
    });
</script>
<script amount="3940"
    callback=""
    data=""
    position="center"
    theme="#0095ff"
    sandbox="true"
    key="d9da5d50d3a311edb532ad421d393c9e"
    src="https://cdn.kkiapay.me/k.js">
</script>


    <script>
        // Sélectionnez les éléments HTML pertinents
        const paymentOptions = document.querySelectorAll('input[name="payment_option"]');
        const payButton = document.getElementById("pay-btn");
        const payButtonKkaipay = document.getElementById("pay-btn-kkaipay");
        const checkoutButton = document.getElementById("checkout-live-button");

        // Écoutez les changements des boutons radio
        paymentOptions.forEach(option => {
            option.addEventListener("change", () => {
                if (option.value === "Fedapay") {
                    // Si l'option "Fedapay" est sélectionnée, affichez le bouton "Pay 1000 FCFA" et masquez les autres
                    payButton.style.display = "block";
                    payButtonKkaipay.style.display = "none";
                    checkoutButton.style.display = "none";
                        // Si l'option "Fedapay" est sélectionnée, activez le bouton "Pay 1000 FCFA" et désactivez les autres
                    payButton.removeAttribute("disabled");
                    payButtonKkaipay.setAttribute("disabled", "disabled");
                    checkoutButton.setAttribute("disabled", "disabled");
                } else if (option.value === "Stripe") {
                    // Si l'option "Stripe" est sélectionnée, affichez le bouton "Checkout" et masquez les autres
                    payButton.style.display = "none";
                    payButtonKkaipay.style.display = "none";
                    checkoutButton.style.display = "block";
                        // Si l'option "Stripe" est sélectionnée, activez le bouton "Checkout" et désactivez les autres
                    payButton.setAttribute("disabled", "disabled");
                    payButtonKkaipay.setAttribute("disabled", "disabled");
                    checkoutButton.removeAttribute("disabled");
                } else if (option.value === "Kkaipay") {
                    // Si l'option "Kkaipay" est sélectionnée, affichez le bouton "Pay with Kkaipay" et masquez les autres
                    payButton.style.display = "none";
                    payButtonKkaipay.style.display = "block";
                    checkoutButton.style.display = "none";
                     // Si l'option "Kkaipay" est sélectionnée, activez le bouton "Pay with Kkaipay" et désactivez les autres
                    payButtonKkaipay.removeAttribute("disabled");
                    payButton.setAttribute("disabled", "disabled");
                    checkoutButton.setAttribute("disabled", "disabled");
                }
            });
        });
    </script>



</body>
</html>
