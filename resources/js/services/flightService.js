import axiosInstance from './axiosInstance';

export const getAirports = () => axiosInstance.get('/airports');

export const getJourneys = (origin, destiny, date) => axiosInstance.post('/journeys',{origin : origin, destiny: destiny, date: date});

