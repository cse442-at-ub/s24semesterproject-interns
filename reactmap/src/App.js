import './App.css';
import React from 'react';
import { GoogleMap, useLoadScript, Marker } from '@react-google-maps/api';

const libraries = ['places'];
const mapContainerStyle = {
  width: '800px',
  height: '500px',
};
const center = {
  lat: 42.886448, // default latitude
  lng: -78.878372, // default longitude
};

const App = () => {
  const { isLoaded, loadError } = useLoadScript({
    googleMapsApiKey: process.env.REACT_APP_API_KEY,
    libraries,
  });

  if (loadError) {
    return <div>Error loading maps</div>;
  }

  if (!isLoaded) {
    return <div>Loading maps</div>;
  }

  return (
    <div class = 'map'>
        <input id ='search' type="text" placeholder="Search your ideal location" name="search"></input>
        <button id = '' type="submit" formAction=''>Submit</button>
      <GoogleMap
        mapContainerStyle={mapContainerStyle}
        zoom={5}
        center={center}
      >
        <Marker position={center} />
      </GoogleMap>
    </div>
  );
};

export default App;
