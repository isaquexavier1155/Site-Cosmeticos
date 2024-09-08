//Script 1 - para não ser possível adicionar ao carrinho sem ter pelo menos uma quntidade selecionada-->

    document.addEventListener('DOMContentLoaded', function () {
        const radioButtons = document.querySelectorAll('input[name="quantidade"]');
        const addToCartButton = document.getElementById('add-to-cart-button');

        radioButtons.forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (radio.checked) {
                    addToCartButton.disabled = false;
                }
            });
        });
    });







//Script 3 - não lembro o que faz
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script carregado e DOM pronto.');

    // Verifica se o valor 'cart_added' está presente no sessionStorage
    if (sessionStorage.getItem('cart_added') === 'true') {
        const openCartButton = document.querySelector('[data-bs-toggle="offcanvas"][data-bs-target="#shoppingCart"]');
        if (openCartButton) {
            openCartButton.click();
            console.log('Modal do carrinho aberto com sucesso.');
        } else {
            console.error('Elemento para abrir o carrinho não encontrado.');
        }

        // Remove o valor do sessionStorage após abrir o carrinho
        sessionStorage.removeItem('cart_added');
    }
});


//Script 4 - Recarrega a página ao clicar em fechar modal do carrinho de compras-->
 
    document.addEventListener('DOMContentLoaded', function() {
    // Adiciona um listener para o clique no ícone com id 'fecharmoddal'
    document.getElementById('fecharmoddal').addEventListener('click', function() {
        // Recarrega a página
        location.reload();
    });
});



//Script 6 - para atualizar o preço total -->

    document.addEventListener('DOMContentLoaded', function() {
        
        function updateTotal() {
            let total = 0;

            // Itera sobre todos os itens do carrinho
            document.querySelectorAll('tbody#cart-items tr').forEach(function(row) {
                const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
                const price = parseFloat(row.querySelector('.item-price').dataset.price) || 0;
                total += quantity * price;
            });

            // Atualiza o valor total na tela
            document.getElementById('cart-total').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
        }

        // Função para adicionar eventos de atualização de preço total
        function addUpdateTotalListeners() {
            // Atualiza o total quando a quantidade muda
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', updateTotal);
            });

            // Atualiza o total quando os botões de incremento e decremento são clicados
            document.querySelectorAll('.shop-up, .shop-down').forEach(button => {
                button.addEventListener('click', function() {
                    // Deferir a atualização do total até que a quantidade tenha sido atualizada
                    setTimeout(updateTotal, 100);
                });
            });
        }

        // Inicializa a atualização do total
        addUpdateTotalListeners();
        updateTotal();
    });
