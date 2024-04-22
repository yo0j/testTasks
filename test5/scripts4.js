$(document).ready(function () {
    sessionStorage.removeItem('participantsData'); // Очищаем данные при загрузке страницы

    let savedParticipantsData = []
    $('#addButton').click(function () {
        addParticipants();
    });

    $('#participants').keypress(function (event) {
        if (event.which === 13) {
            addParticipants();
        }
    });

    function addParticipants() {
        const participants = $('#participants').val().trim();
        if (participants === '') {
            showErrorMessage('Введите имена участников');
            return;
        }

        $.ajax({
            url: 'generate_scores.php',
            type: 'POST',
            data: {participants: participants},
            success: function (data) {
                const participantsData = JSON.parse(data);
                displayParticipants(participantsData); // Отображаем участников на странице
                $('#participants').val('');
            },
            error: function () {
                showErrorMessage('Произошла ошибка. Попробуйте еще раз.');
            }
        });
    }


    function displayParticipants(participantsData) {
        participantsData.map((participant)=>{ savedParticipantsData.push(participant)})
        const tableBody = $('#participantsTable tbody');
        tableBody.empty();
        savedParticipantsData.forEach(function (participant, index) {
            const row = `<tr>
                            <td>${index + 1}</td>
                            <td>${participant.name}</td>
                            <td>${participant.points}</td>
                        </tr>`;
            tableBody.append(row);
        });
    }

    function showErrorMessage(message) {
        alert(message);
    }
});
