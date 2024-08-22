
    // Função para obter a data e hora final como meio-dia do dia seguinte
    function getEndDate() {
        const now = new Date();
        const endDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1, 12, 0, 0); // Meio-dia do dia seguinte
        return endDate;
    }

    let endDate = getEndDate(); // Define a data e hora final como meio-dia do dia seguinte

    function updateCountdown() {
        const now = new Date();
        const timeRemaining = endDate - now;

        if (timeRemaining <= 0) {
            // Se o tempo tiver acabado
            document.getElementById('hour').innerHTML = '00';
            document.getElementById('minute').innerHTML = '00';
            document.getElementById('second').innerHTML = '00';
            clearInterval(interval); // Para o contador
            return;
        }

        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Atualiza o conteúdo dos elementos
        document.getElementById('hour').innerHTML = hours.toString().padStart(2, '0');
        document.getElementById('minute').innerHTML = minutes.toString().padStart(2, '0');
        document.getElementById('second').innerHTML = seconds.toString().padStart(2, '0');
    }

    // Atualiza a data e hora final se o contador tiver expirado
    function refreshEndDate() {
        const now = new Date();
        if (now > endDate) {
            endDate = getEndDate(); // Atualiza para o meio-dia do dia seguinte
        }
    }

    // Atualiza o contador a cada segundo
    const interval = setInterval(() => {
        refreshEndDate();
        updateCountdown();
    }, 1000);

    // Atualiza o contador imediatamente ao carregar a página
    updateCountdown();
