import React from "react";
import { createRoot } from 'react-dom/client';
export default function Prueba() {
    return(
        <>
            <p>Esto es una prueba desde react</p>
        </>
    )
}
if (document.getElementById('estoEsUnaPrueba')) {
    createRoot(document.getElementById('estoEsUnaPrueba')).render(<Prueba/>);
}