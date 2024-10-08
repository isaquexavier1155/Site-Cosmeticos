<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="icon" href="{{ asset('favicon.ico') }}"> -->
    <link rel="icon" href="{{ asset('images/others/icon.png') }}">
    <!-- favicon.ico -->

    <title>Pagar com Mercado Pago</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>

<body>
    @php
        //var_dump($amount);
    @endphp
    <!-- tenho que deixar esse formulario pois oculta alguns dados que preciso -->
    <form id="form-pagamento">
        <input type="hidden" id="preference_id" name="preference_id" value="{{ $preference_id }}">
        <input type="hidden" id="amount" name="amount" value="{{ $amount }}">

        <!-- Exibindo o valor de amount na tela -->
        <!-- <p>Valor a pagar: R$ <span id="valor-amount">{{ number_format($amount, 2, ',', '.') }}</span></p>
    <p>Valor a pagar: R$ <?php echo number_format($amount, 2, ',', '.'); ?></p> -->

        <!-- <div id="paymentBrick_container2"></div> -->
        <!-- <button type="submit">Pagar com Mercado Pago</button> -->
    </form>

    <!-- <div id="paymentBrick_container"> -->
    <div class="card-page">
        <div id="statusScreenBrick_container"></div>
        <div id="paymentBrick_container"></div>
    </div>
    </div>
    <!--     <style>
        .card-page {
            width: 500px;
            margin: 0 auto;
        }

        .svelte-101ibq7 {
            text-align: center;
        }
    </style> -->
    <style>
        /* Ajustar a largura da card-page para ser responsiva */
        .card-page {
            width: 100%;
            /* Ocupa 100% da largura disponível */
            max-width: 500px;
            /* Mantém a largura máxima em telas grandes */
            margin: 0 auto;
            /* Centraliza o container */
            padding: 1rem;
            /* Adiciona um pouco de padding */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Sombra leve */
            border-radius: 8px;
            /* Bordas arredondadas */
        }

        /* Alinhamento do texto */
        .svelte-101ibq7 {
            text-align: center;
        }

        /* Adiciona um estilo responsivo para telas pequenas */
        @media (max-width: 576px) {
            .card-page {
                padding: 0.5rem;
                /* Ajusta o padding para telas pequenas */
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const mp = new MercadoPago('{{ config('services.mercadopago.public_key') }}');

            /* const mp = new MercadoPago('TEST-f4fa1c3f-7150-4c78-96e9-778ffedeea78'); */
            const bricksBuilder = mp.bricks();

            const renderPaymentBrick = async (bricksBuilder) => {
                //console.log("Iniciando a configuração do Payment Brick.");

                const settings = {
                    initialization: {
                        amount: document.getElementById('amount').value,
                        preferenceId: document.getElementById('preference_id').value,

                        payer: {
                            firstName: "isaque",
                            lastName: "xavier",
                            email: "",
                        },
                    },
                    customization: {
                        visual: {
                            style: {
                                theme: "default",
                            },
                        },
                        paymentMethods: {
                            bankTransfer: "all",//pix
                            creditCard: "all",
                            mercadoPago: [],
                        },
                    },
                    callbacks: {
                        onReady: () => {
                            //console.log("Payment Brick está pronto.");
                        },
                        onSubmit: ({ selectedPaymentMethod, formData }) => {
                            // console.log("Formulário submetido.");
                            // console.log("Método de pagamento selecionado:", selectedPaymentMethod);
                            console.log("Dados do formulário:", formData);

                            return new Promise((resolve, reject) => {
                                fetch("{{ route('processarpagamento') }}", { // Ajuste o nome da rota conforme sua aplicação
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    },
                                    body: JSON.stringify(formData),
                                })
                                    .then((response) => response.text()) // Obter como texto bruto primeiro
                                    .then((text) => {
                                        //console.log("Texto bruto da resposta:", text);

                                        try {
                                            // Tente converter para JSON
                                            const jsonResponse = JSON.parse(text);
                                            console.log("Resposta JSON do servidor 1:", jsonResponse);



                                            //Aqui esta chegando o parâmetro date_approved
                                            //que é null quando pagamento não for aprovado
                                            //e é setado com uma data quando o pagamento é aprovado
                                            if (!jsonResponse.id) {
                                                throw new Error("Payment ID não encontrado na resposta do servidor.");
                                            }

                                            const renderStatusScreenBrick = async (bricksBuilder) => {
                                                // console.log("Iniciando a configuração do Status Screen Brick.");

                                                const settings = {
                                                    initialization: {
                                                        paymentId: jsonResponse.id, // id do pagamento a ser mostrado
                                                    },
                                                    callbacks: {
                                                        onReady: () => {
                                                            // console.log("Status Screen Brick está pronto.");
                                                            document.getElementById('paymentBrick_container').style.display = 'none';
                                                        },
                                                        onError: (error) => {
                                                            console.error("Erro no Status Screen Brick:", error);
                                                        },
                                                    },
                                                };
                                                window.statusScreenBrickController = await bricksBuilder.create(
                                                    'statusScreen',
                                                    'statusScreenBrick_container',
                                                    settings,
                                                );
                                                //console.log("Status Screen Brick criado com sucesso.");
                                            };

                                            renderStatusScreenBrick(bricksBuilder);

                                            ////////////////////////////////--//////--
                                            // Usa id do pagamento e faz requisição GET
                                            //https://api.mercadopago.com/v1/payments/89074463596


                                            //////////////////////////////////////
                                            // Verifica a cada 3 segundos se o pagamento via cartão de credito foi aprovado
                                            const checkPaymentApproval = setInterval(() => {
                                                let id_paymentt = jsonResponse.id;
                                                //console.log("ID Pagamento 1=", id_paymentt);
                                                //console.log("Status do Pagamento 1=", jsonResponse.status);

                                                fetch(`/verificarstatuspagamento?paymentId=${id_paymentt}`, {
                                                    method: 'GET',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Para Laravel
                                                    }
                                                })
                                                    .then(response => response.json())
                                                    .then(jsonResponse => {
                                                        console.log("Status do Pagamento 2=", jsonResponse.status);

                                                        if (jsonResponse.id !== null && jsonResponse.status === 'approved') {
                                                            let data_aprovacao_pagamento = jsonResponse.date_approved;
                                                            //console.log("Data de aprovação do pagamento:", data_aprovacao_pagamento);

                                                            // ID do pagamento e preference_id gerado pelo Blade
                                                            const paymentId = "{{ $id_payment }}";
                                                            const statusPayment = 'Aprovado'; // Novo status
                                                            const preferenceId = "{{ $preference_id }}";

                                                            // Faz a requisição para salvar o status do pagamento e o preference ID
                                                            fetch('/salvar-status-pagamento', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Para Laravel
                                                                },
                                                                body: JSON.stringify({
                                                                    payment_id: paymentId,
                                                                    status_payment: statusPayment,
                                                                    preference_id: preferenceId, // Envia também o preference_id
                                                                }),
                                                            })
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    console.log('Success:', data);
                                                                    window.location.href = '/payment-success'; // Ajuste a rota conforme necessário
                                                                })
                                                                .catch(error => {
                                                                    console.error('Error:', error);
                                                                });

                                                            clearInterval(checkPaymentApproval); // Para parar a verificação
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('Error:', error);
                                                    });
                                            }, 3000);



                                            //////////////////////////////////////
                                            resolve();
                                        } catch (error) {
                                            console.error("Erro ao tentar analisar JSON:", error);
                                            reject();
                                        }
                                    })
                                    .catch((error) => {
                                        console.error("Erro ao criar o pagamento:", error);
                                        reject();
                                    });
                            });
                        },
                        onError: (error) => {
                            console.error("Erro no Payment Brick:", error);
                        },
                    },
                };

                // console.log("Criando o Payment Brick.");
                window.paymentBrickController = await bricksBuilder.create(
                    "payment",
                    "paymentBrick_container",
                    settings
                );
                console.log("Payment Brick criado com sucesso.");
                //console.log("Resposta JSON do servidor 2:", jsonResponse);

            };

            renderPaymentBrick(bricksBuilder);
        });
    </script>
</body>

</html>