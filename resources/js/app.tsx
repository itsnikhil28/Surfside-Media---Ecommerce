import React from 'react';
import ReactDOM from 'react-dom/client';
import Chatbot from './components/Chatbot';

const rootElement = document.getElementById('chatbot-root');

if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<Chatbot />);
}
