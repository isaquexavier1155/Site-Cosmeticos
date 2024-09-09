<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar com Mercado Pago</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <form id="form-pagamento">
        <input type="hidden" id="preference_id" name="preference_id" value="{{ $preference_id }}">
        <input type="hidden" id="amount" name="amount" value="{{ $amount }}">
        <div id="paymentBrick_container"></div>
        <button type="submit">Pagar com Mercado Pago</button>
    </form>

    <script>
        const mp = new MercadoPago('TEST-f4fa1c3f-7150-4c78-96e9-778ffedeea78');
        const bricksBuilder = mp.bricks();

        const renderPaymentBrick = async (bricksBuilder) => {
            console.log("Iniciando a configuração do Payment Brick.");

            const settings = {
                initialization: {
                    amount: document.getElementById('amount').value,
                    preferenceId: document.getElementById('preference_id').value,
                },
                customization: {
                    paymentMethods: {
                        ticket: "all",
                        bankTransfer: "all",
                        creditCard: "all",
                        debitCard: "all",
                        mercadoPago: "all",
                    },
                },
                callbacks: {
                    onReady: () => {
                        console.log("Payment Brick está pronto.");
                    },
                    onSubmit: ({ selectedPaymentMethod, formData }) => {
                        console.log("Formulário submetido.");
                        console.log("Método de pagamento selecionado:", selectedPaymentMethod);
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
                                console.log("Texto bruto da resposta:", text);

                                try {
                                    // Agora, tente converter para JSON
                                    const jsonResponse = JSON.parse(text);
                                    console.log("Resposta JSON do servidor:", jsonResponse);

                                    if (!jsonResponse.id) {
                                        throw new Error("Payment ID não encontrado na resposta do servidor.");
                                    }

                                    const renderStatusScreenBrick = async (bricksBuilder) => {
                                        console.log("Iniciando a configuração do Status Screen Brick.");

                                        const settings = {
                                            initialization: {
                                                paymentId: jsonResponse.id, // id do pagamento a ser mostrado
                                            },
                                            callbacks: {
                                                onReady: () => {
                                                    console.log("Status Screen Brick está pronto.");
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
                                        console.log("Status Screen Brick criado com sucesso.");
                                    };

                                    renderStatusScreenBrick(bricksBuilder);
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

            console.log("Criando o Payment Brick.");
            window.paymentBrickController = await bricksBuilder.create(
                "payment",
                "paymentBrick_container",
                settings
            );
            console.log("Payment Brick criado com sucesso.");
        };

        renderPaymentBrick(bricksBuilder);
    </script>
</body>
</html>
