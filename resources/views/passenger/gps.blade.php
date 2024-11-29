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
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map and set its view to Mariveles, Bataan, Philippines
            var map = L.map('map').setView([14.4331, 120.4852], 13);

            // Add OpenStreetMap tiles to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Simulate real-time GPS tracking with sample data
            var busIcon = L.icon({
                iconUrl: 'path/to/bus-icon.png', // Change bus icon
                iconSize: [38, 38],
                iconAnchor: [22, 22],
                popupAnchor: [-3, -26]
            });

            var marker = L.marker([14.4331, 120.4852], {icon: busIcon}).addTo(map);
            marker.bindPopup("<b>Bus 1</b><br>Current location.").openPopup();

            // Function to simulate real-time updates
            function updateBusLocation(lat, lng) {
                marker.setLatLng([lat, lng]);
                map.panTo([lat, lng]);
                marker.getPopup().setContent(`<b>Bus 1</b><br>Current location: [${lat.toFixed(5)}, ${lng.toFixed(5)}]`).openOn(map);
            }

            // Simulate GPS data updates
            var i = 0;
            var gpsData = [
                [14.4331, 120.4852],
                [14.4332, 120.4853],
                [14.4333, 120.4854],
                [14.4334, 120.4855],
                [14.4335, 120.4856]
            ];
            setInterval(function() {
                if (i >= gpsData.length) {
                    i = 0; // Loop back to the start
                }
                updateBusLocation(gpsData[i][0], gpsData[i][1]);
                i++;
            }, 2000); // Update every 2 seconds
        });
    </script>
</body>
</html>
