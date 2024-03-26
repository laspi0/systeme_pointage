<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.js"></script>

</head>

<body>

    <div class="row m-2">
        <div class=" col-2">
            <input type="text" class="totalHoursInput" id="totalHoursInput" readonly> <!-- Champ d'entrée pour afficher le total des heures -->
        </div>



        <div class="col-6">
            <form action="{{ route('update-schedule') }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="schedule" id="schedule"> <!-- Champ d'entrée caché pour envoyer le total des heures -->
                <button type="submit">Valider</button>
            </form>
        </div>
        <div class="col-4">
            <div class="row float-end">
                <div class="col-6">
                    <h5 class="text-light">{{ auth()->user()->last_name }}</h5>
                </div>
                <div class="col-6">
                    <a class="btn btn-sm bg-warning" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Se déconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div class="row m-2">
        <div class="col-12">
            <div id="calendar"></div>
        </div>

    </div>


    <script>
        $(document).ready(function() {
            var totalHours = 0; // Variable pour stocker le total des heures sélectionnées

            // Définir la langue par défaut de moment.js en français
            moment.locale('fr');

            $("#calendar").fullCalendar({
                defaultView: "agendaWeek",
                weekends: false,
                selectable: true,
                selectHelper: true,
                minTime: "08:00:00", // Définir l'heure de début à 8h00
                maxTime: "18:00:00", // Définir l'heure de fin à 18h00
                eventOverlap: false, // Empêche le chevauchement des événements
                select: function(start, end) {
                    var eventData = {
                        start: start,
                        end: end,
                    };

                    // Vérifier s'il y a des événements chevauchants
                    var events = $("#calendar").fullCalendar(
                        "clientEvents",
                        function(event) {
                            return event.start.isBefore(end) && event.end.isAfter(start);
                        }
                    );

                    if (events.length > 0) {
                        if (
                            confirm(
                                "Un événement existe déjà à cet horaire. Voulez-vous le supprimer ?"
                            )
                        ) {
                            var duration = moment.duration(
                                events[0].end.diff(events[0].start)
                            );
                            var hours = duration.asHours();
                            totalHours -= hours; // Soustraction des heures de la durée totale
                            console.log("Total hours: " + totalHours);

                            $("#calendar").fullCalendar("removeEvents", events[0]._id);
                        } else {
                            return;
                        }
                    }

                    $("#calendar").fullCalendar("renderEvent", eventData, true);

                    // Calcul de la durée de l'événement sélectionné
                    var duration = moment.duration(end.diff(start));
                    var hours = duration.asHours();
                    totalHours += hours; // Ajout des heures à la durée totale
                    $("#schedule").val(totalHours); // Mettre à jour la valeur du champ d'entrée caché
                    $("#totalHoursInput").val(totalHours + ' heures'); // Mettre à jour la valeur de l'input visible
                },
                eventClick: function(event) {
                    if (confirm("Voulez-vous supprimer cet événement ?")) {
                        // Récupération de la durée de l'événement supprimé
                        var duration = moment.duration(event.end.diff(event.start));
                        var hours = duration.asHours();
                        totalHours -= hours; // Soustraction des heures de la durée totale
                        console.log("Total hours: " + totalHours);

                        $("#calendar").fullCalendar("removeEvents", event._id);
                        $("#schedule").val(totalHours); // Mettre à jour la valeur du champ d'entrée caché
                        $("#totalHoursInput").val(totalHours + ' heures'); // Mettre à jour la valeur de l'input visible
                    }
                },
            });
        });
    </script>
    <style>
        /* styles.css */

        /* Style pour le corps de la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #adbeeb;
        }

        /* Style pour le conteneur principal */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style pour le conteneur du calendrier */
        #calendar {
            margin-bottom: 20px;
        }

        /* Style pour le champ d'entrée du total des heures */
        .totalHoursInput {
            margin-bottom: 20px;
            padding: 5px;
            font-size: 16px;
            width: calc(100% - 20px);
            /* Ajuster la largeur du champ pour tenir compte de la marge et du padding */
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            /* Pour inclure le padding dans le calcul de la largeur */
        }

        /* Style pour le bouton de validation */
        form button[type="submit"] {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</body>

</html>