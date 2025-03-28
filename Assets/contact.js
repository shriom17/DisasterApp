const initMap = (lat, lon) => {
    const map = L.map('map').setView([lat, lon], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map).bindPopup('Your Location').openPopup();
};

const displayContacts = (contacts, elementId) => {
    const element = document.getElementById(elementId);
    element.innerHTML = ''; 
    if (contacts.length === 0) {
        element.innerHTML = '<li>No results found.</li>';
        return;
    }
    contacts.forEach(contact => {
        const li = document.createElement('li');
        li.innerHTML = `
            <strong>${contact.name}</strong><br>
            Address: ${contact.address || 'Not Available'}<br>
            <a href="https://www.google.com/maps?q=${contact.lat},${contact.lon}" target="_blank">View on Map</a>
        `;
        element.appendChild(li);
    });
};

// Function to fetch contacts by location and type using the OpenStreetMap Nominatim API
const getContactsByLocation = async (lat, lon, query, elementId) => {
    try {
        console.log(`Fetching ${query} for location: lat=${lat}, lon=${lon}`);

        const radius = 0.05; 
        const north = lat + radius;
        const south = lat - radius;
        const east = lon + radius;
        const west = lon - radius;

        // Call the Nominatim API 
        const response = await fetch(
            `https://nominatim.openstreetmap.org/search?q=${query}&format=json&addressdetails=1&limit=10&bounded=1&viewbox=${west},${north},${east},${south}`
        );
        const data = await response.json();

        const contacts = data.map(place => ({
            name: place.display_name,
            lat: place.lat,
            lon: place.lon,
            address: place.address
                ? `${place.address.road || ''}, ${place.address.city || ''}`
                : 'Not Available'
        }));

        displayContacts(contacts, elementId);
    } catch (error) {
        console.error(`Error fetching ${query}:`, error);
        alert(`Failed to fetch ${query} details. Please try again later.`);
    }
};

// Function to handle geolocation and fetch nearby places
const fetchNearbyPlaces = () => {
    if (navigator.geolocation) {
        console.log('Geolocation is supported by the browser.');
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                console.log(`User's location: lat=${lat}, lon=${lon}`);


                initMap(lat, lon);

                // Fetch and display nearby places
                getContactsByLocation(lat, lon, 'police', 'police-stations');
                getContactsByLocation(lat, lon, 'fire station', 'fire-brigades');
                getContactsByLocation(lat, lon, 'hospital', 'hospitals');
                getContactsByLocation(lat, lon, 'nursing home', 'nursing-homes');
               
            },
            (error) => {
                console.error('Error fetching location:', error);

                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert('Location access denied by the user. Please enable location services.');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert('Location information is unavailable.');
                        break;
                    case error.TIMEOUT:
                        alert('The request to get user location timed out.');
                        break;
                    default:
                        alert('An unknown error occurred while fetching location.');
                        break;
                }
            }
        );
    } else {
        console.error('Geolocation is not supported by your browser.');
        alert('Geolocation is not supported by your browser.');
    }
};

fetchNearbyPlaces();