<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus GPS for Passengers</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bus GPS Tracking') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Live Bus GPS Tracking</h3>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </x-app-layout>


    
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            const pusher = new Pusher('84f5de0ba0c8a29b6aa1', {
              cluster: 'ap1'
            });

            const channel = pusher.subscribe('my-channel');
            const buses = {}
            channel.bind('gps-update', function(data) {
              console.log(data);

              if(!buses[data.busId]) {
                buses[data.busId] = L.marker([data.latitude, data.longitude]).addTo(map);
                buses[data.busId].bindPopup(`<b>Bus ##${data.busId}</b><br> Current location: `).openPopup();
              }

              updateBusLocation(data.busId, data.latitude, data.longitude);
            });

            // Initialize the map and set its view to Mariveles, Bataan, Philippines
            var map = L.map('map').setView([14.4331, 120.4852], 13);

            // Add OpenStreetMap tiles to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Function to simulate real-time updates
            function updateBusLocation(busId, lat, lng) {
              buses[busId].setLatLng([lat, lng]);
              map.panTo([lat, lng]);
              buses[busId].getPopup().setContent(`<b>Bus #${busId}</b><br>Current location: [${lat.toFixed(5)}, ${lng.toFixed(5)}]`).openOn(map);
            }


            // // Simulate GPS data updates
            // var i = 0;
            // var gpsData = [
            //     [14.4331, 120.4852],
            //     [14.4332, 120.4853],
            //     [14.4333, 120.4854],
            //     [14.4334, 120.4855],
            //     [14.4335, 120.4856]
            // ];
            // setInterval(function() {
            //     if (i >= gpsData.length) {
            //         i = 0; // Loop back to the start
            //     }
            //     updateBusLocation(gpsData[i][0], gpsData[i][1]);
            //     i++;
            // }, 2000); // Update every 2 seconds
        });
    </script>
</body>
</html>
