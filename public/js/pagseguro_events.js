let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');

        cardNumber.addEventListener('keyup', function() {
            console.log(cardNumber.value);
            if (cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function(res) {
                        console.log(res);
                        let imgFlag =
                            `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`; //adicionando a imagem da bandeira do cartão
                        spanBrand.innerHTML = imgFlag;
                        document.querySelector('input[name=card_brand]').value = res.brand.name;

                        getInstallments(amoutTransaction, res.brand.name);
                    },

                    error: function(err) {
                        console.log(err);
                        //spanBrand.innerHTML = '';
                    },

                    complete: function(res) {
                        // console.log('complete:' , res);
                    }
                });

            }
        });

        let submitButton = document.querySelector('button.processCheckout');

        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('div.msg').innerHTML = '';
            
            let buttonTarget = event.target;

            buttonTarget.disabled = true;
            buttonTarget.innerHTML = 'Carregando...';
            


            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number]').value,
                brand:      document.querySelector('input[name=card_brand]').value,
                cvv:        document.querySelector('input[name=card_cvv]').value,
                expirationMonth: document.querySelector('input[name=expiration_month]').value,
                expirationYear: document.querySelector('input[name=expiration_year]').value,
                success: function(res) {
                    proccessPayment(res.card.token, buttonTarget);
                },

                error: function(err) {
                    buttonTarget.disabled = false;
                    buttonTarget.innerHTML = 'Efetuar Pagamenyo';

                    for(let i in err.errors) {
                        document.querySelector('div.msg').innerHTML = showErrorMessages(errorsMapPagseguroJS(i));
(i);
                    }
                }
            });
        });


