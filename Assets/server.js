const express = require('express');
const axios = require('axios');
const cors = require('cors');

const app = express();
const PORT = 5500;

app.use(cors());

//Google Places API Key
const API_KEY = 'AIzaSyD079pACzN_llkdVqXK8YOYjdjd2RaoIls'; 
app.get('/nearbyplaces', async (req, res) => {
    const { lat, lon, type } = req.query;

    if (!lat || !lon || !type) {
        return res.status(400).json({ error: 'Missing required query parameters: lat, lon, type' });
    }

    try {
        const response = await axios.get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', {
            params: {
                location: `${lat},${lon}`,
                radius: 5000, 
                type, 
                key: API_KEY
            }
        });

        const places = response.data.results.map(place => ({
            name: place.name,
            lat: place.geometry.location.lat,
            lon: place.geometry.location.lng,
            address: place.vicinity || 'Not Available',
            phone: 'Not Available',
        }));

        res.json(places);
    } catch (error) {
        console.error('Error fetching nearby places:', error.message);
        res.status(500).json({ error: 'Failed to fetch nearby places' });
    }
});


app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});